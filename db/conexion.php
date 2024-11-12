<?php

// Función para cargar el archivo .env
function loadEnv($path)
{
    if (!file_exists($path)) {
        throw new Exception("El archivo .env no existe en la ruta especificada.");
    }

    $lines = file($path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach ($lines as $line) {
        if (strpos($line, '#') === 0) {
            continue; 
        }
        list($key, $value) = explode('=', $line, 2);
        $_ENV[trim($key)] = trim($value); // Almacenar las variables en $_ENV
    }
}


loadEnv(__DIR__ . '/.env');

// Conexión a la base de datos
$host = $_ENV['DB_HOST'];
$dbname = $_ENV['DB_NAME'];
$user = $_ENV['DB_USER'];
$password = $_ENV['DB_PASSWORD'];

$conn = new mysqli($host, $user, $password, $dbname);

// Verificar si la conexión fue exitosa
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}
