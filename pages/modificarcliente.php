<?php
// modificarcliente.php
include '..//components/navbar.php';
include '..//db/conexion.php';
include '../auth.php';



if (isset($_GET['cuil_cuit'])) {
    $cuil_cuit = $_GET['cuil_cuit'];
    
    // Obtener los datos del cliente con el cuil/cuit
    $query = "SELECT * FROM clientes WHERE cuil_cuit = ?";
    $stmt = $conn->prepare($query);        
    $stmt->bind_param("s", $cuil_cuit);
    $stmt->execute();
    $result = $stmt->get_result();
    $cliente = $result->fetch_assoc();

    if (!$cliente) {
        echo "Cliente no encontrado.";
        exit;
    }
} else {
    echo "CUIL/CUIT de cliente no proporcionado.";
    exit;
}

if (isset($_POST['actualizar'])) {
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $razon_social = $_POST['razon_social'];
    $cuil_cuit = $_POST['cuil_cuit'];
    $telefono = $_POST['telefono'];
    $email = $_POST['email'];

    $updateQuery = "UPDATE clientes SET nombre = ?, apellido = ?, razon_social = ?, telefono = ?, email = ? WHERE cuil_cuit = ?";
    $stmt = $conn->prepare($updateQuery);
    $stmt->bind_param("ssssss", $nombre, $apellido, $razon_social, $telefono, $email, $cuil_cuit);


    if ($stmt->execute()) {
        header('Location: clientes.php?cuil_cuit=' . $cuil_cuit .'&success=true&operation=update');

    } else {
        echo "Error al actualizar el cliente: " . $conn->error;
    }
}

?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DannaFox - Modificar Cliente</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../styles/stylesheet.css">
</head>

<body>
    <div class="container text-center mt-5">
        <h2>ACTUALIZAR CLIENTE</h2>
        <div class="d-grid gap-3 col-6 mx-auto mt-5">
            <h3>Información del Cliente:</h3>

            <form method="POST">
                <input type="hidden" name="cuil_cuit" value="<?php echo $cliente['cuil_cuit']; ?>">

                <!-- Nombre y Apellido -->
                <div class="row mb-3">
                    <div class="col">
                        <label for="nombre">Nombre:</label>
                        <input type="text" class="form-control" name="nombre" id="nombre" required maxlength="50" required value="<?php echo $cliente['nombre']; ?>">
                    </div>
                    <div class="col">
                        <label for="apellido">Apellido:</label>
                        <input type="text" class="form-control" name="apellido" id="apellido" required maxlength="50" required value="<?php echo $cliente['apellido']; ?>">
                    </div>
                </div>

                <!-- CUIL / CUIT y Razón Social -->
                <div class="row mb-3">
                    <div class="col">
                        <label for="cuil_cuit">CUIL / CUIT:</label>
                        <input type="text" class="form-control" name="cuil_cuit" id="cuil_cuit" required maxlength="20" pattern="\d+" title="Por favor, ingrese solo números." value="<?php echo $cliente['cuil_cuit']; ?>">

                    </div>
                    <div class="col">
                        <label for="razon_social">Razón Social:</label>
                        <input type="text" class="form-control" name="razon_social" id="razon_social" required maxlength="100" required value="<?php echo $cliente['razon_social']; ?>">

                    </div>
                </div>

                <!-- Teléfono y Email -->
                <div class="row mb-3">
                    <div class="col">
                        <label for="telefono">Teléfono:</label>
                        <input type="text" class="form-control" name="telefono" id="telefono" required maxlength="20" pattern="\d+" title="Por favor, ingrese solo números." value="<?php echo $cliente['telefono']; ?>">
                    </div>
                    <div class="col">
                        <label for="email">Email:</label>
                        <input type="email" class="form-control" name="email" id="email" required maxlength="100" required value="<?php echo $cliente['email']; ?>">
                    </div>
                </div>

                <!-- Botón de Enviar -->
                <div class="mt-4">
                    <button type="submit" class="btn-steel-blue btn" name="actualizar">Actualizar Cliente</button>
                </div>

            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="../js/alertas.js"></script>

</body>

</html>