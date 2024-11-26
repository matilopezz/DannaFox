<?php

include '..//db/conexion.php';
include '..//components/navbar.php';
include '../auth.php';
include '..//querys/clientes/getCliente.php';
include '..//querys/clientes/deleteCliente.php';

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DannaFox - Clientes</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../styles/stylesheet.css?v=1.0">
</head>

<body>
    <div class="container">
        <h2 class="mt-5 text-center" style="color: black;; font-size: 40px;">LISTA DE CLIENTES:</h2>
        <hr class="my-4" style="width: 50%; margin: auto;">

        
        <!-- Fila para botón y buscador -->
         <div class="mt-5">
        <div class="d-flex justify-content-between align-items-center mt-4 w-100">
            <button class="btn-steel-blue btn" onclick="window.location.href='crearcliente.php'">Añadir Cliente</button>
            <input type="text" placeholder="Buscar Cliente" id="buscador" class="form-control" style="width: 300px;">
        </div>

        <table class="table table-bordered pt-3 mt-4">
            <thead>
                <tr>
                    <th class="text-center">ID</th>
                    <th class="text-center">Nombre</th>
                    <th class="text-center">Apellido</th>
                    <th class="text-center">CUIL/CUIT</th>
                    <th class="text-center">Razón social</th>
                    <th class="text-center">Teléfono</th>
                    <th class="text-center">Email</th>
                    <th class="text-center">Acciones</th>
                </tr>
            </thead>
            <tbody id="tablaClientes">
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td class="text-center"><?php echo isset($row['cliente_id']) ? $row['cliente_id'] : 'No ID'; ?></td>
                        <td class="text-center"><?php echo $row['nombre']; ?></td>
                        <td class="text-center"><?php echo $row['apellido']; ?></td>
                        <td class="text-center"><?php echo $row['cuil_cuit']; ?></td>
                        <td class="text-center"><?php echo $row['razon_social']; ?></td>
                        <td class="text-center"><?php echo $row['telefono']; ?></td>
                        <td class="text-center"><?php echo $row['email']; ?></td>
                        <td class="d-flex justify-content-center">
                            <!-- Botón para eliminar cliente -->
                            <form method="POST">
                                <input type="hidden" name="cuil_cuit" value="<?php echo $row['cuil_cuit']; ?>">
                                <button type="submit" name="eliminar" class="btn btn-yellow btn-sm">Eliminar</button>
                            </form>

                            <a href="modificarcliente.php?cuil_cuit=<?php echo $row['cuil_cuit']; ?>" class="ms-3">
                                <button class="btn btn-steel-blue btn-sm">Modificar</button>
                            </a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>

        <!-- Botones debajo de la tabla -->
        <div class="d-flex justify-content-start w-100 mt-4">
            <button class="btn btn-yellow me-2" onclick="exportTableToPDF()">Exportar a PDF</button>
            <button class="btn btn-steel-blue" onclick="exportTableToExcel()">Exportar a Excel</button>
        </div>
    </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="../js/alertas.js"></script>
    <script src="../js/buscador.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.25/jspdf.plugin.autotable.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.17.0/xlsx.full.min.js"></script>
    <script>
        function exportTableToPDF() {
            const { jsPDF } = window.jspdf;
            const doc = new jsPDF();
            const table = document.querySelector('table');

            // Definir las columnas a incluir (puedes hacerlo por índice de las columnas)
            const columns = Array.from(table.querySelectorAll('th')).map(th => th.textContent);

            // Eliminar la columna que deseas excluir, por ejemplo, la columna con índice 1
            const columnIndexToExclude = 7;
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
            doc.save('clientes.pdf');
        }

        function exportTableToExcel() {
            const table = document.querySelector('table');
            // Obtener los encabezados de la tabla (si están dentro de <thead>)
            const headers = Array.from(table.querySelectorAll('thead th')).map(th => th.textContent);
            // Eliminar la columna que deseas excluir, por ejemplo, la columna con índice 1
            const columnIndexToExclude = 7;
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
            XLSX.writeFile(wb, 'clientes.xlsx');
        }
    </script>

</body>

</html>