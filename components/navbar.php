<header class="header d-flex justify-content-between align-items-center">
    <div class="logo">
    <a class="navbar-brand" href="/DannaFox/index.php">DannaFox</a>
    </div>

    <nav class="navbar navbar-expand-lg navbar-dark mx-3">

        <ul class="d-flex mx-5">
        <li class="mx-3"><a href="/DannaFox/pages/clientes.php">CLIENTES</a></li>
        <li><a href="/DannaFox/pages/campanias.php">CAMPAÑAS</a></li>
        </ul>


        <?php if ($_SERVER['REQUEST_URI'] !== '/' && $_SERVER['REQUEST_URI'] !== '/DannaFox/index.php' && $_SERVER['REQUEST_URI'] !== '/DannaFox/login.php') : ?>
            <!-- Botón para volver atrás -->
            <button onclick="history.back()" class="btn btn-danger"
                style="
            background-color: #4F847C;
            color: white;
            font-size: 17px;
            border-radius: 4px;
            transition: all 0.2s ease;
            border: none;
            cursor: pointer;
            margin-right: 10px;
        "
                onmouseover="this.style.backgroundColor='#3b6b5e'; this.style.boxShadow='0px 4px 6px rgba(0, 0, 0, 0.1)';"
                onmouseout="this.style.backgroundColor='#4F847C'; this.style.boxShadow='none';">
                Volver atrás
            </button>
        <?php endif; ?>

        <button class="btn btn-danger">Cerrar Sesión</button>
    </nav>

</header>