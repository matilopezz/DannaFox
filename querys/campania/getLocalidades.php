<?php
// Consulta a la base de datos
$getLocalidades = "SELECT localidad_id, localidad FROM localidades";
$result = $conn->query($getLocalidades);

?>
