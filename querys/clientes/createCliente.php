<?php
   
if(isset($_POST['agregar'])){
    $nombre = trim($_POST['nombre']);
    $apellido = trim($_POST['apellido']);
    $razon_social = trim($_POST['razon_social']);
    $cuil_cuit = trim($_POST['cuil_cuit']);
    $telefono = trim($_POST['telefono']);
    $email = trim($_POST['email']);
    
    $insertQuery = "INSERT INTO clientes (nombre, apellido, razon_social, cuil_cuit, telefono, email) VALUES (?, ?, ?, ?, ?, ?)";
    
    $stmt = $conn -> prepare($insertQuery);
    $stmt -> bind_param('ssssss', $nombre, $apellido, $razon_social, $cuil_cuit, $telefono, $email);

    if ($stmt-> execute()){
        header('Location: crearcliente.php?success=true&operation=create');
        exit;
    } else {
        echo "Error: " . $conn->error;
    }
    
}?>