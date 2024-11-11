<?php
$host = "82.180.153.52";
$dbname = "u269501740_ProyectoLdL";
$user = "u269501740_usuarioLdL";
$password = "ADMINProyectoLdLUNSAdA2024";

try {
    $conexion = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $password);
    $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Conexión con BDD correcta";
} catch (PDOException $e) {
    echo "Error en la conexión: " . $e->getMessage();
}
?>
