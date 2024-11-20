
<?php
   $getClientes = "SELECT cliente_id, CONCAT(nombre, ' ', apellido) AS cliente_nombre, cuil_cuit FROM clientes";
   $result = $conn->query($getClientes);
?>