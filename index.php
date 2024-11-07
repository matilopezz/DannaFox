<?php
// index.php
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DannaFox - Home</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <?php include 'includes/navbar.php'; ?> <!-- IMPORT DE NAVBAR -->

    <!-- Contenido principal -->
    <div class="container text-center mt-5">
        <h2>MENU</h2>
        <hr class="my-4" style="width: 50%; margin: auto;">

        <div class="d-grid gap-3 col-6 mx-auto mt-5">
            <a href="clientes.php" class="btn btn-primary btn-lg">GESTIONAR CLIENTES</a>
            <a href="campanias.php" class="btn btn-primary btn-lg">GESTIONAR CAMPAÑAS PUBLICITARIAS</a>
        </div>
    </div>
</body>

</html>