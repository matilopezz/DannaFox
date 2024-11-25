<?php
include '..//db/conexion.php';
include '..//components/navbar.php';
include '../auth.php';
include '..//querys/clientes/createCliente.php';
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DannaFox - Nuevo Cliente</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../styles/stylesheet.css">
</head>

<body>

    <div class="container text-center mt-5">
        <h2>AÑADIR CLIENTE</h2>
        <div class="d-grid gap-3 col-6 mx-auto mt-5">
            <h3>Información del Cliente:</h3>

            <form id="formCliente" method="POST">
                <!-- Nombre y Apellido -->
                <div class="row mb-3">
                    <div class="col">
                        <label for="nombre">Nombre:</label>
                        <input type="text" class="form-control" name="nombre" id="nombre" required maxlength="50"  pattern="[A-Za-z\s]+"  title="Debe ingresar carácteres." value="<?php echo isset($nombre) ? htmlspecialchars($nombre) : ''; ?>">
                    </div>
                    <div class="col">
                        <label for="apellido">Apellido:</label>
                        <input type="text" class="form-control" name="apellido" id="apellido" required maxlength="50"  pattern="[A-Za-z\s]+" title="Debe ingresar carácteres." value="<?php echo isset($apellido) ? htmlspecialchars($apellido) : ''; ?>">
                    </div>
                </div>

                <!-- CUIL / CUIT y Razón Social -->
                <div class="row mb-3">
                    <div class="col">
                        <label for="cuil_cuit">CUIL / CUIT:</label>
                        <input type="text" class="form-control" name="cuil_cuit" id="cuil_cuit" required minlength="10" maxlength="10" pattern="\d+" title="Debe ingresar números." value="<?php echo isset($cuil_cuit) ? htmlspecialchars($cuil_cuit) : ''; ?>">
                        <?php if (isset($error_message)) { ?>
                            <span id="cuilError" style="color: red;"><?php echo $error_message; ?></span>
                        <?php } ?>
                    </div>
                    <div class="col">
                        <label for="razon_social">Razón Social:</label>
                        <input type="text" class="form-control" name="razon_social" id="razon_social" required maxlength="100"  pattern="[A-Za-z\s]+"  title="Debe ingresar carácteres." value="<?php echo isset($razon_social) ? htmlspecialchars($razon_social) : ''; ?>">

                    </div>
                </div>

                <!-- Teléfono y Email -->
                <div class="row mb-3">
                    <div class="col">
                        <label for="telefono">Teléfono:</label>
                        <input type="text" class="form-control" name="telefono" id="telefono" required maxlength="20" pattern="\d+" title="Debe ingresar números." value="<?php echo isset($telefono) ? htmlspecialchars($telefono) : ''; ?>">
                    </div>
                    <div class="col">
                        <label for="email">Email:</label>
                        <input type="email" class="form-control" name="email" id="email" required maxlength="100" value="<?php echo isset($email) ? htmlspecialchars($email) : ''; ?>">
                        <span id="error" style="color: red; display: none;">Correo inválido</span>
                    </div>
                </div>

                <!-- Botón de Enviar -->
                <div class="mt-4">
                    <button type="submit" class="btn-steel-blue btn" name="agregar">Añadir Cliente</button>
                </div>

            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="../js/alertas.js"></script>
    <script src="../js/validacionEmailCLiente.js"></script>
</body>

</html>