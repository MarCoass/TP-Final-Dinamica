<?php
include_once("../../configuracion.php");
$datos=data_submitted();
$objProducto=new C_Producto();
$productoModificado=$objProducto->modificacion($datos);

?>
