<?php
include_once("../../configuracion.php");
$datos=data_submitted();
$objProducto=new C_Producto();
$objProducto->alta($datos);

?>

<script>
window.history.back();
</script>