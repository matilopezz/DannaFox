<?php 

$getCampanias = "SELECT 
    c.campania_id,
    c.nombre_campania,
    c.estado,
    c.fecha_inicio,
    cli.nombre AS nombre_cliente,
    cli.apellido AS apellido_cliente,
    GROUP_CONCAT(l.localidad SEPARATOR ', ') AS nombre_localidad 
FROM 
    campanias c
JOIN 
    campanias_localidades cl ON c.campania_id = cl.id_campania
JOIN 
    localidades l ON cl.id_localidad = l.localidad_id
JOIN 
    clientes cli ON c.cliente_id = cli.cliente_id 
GROUP BY 
    c.campania_id; 

                 ";
$result = $conn->query($getCampanias);

?>