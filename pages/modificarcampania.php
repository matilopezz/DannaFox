<?php
include '../db/conexion.php'; 
include '../components/navbar.php';
include '../auth.php';

// Verificar si se ha enviado el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST["id"];
    $texto_sms = $_POST["texto_sms"];
    $estado = $_POST["estado"];

    // Actualizar la campaña en la base de datos
    $sql = "UPDATE campanias SET texto_sms=?, estado=? WHERE campania_id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssi", $texto_sms, $estado, $id);

    if ($stmt->execute()) {
        // Redirigir a campanias.php después de actualizar
        header("Location: /DannaFox/pages/campanias.php");
        exit();
    } else {
        echo "Error al actualizar la campaña: " . $stmt->error;
    }
    $stmt->close();
}

// Verificar si el parámetro campania_id está presente en la URL
if (isset($_GET["id"])) {
    $id = $_GET["id"];
    $sql = "SELECT texto_sms, estado FROM campanias WHERE campania_id=?";
    $stmt = $conn->prepare($sql);
    if ($stmt === false) {
        die("Error en la preparación de la consulta: " . $conn->error);
    }
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->bind_result($texto_sms, $estado);
    $stmt->fetch();
    $stmt->close();
    $conn->close();
} 
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DannaFox - Actualizar Campaña</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../styles/stylesheet.css?v=1.0">
</head>
<body>
    <div class="container text-center mt-5">
        <h2>ACTUALIZAR CAMPAÑA PUBLICITARIA</h2>
        <div class="d-grid gap-3 col-6 mx-auto mt-5">
            <h4>Información de la campaña publicitaria:</h4>

            <!-- Formulario -->
            <form action="modificarcampania.php" method="POST">
                <input type="hidden" name="id" value="<?php echo $id; ?>">
                <!-- Texto SMS -->
                <div class="row mb-3">
                    <div class="col text-start">
                        <label for="texto_sms">Texto SMS:</label>
                        <textarea class="form-control" id="texto_sms" name="texto_sms" rows="4" required><?php echo $texto_sms; ?></textarea>
                    </div>
                </div>
                <!-- Estado -->
                <div class="row mb-3">
                    <div class="col text-start">
                        <label for="estado">Estado:</label>
                        <select class="form-control" id="estado" name="estado" required>
                            <option value="creada" <?php if ($estado == 'creada') echo 'selected'; ?>>creada</option>
                            <option value="ejecucion" <?php if ($estado == 'ejecucion') echo 'selected'; ?>>ejecucion</option>
                            <option value="finalizada" <?php if ($estado == 'finalizada') echo 'selected'; ?>>finalizada</option>

                        </select>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Actualizar</button>
            </form>
        </div>
    </div>
</body>
</html>