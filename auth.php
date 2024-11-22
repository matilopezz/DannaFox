<?php
session_start();

if (!isset($_SESSION['user'])) {
    header("Location: /DannaFox/login.php");
    exit();
}
?>