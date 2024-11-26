<?php

if (isset($_POST['crear_campania'])) {
    $cliente_id = intval($_POST['cliente']);
    $text_SMS = trim($_POST['texto_SMS']);
    $cantidad_mensajes = intval($_POST['cantidad']);
    $nombre_campania = trim($_POST['nombre_campania']);
    $estado = trim($_POST['estado']);
    $fecha_inicio = trim($_POST['fecha_inicio']);
    
    $checkQuery = "SELECT * FROM campanias WHERE nombre_campania = ?";
    $stmtCheck = $conn->prepare($checkQuery);
    $stmtCheck->bind_param('s', $nombre_campania);
    $stmtCheck->execute();
    $result = $stmtCheck->get_result();

    // Verificar si campania_localidades está definida y es un array
    if (isset($_POST['campania_localidades']) && is_array($_POST['campania_localidades'])) {
        // Procesar las localidades
        $localidades = array_map('intval', $_POST['campania_localidades']); // Convertir a enteros
    } else {
        $localidades = []; 
    }

    if ($result->num_rows > 0) {
        
        $error_campania = "El nombre de la campaña ya está registrado. Ingrese otro";
        $nombre_campania = " ";
    } else {
        // Inserta nuevo cliente si no existe un dni
        $insertQuery = "INSERT INTO campanias (cliente_id, texto_SMS, cantidad_mensajes, nombre_campania, estado, fecha_inicio) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($insertQuery);
        $stmt->bind_param('isssss', $cliente_id, $text_SMS, $cantidad_mensajes, $nombre_campania, $estado, $fecha_inicio);

        if ($stmt->execute()) {
            $campania_id = $stmt->insert_id; // Obtener el ID de la campaña insertada
    
            // Insertar las localidades en la tabla campanias_localidades
            if (!empty($localidades)) {
                $localidadInsertQuery = "INSERT INTO campanias_localidades (id_campania, id_localidad) VALUES (?, ?)";
                $stmtLocalidad = $conn->prepare($localidadInsertQuery);
    
                foreach ($localidades as $localidad_id) {
                    $stmtLocalidad->bind_param('ii', $campania_id, $localidad_id);
                    $stmtLocalidad->execute();
                }
            }
    
            // Redirigir al usuario a una página específica después de crear la campaña
            header('Location: campanias.php?success=true&operation=create');
            exit;
        } else {
            echo "Error: " . $conn->error;
        }
    }
}
?>