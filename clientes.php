<?php
// clientes.php
include 'includes/db_connection.php'; // Incluir conexión a DB

// 
$sql = "SELECT nombre, apellido, cuil_cuit, telefono FROM clientes";
$result = $conn->query($sql);
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
    <?php include 'includes/navbar.php'; ?> <!-- IMPORT DE NAVBAR -->
    <div class="container">
        <h2>CLIENTES:</h2>
        <button class="btn btn-primary">Añadir Cliente</button>
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
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
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
$conn->close();
?>
