<?php
include '..//components/navbar.php';
include '..//db/conexion.php';

$sql = "SELECT * FROM clientes";
$result = $conn->query($sql); 

if(isset($_POST['agregar'])){
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $razon_social = $_POST['razon_social'];
    $cuil_cuit = $_POST['cuil_cuit'];
    $telefono = $_POST['telefono'];
    $email = $_POST['email'];
    
    $insertQuery = "INSERT INTO clientes (nombre, apellido, razon_social, cuil_cuit, telefono, email) VALUES ('$nombre', '$apellido', '$razon_social', '$cuil_cuit',  '$telefono', '$email')";
    
    $conn -> query($insertQuery);

    header(header: 'Location: crearcliente.php');
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DannaFox - Nueva Campaña</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>

<body>
    <div class="container text-center mt-5">
        <h2>AÑADIR CLIENTE</h2>
        <div class="d-grid gap-3 col-6 mx-auto mt-5">
            <h3>Información del Cliente:</h3>

            <form method="POST">
                <!-- Nombre y Apellido -->
                <div class="row mb-3">
                    <div class="col">
                        <label for="nombre">Nombre:</label>
                        <input type="text" class="form-control" name="nombre" id="nombre" required>
                    </div>
                    <div class="col">
                        <label for="apellido">Apellido:</label>
                        <input type="text" class="form-control" name="apellido" id="apellido" required>
                    </div>
                </div>

                <!-- CUIL / CUIT y Razón Social -->
                <div class="row mb-3">
                    <div class="col">
                        <label for="cuil_cuit">CUIL / CUIT:</label>
                        <input type="text" class="form-control" name="cuil_cuit" id="cuil_cuit" required>
                    </div>
                    <div class="col">
                        <label for="razon_social">Razón Social:</label>
                        <input type="text" class="form-control" name="razon_social" id="razon_social" required>

                    </div>
                </div>

                <!-- Teléfono y Email -->
                <div class="row mb-3">
                    <div class="col">
                        <label for="telefono">Teléfono:</label>
                        <input type="text" class="form-control" name="telefono" id="telefono" required>
                    </div>
                    <div class="col">
                        <label for="email">Email:</label>
                        <input type="email" class="form-control" name="email" id="email" required>
                    </div>
                </div>

                <!-- Botón de Enviar -->
                <div class="mt-4">
                    <button type="submit" class="btn btn-primary" name="agregar">Añadir Cliente</button>
                </div>

            </form>
        </div>
    </div>

</body>

</html>