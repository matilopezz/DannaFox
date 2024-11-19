<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header("Location: /DannaFox/login.php");
    exit();
}
?>
