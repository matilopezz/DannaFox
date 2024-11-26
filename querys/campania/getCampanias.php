<?php 

$getCampanias = "SELECT 
    c.campania_id,
    c.nombre_campania,
    c.estado,
    c.fecha_inicio,
    cli.nombre AS nombre_cliente,
    cli.apellido AS apellido_cliente,
    GROUP_CONCAT(l.localidad SEPARATOR ', ') AS nombre_localidad --GROU_CONCAT lo que hace es concatenar los valores del array. 
FROM 
    campanias c
JOIN 
    campanias_localidades cl ON c.campania_id = cl.id_campania  --une campaña_localidades y campanias mediante su id
JOIN 
    localidades l ON cl.id_localidad = l.localidad_id --une campaña_localidades y localidades mediante su id
JOIN 
    clientes cli ON c.cliente_id = cli.cliente_id --une campaña y clientes mediante su id
GROUP BY 
    c.campania_id;  --agrupa todo mediante el id de la campaña

                 ";
$result = $conn->query($getCampanias);

?>