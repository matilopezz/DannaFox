<?php

include '..//db/conexion.php'; // Incluir la conexión a la base de datos
include '..//components/navbar.php';

$sql = "SELECT * FROM clientes";
$result = $conn->query($sql);

// ELIMINAR CLIENTE

if(isset($_POST['eliminar'])){
    $cuil_cuit = $_POST['cuil_cuit'];
    
    $insertQuery = "DELETE FROM clientes WHERE cuil_cuit = '$cuil_cuit'";
    
    $conn -> query($insertQuery);

    header(header: 'Location: clientes.php');
}

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
    <div class="container d-flex flex-column align-items-center">
        <h2 class="mt-5">LISTA DE CLIENTES:</h2>
        <button class="btn btn-primary mt-4" onclick="window.location.href='crearcliente.php'">Añadir Cliente</button>
        <input type="text" placeholder="Buscar Cliente" class="form-control mt-4" style="width: 500px; display: inline-block; margin-left: 20px;">

        <table class="table table-bordered pt-3 mt-5">
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
            <tbody>
                <?php while($row = $result->fetch_assoc()): ?>
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
                            <a href="modificarcliente.php?cuil_cuit=<?php echo $row['cuil_cuit']; ?>" class="ms-3">                            <button class="btn btn-primary btn-sm">Modificar</button></a>

                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>

</body>

</html>

<?php
// Cerrar la conexión (no es estrictamente necesario con PDO, ya que se cierra automáticamente)
$pdo = null;
?>