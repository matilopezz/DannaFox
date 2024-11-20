<?php
function mostrarBotonVolver() {
    $exclusiones = ['/', '/DannaFox/index.php', '/DannaFox/login.php'];
    return !in_array($_SERVER['REQUEST_URI'], $exclusiones);
}
?>
<header class="header">
    <div class="logo">
        <a class="navbar-brand" href="/DannaFox/index.php">DannaFox</a>
    </div>
    <nav class="navbar navbar-expand-lg navbar-dark custom-navbar">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link nav-link-custom" href="/DannaFox/pages/clientes.php">CLIENTES</a>
            </li>
            <li class="nav-item">
                <a class="nav-link nav-link-custom" href="/DannaFox/pages/campanias.php">CAMPAÑAS</a>
            </li>
        </ul>
        <?php if (mostrarBotonVolver()): ?>
            <button onclick="history.back()" class="btn btn-back btn-sm">Volver atrás</button>
        <?php endif; ?>
        <a href="/DannaFox/components/logout.php" class="btn btn-danger btn-sm">Cerrar Sesión</a>
    </nav>
</header>