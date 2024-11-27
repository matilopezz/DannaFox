<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DannaFox</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../styles/stylesheet.css?v=1.0">
</head>

<body>
    <?php
    function mostrarBotonVolver()
    {
        $exclusiones = ['/', '/DannaFox/index.php', '/DannaFox/login.php'];
        return !in_array($_SERVER['REQUEST_URI'], $exclusiones);
    }
    ?>
    <header class="header">
        <?php if (mostrarBotonVolver()): ?>
            <button onclick="history.back()" class="btn btn-yellow btn-sm" style="margin-left: 20px;">Volver atrás</button>
        <?php endif; ?>

        <div class="logo">
            <a class="navbar-brand" href="/DannaFox/index.php"><span class="logo-text"><span class="yellow-text">D</span>anna<span class="yellow-text">F</span>ox</span></a>
        </div>

        <nav class="navbar navbar-dark">
            <div class="container-fluid d-flex justify-content-between align-items-center">
                <!-- menú -->
                <div class="dropdown">
                    <button class="btn btn-steel-blue navbar-toggler" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <!-- Menú desplegable -->
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li>
                            <a class="dropdown-item text-black" href="/DannaFox/pages/clientes.php">Clientes</a>
                        </li>
                        <li>
                            <a class="dropdown-item text-black" href="/DannaFox/pages/campanias.php">Campañas</a>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li>
                            <a class="dropdown-item text-danger" href="/DannaFox/components/logout.php">Cerrar Sesión</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>