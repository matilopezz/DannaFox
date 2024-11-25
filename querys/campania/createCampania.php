    <?php
    
    if(isset($_POST['crear_campania'])){
        $cliente_id = trim($_POST['cliente']);
        $text_SMS = trim($_POST['texto_SMS']);
        $localidad_id = implode(',' , $_POST['localidades']);  // Convierte el array en una cadena separada por comas
        $cantidad_mensajes = intval($_POST['cantidad']);
        $nombre_campania = trim($_POST['nombre_campania']);
        $estado = trim($_POST['estado_campania']);
        $fecha_inicio = trim($_POST['fecha_inicio']);

        
        $insertQuery = "INSERT INTO campanias (cliente_id, texto_SMS, localidad_id, cantidad_mensajes, nombre_campania, estado, fecha_inicio) VALUES (?, ?, ?, ?, ?, ?, ?)";
        
        $stmt = $conn -> prepare($insertQuery);
        $stmt -> bind_param('sssssss', $cliente_id, $text_SMS, $localidad_id, $cantidad_mensajes, $nombre_campania, $estado, $fecha_inicio);

        if ($stmt-> execute()){
            header('Location: crearcampania.php?success=true&operation=create');
            exit;
        } else {
            echo "Error: " . $conn->error;
        }
        
    }?>