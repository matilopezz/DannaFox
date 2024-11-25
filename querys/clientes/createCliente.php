<?php
   
if(isset($_POST['agregar'])){
    $nombre = trim($_POST['nombre']);
    $apellido = trim($_POST['apellido']);
    $razon_social = trim($_POST['razon_social']);
    $cuil_cuit = trim($_POST['cuil_cuit']);
    $telefono = trim($_POST['telefono']);
    $email = trim($_POST['email']);
    
    //chequea si existe un cuil/cuit  
    $checkQuery = "SELECT * FROM clientes WHERE cuil_cuit = ?";
    $stmtCheck = $conn->prepare($checkQuery);
    $stmtCheck->bind_param('s', $cuil_cuit);
    $stmtCheck->execute();
    $result = $stmtCheck->get_result();

    if ($result->num_rows > 0) {
        // CUIL/CUIT si ya existe envia este mensaje en un span y se limpia el campo para ingresar uno nuevo
        $error_message = "El CUIL/CUIT ya está registrado. Ingrese otro";
        $cuil_cuit = "";
    } else {
        // Inserta nuevo cliente si no existe un dni
        $insertQuery = "INSERT INTO clientes (nombre, apellido, razon_social, cuil_cuit, telefono, email) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($insertQuery);
        $stmt->bind_param('ssssss', $nombre, $apellido, $razon_social, $cuil_cuit, $telefono, $email);

        if ($stmt->execute()) {
            header('Location: crearcliente.php?success=true&operation=create');
            exit;
        } else {
            $error_message = "Error al insertar en la base de datos.";
        }
    }
    
}?>