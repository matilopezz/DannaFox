<?php
// modificarcliente.php
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DannaFox - Modificar Cliente</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <?php include 'includes/navbar.php'; ?> <!-- IMPORT DE NAVBAR -->

    <div class="container mt-5">
        <h2>Actualizar Cliente</h2>
        <form action="procesar_cliente.php" method="POST"> <!-- Cambia la acción al archivo PHP que procesará los datos -->
            <div class="form-group">
                <label for="nombre">Nombre:</label>
                <input type="text" id="nombre" name="nombre" required>
            </div>
            <div class="form-group">
                <label for="apellido">Apellido:</label>
                <input type="text" id="apellido" name="apellido" required>
            </div>
            <div class="form-group">
                <label for="cuil_cuit">CUIL/CUIT:</label>
                <input type="text" id="cuil_cuit" name="cuil_cuit" required>
            </div>
            <div class="form-group">
                <label for="razon_social">Razón Social:</label>
                <input type="text" id="razon_social" name="razon_social" required>
            </div>
            <div class="form-group">
                <label for="telefono">Teléfono:</label>
                <input type="text" id="telefono" name="telefono" required>
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="text" id="email" name="email" required>
            </div>
            <button type="submit" class="btn btn-primary btn-block">Actualizar Cliente</button>
    </div>
</body>

</html>