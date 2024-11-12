<?php

include '..//db/conexion.php'; // Incluir la conexión a la base de datos
include '..//components/navbar.php';

$sql = "SELECT nombre, apellido, cuil_cuit, telefono FROM clientes";
$result = $conn->query($sql) // Ejecutar la consulta
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DannaFox - Clientes</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>

<body>
    <div class="container">
        <h2>CLIENTES:</h2>
        <button class="btn btn-primary" onclick="window.location.href='crearcliente.php'">Añadir Cliente</button>
        <input type="text" placeholder="Buscar Cliente" class="form-control" style="width: 200px; display: inline-block; margin-left: 20px;">

        <table class="table table-bordered mt-4">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>CUIL/CUIT</th>
                    <th>Teléfono</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Verificar si hay resultados en la consulta
                if ($result->num_rows > 0) {
                    // Recorrer los resultados y mostrarlos en la tabla
                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        echo "<tr>";
                        echo "<td>" . $row['nombre'] . "</td>";
                        echo "<td>" . $row['apellido'] . "</td>";
                        echo "<td>" . $row['cuil_cuit'] . "</td>";
                        echo "<td>" . $row['telefono'] . "</td>";
                        echo "<td>
                            <button class='btn btn-info btn-sm'>✏️</button>
                            <button class='btn btn-danger btn-sm'>🗑️</button>
                        </td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='5'>No hay clientes registrados.</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

</body>

</html>

<?php
// Cerrar la conexión (no es estrictamente necesario con PDO, ya que se cierra automáticamente)
$pdo = null;
?>