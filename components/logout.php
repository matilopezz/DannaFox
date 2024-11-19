<?php
session_start(); 
session_destroy(); 
header("Location: /DannaFox/login.php"); 
exit();
?>