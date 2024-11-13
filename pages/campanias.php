<?php
// campanias.php
include '..//db/conexion.php'; // Incluir la conexión a la base de datos
include '..//components/navbar.php';


$sql = "SELECT campania_id, nombre_campania, estado, fecha_inicio FROM campanias";
$result = $conn->query($sql)
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DannaFox - Campañas</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../styles/stylesheet.css">
</head>

<body>
    <div class="container d-flex flex-column align-items-center">
        <h2 class="mt-5">CAMPAÑAS:</h2>
        <button class="btn-steel-blue btn  mt-4" onclick="window.location.href='crearcampania.php'">Añadir Campaña</button>
        <input type="text" placeholder="Buscar Cliente" class="form-control mt-4" style="width: 200px; display: inline-block; margin-left: 20px;">


        <table class="table table-bordered mt-4">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Campaña</th>
                    <th>Estado</th>
                    <th>Fecha de Inicio</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Verificar si hay resultados en la consulta
                if ($result->num_rows > 0) {
                    // Recorrer los resultados y mostrarlos en la tabla
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row['nombre_campania'] . "</td>";
                        echo "<td>" . $row['nombre_campania'] . "</td>"; 
                        echo "<td>" . $row['estado'] . "</td>";
                        echo "<td>" . $row['fecha_inicio'] . "</td>";
                        echo "<td>
                                <button class='btn btn-info btn-sm'>✏️</button>
                                <button class='btn btn-danger btn-sm'>🗑️</button>
                              </td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='5'>No hay campañas registradas.</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

</body>

</html>

<?php
// Cerrar la conexión
$conn->close();
?>