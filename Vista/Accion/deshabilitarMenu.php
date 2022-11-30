<?php
include_once("../../configuracion.php");

$datos=data_submitted();
$objMenu=new C_Menu();
$deshabilitado=$objMenu->deshabilitar($datos);

?>