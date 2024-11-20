<?php

if (isset($_GET['cuil_cuit'])) {
    $cuil_cuit = $_GET['cuil_cuit'];
    
    // Obtener los datos del cliente con el cuil/cuit
    $query = "SELECT * FROM clientes WHERE cuil_cuit = ?";
    $stmt = $conn->prepare($query);        
    $stmt->bind_param("s", $cuil_cuit);
    $stmt->execute();
    $result = $stmt->get_result();
    $cliente = $result->fetch_assoc();

    if (!$cliente) {
        echo "Cliente no encontrado.";
        exit;
    }
} else {
    echo "CUIL/CUIT de cliente no proporcionado.";
    exit;
}

if (isset($_POST['actualizar'])) {
    $nombre = trim($_POST['nombre']);
    $apellido = trim($_POST['apellido']);
    $razon_social = trim($_POST['razon_social']);
    $cuil_cuit = trim($_POST['cuil_cuit']);
    $telefono = trim($_POST['telefono']);
    $email = trim($_POST['email']);

    $updateQuery = "UPDATE clientes SET nombre = ?, apellido = ?, razon_social = ?, telefono = ?, email = ? WHERE cuil_cuit = ?";
    $stmt = $conn->prepare($updateQuery);
    $stmt->bind_param("ssssss", $nombre, $apellido, $razon_social, $telefono, $email, $cuil_cuit);


    if ($stmt->execute()) {
        header('Location: clientes.php?cuil_cuit=' . $cuil_cuit .'&success=true&operation=update');

    } else {
        echo "Error al actualizar el cliente: " . $conn->error;
    }
}

?>