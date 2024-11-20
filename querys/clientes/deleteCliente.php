<?php
// ELIMINAR CLIENTE

if (isset($_POST['eliminar'])){
    $cuil_cuit = $_POST['cuil_cuit'];

    $deleteQuery = "DELETE FROM clientes WHERE cuil_cuit = ? ";
    $stmt = $conn -> prepare(query:$deleteQuery);
    $stmt -> bind_param('s', $cuil_cuit);

    if ($stmt -> execute()) {
        header('Location: clientes.php?success=true&operation=delete');
        exit;
    } else {
        echo "Error al eliminar el cliente: " . $conn->error;
    }
}

?>