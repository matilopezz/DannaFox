<?php
   
if(isset($_POST['agregar'])){
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $razon_social = $_POST['razon_social'];
    $cuil_cuit = $_POST['cuil_cuit'];
    $telefono = $_POST['telefono'];
    $email = $_POST['email'];
    
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