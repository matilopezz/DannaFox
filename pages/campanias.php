<?php
// campanias.php
include '..//db/conexion.php'; // Incluir la conexión a la base de datos
include '..//components/navbar.php';
include '../auth.php';
include '../querys/campania/validar_campanias.php';


?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DannaFox - Campañas</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../styles/stylesheet.css?v=1.0">
</head>

<body>
    <div class="container">
        <h2 class="mt-5 text-center" style="color: black;; font-size: 40px;">LISTA DE CAMPAÑAS:</h2>
        <hr class="my-4" style="width: 50%; margin: auto;">

        <?php if (!$mostrarBotonCampanias): ?>
            <div class="alert alert-warning text-center mt-3">
            No se pueden añadir más campañas porque se ha alcanzado el límite permitido.
            </div>
        <?php endif; ?>

        <!-- Fila para el botón y el buscador -->
        <div class="mt-5">
            <div class="d-flex justify-content-between align-items-center  w-100">
            <?php if ($mostrarBotonCampanias): ?>
                <button class="btn-steel-blue btn" onclick="window.location.href='crearcampania.php'">Añadir Campaña</button>
            <?php else: ?>
                <button class="btn btn-secondary btn-disabled" disabled>No se pueden añadir más campañas</button>
            <?php endif; ?>
                <input type="text" placeholder="Buscar campaña por nombre" id="buscador" class="form-control" style="width: 300px;">
            </div>

            <!-- Tabla de campañas -->
            <table class="table table-bordered mt-4" id="tablaCampanias">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre Campaña</th>
                        <th>Nombre cliente</th>
                        <th>Localidad(es)</th>
                        <th>Estado</th>
                        <th>Fecha de Inicio</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    
                    include '..//querys/campania/getCampanias.php';
                    
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<td>" . $row['campania_id'] . "</td>";
                            echo "<td>" . $row['nombre_campania'] . "</td>";
                            echo "<td>" . $row['nombre_cliente'] . " ".$row['apellido_cliente']. "</td>";
                            echo "<td>" . $row['nombre_localidad'] . "</td>"; //va localidad
                            echo "<td>" . $row['estado'] . "</td>";
                            echo "<td>" . $row['fecha_inicio'] . "</td>";
                            echo "<td>
                            <button class='btn btn-steel-blue btn-sm' onclick='modificarCampania(" . $row['campania_id'] . ")'>✏️</button>
                            <button class='btn btn-yellow btn-sm' onclick='borrarCampania(" . $row['campania_id'] . ")'>🗑️</button>
                          </td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='5'>No hay campañas registradas.</td></tr>";
                    }
                    ?>
                </tbody>
            </table>

            <div class="d-flex justify-content-start w-100 mt-4">
                <button class="btn btn-yellow me-2 mb-2" onclick="exportTableToPDF()">Exportar a PDF</button>
                <button class="btn btn-steel-blue mb-2" onclick="exportTableToExcel()">Exportar a Excel</button>
            </div>
        </div>
    </div>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.25/jspdf.plugin.autotable.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.17.0/xlsx.full.min.js"></script>
    <script src="../js/buscadorCamp.js"></script>

    
    <script>
        function exportTableToPDF() {
            const { jsPDF } = window.jspdf;
            const doc = new jsPDF();
            const table = document.querySelector('table');

            // Definir las columnas a incluir (puedes hacerlo por índice de las columnas)
            const columns = Array.from(table.querySelectorAll('th')).map(th => th.textContent);

            // Eliminar la columna que deseas excluir, por ejemplo, la columna con índice 1
            const columnIndexToExclude = 6;
            const filteredColumns = columns.filter((_, index) => index !== columnIndexToExclude);

            // Crear una tabla para autoTable sin la columna excluida
            doc.autoTable({
                head: [filteredColumns], // Usamos las columnas filtradas
                body: Array.from(table.querySelectorAll('tr')).map(row => {
                    return Array.from(row.children).filter((_, index) => index !== columnIndexToExclude)
                        .map(cell => cell.textContent);
                })
            });

            // Guardar el PDF generado
            doc.save('campañas.pdf');
        }

        function exportTableToExcel() {
            const table = document.querySelector('table');
            // Obtener los encabezados de la tabla (si están dentro de <thead>)
            const headers = Array.from(table.querySelectorAll('thead th')).map(th => th.textContent);
            // Eliminar la columna que deseas excluir, por ejemplo, la columna con índice 1
            const columnIndexToExclude = 6;
            // Filtrar las filas del <tbody> para excluir la columna
            const rows = Array.from(table.querySelectorAll('tbody tr')).map(row => {
                return Array.from(row.children).filter((_, index) => index !== columnIndexToExclude)
                    .map(cell => cell.textContent);
            });
            // Filtrar los encabezados también para excluir la columna
            const filteredHeaders = headers.filter((_, index) => index !== columnIndexToExclude);
            // Filtrar las filas para excluir la columna
            const filteredRows = rows.map(row => row.filter((_, index) => index !== columnIndexToExclude));
            // Crear una nueva tabla con los datos filtrados (encabezados + filas)
            const filteredTable = [filteredHeaders, ...filteredRows];
            // Crear un libro nuevo
            const wb = XLSX.utils.book_new();
            // Convertir el array de arrays (AOA) en una hoja
            const ws = XLSX.utils.aoa_to_sheet(filteredTable);
            // Añadir la hoja al libro
            XLSX.utils.book_append_sheet(wb, ws, "Sheet1");
            // Escribir el archivo Excel
            XLSX.writeFile(wb, 'campañas.xlsx');
        }

        function modificarCampania(id) {
            window.location.href = 'modificarcampania.php?id=' + id;
        }

        function borrarCampania(id) {
            if (confirm('¿Estás seguro de que deseas borrar esta campaña?')) {
                const xhr = new XMLHttpRequest();
                xhr.open("POST", "../querys/campania/borrar_campania.php", true);
                xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                xhr.onreadystatechange = function() {
                    if (xhr.readyState === 4 && xhr.status === 200) {
                        const response = JSON.parse(xhr.responseText);
                        if (response.success) {
                            document.getElementById('row_' + id).remove();
                        } else {
                            alert('Error al borrar la campaña.');
                        }
                    }
                };
                xhr.send("id=" + id);
            }
        }
    </script>

</body>

</html>

<?php
// Cerrar la conexión
$conn->close();
?>