<?php
// Verificar el número de campañas activas con nombres de variables únicos
$queryCampaniasActivas = "SELECT 
    COUNT(*) as total
FROM 
    campanias c
WHERE estado IN ('creada','ejecucion')";

$resultCampanias = $conn->query($queryCampaniasActivas);
$rowCampanias = $resultCampanias->fetch_assoc();


// Número de campañas activas
$totalCampaniasActivas = $rowCampanias['total'];

// Definir el límite de campañas activas
$limiteCampanias = 10;

// Bandera para mostrar o no el botón
$mostrarBotonCampanias = $totalCampaniasActivas < $limiteCampanias;
?>
