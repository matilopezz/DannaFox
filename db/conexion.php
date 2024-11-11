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

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Conexión con BDD correcta.";
} catch (PDOException $e) {
    echo "Error de conexión: " . $e->getMessage();
}
