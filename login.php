<?php
session_start();

$VALID_USERNAME = "user";
$VALID_PASSWORD = "1234";

// Verificar si se envió el formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    // Validar credenciales
    if ($username === $VALID_USERNAME && $password === $VALID_PASSWORD) {
        // Crear la sesión para el usuario
        $_SESSION['user'] = $username;
        header("Location: index.php");
        exit();
    } elseif ($username === $VALID_USERNAME) {
        $error = "Contraseña incorrecta. Vuelve a intentarlo.";
    } elseif ($password === $VALID_PASSWORD) {
        $error = "Nombre de usuario incorrecto. Vuelve a intentarlo.";
    } else {
        $error = "Inicio de sesión incorrecto. Vuelve a intentarlo.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="styles/stylesheet.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
    <section>
        <div class="contenedor">
            <h2>Bienvenido de nuevo</h2>
            <?php if (!empty($error)): ?>
                <script>
                    Swal.fire({
                        title: "Error",
                        text: "<?php echo $error; ?>",
                        icon: "error",
                        timer: 2000,
                        timerProgressBar: true,
                        background: '#333333',
                        customClass: {
                            title: 'titulo'
                        }
                    });
                </script>
            <?php endif; ?>
            <form method="POST" action="login.php">
                <div class="input-contenedor">
                    <input type="text" id="username" name="username" required>
                    <label for="username">Usuario</label>
                </div>
                <div class="input-contenedor">
                    <input type="password" id="password" name="password" required>
                    <label for="password">Contraseña</label>
                </div>
                <button type="submit">Iniciar sesión</button>
            </form>
        </div>
    </section>
</body>

</html>