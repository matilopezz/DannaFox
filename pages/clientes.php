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
    <link rel="stylesheet" href="../styles/stylesheet.css">
</head>

<body>
    <div class="container d-flex flex-column align-items-center">
        <h2 class="mt-5">LISTA DE CLIENTES:</h2>
        <button class="btn-steel-blue btn mt-4" onclick="window.location.href='crearcliente.php'">Añadir Cliente</button>
        <button class="btn btn-primary mt-4" onclick="exportTableToPDF()">Exportar a PDF</button>
        <button class="btn btn-success mt-4" onclick="exportTableToExcel()">Exportar a Excel</button>

        <input type="text" placeholder="Buscar Cliente" id="buscador" class="form-control mt-4">


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
                                <button type="submit" name="eliminar" class="btn btn-danger btn-sm">Eliminar</button>
                            </form>

                            <a href="modificarcliente.php?cuil_cuit=<?php echo $row['cuil_cuit']; ?>" class="ms-3">
                                <button class="btn btn-primary btn-sm">Modificar</button></a>

                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="../js/alertas.js"></script>
    <script src="../js/buscador.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.25/jspdf.plugin.autotable.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.17.0/xlsx.full.min.js"></script>
    <script>
        function exportTableToPDF() {
            const {
                jsPDF
            } = window.jspdf;
            const doc = new jsPDF();
            const table = document.querySelector('table');
            doc.autoTable({
                html: table
            });
            doc.save('clientes.pdf');
        }

        function exportTableToExcel() {
            const table = document.querySelector('table');
            const wb = XLSX.utils.table_to_book(table, {
                sheet: "Sheet1"
            });
            XLSX.writeFile(wb, 'clientes.xlsx');
        }
    </script>


</body>

</html>

<?php
// Cerrar la conexión (no es estrictamente necesario con PDO, ya que se cierra automáticamente)
$pdo = null;
?>