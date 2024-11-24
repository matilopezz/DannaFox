<?php
include 'components/navbar.php';
include 'auth.php';

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DannaFox - Home</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="styles/stylesheet.css">
</head>

<body>

    <!-- Contenido principal -->
    <div class="container text-center mt-5">
    <h2 class="mt-5" style="color: black;; font-size: 60px;">MENÚ</h2>
    <hr class="my-4" style="width: 50%; margin: auto;">

        <div class="d-grid gap-3 col-6 mx-auto mt-5">
            <a href="pages/clientes.php" class="btn-steel-blue btn btn-lg">GESTIONAR CLIENTES</a>
            <a href="pages/campanias.php" class=" btn-steel-blue btn btn-lg">GESTIONAR CAMPAÑAS PUBLICITARIAS</a>
        </div>
    </div>
</body>

</html>