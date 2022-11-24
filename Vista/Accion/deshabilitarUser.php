<?php
include_once("../../configuracion.php");

$datos=data_submitted();
$objUsuario=new C_Usuario();
$deshabilitado=$objUsuario->deshabilitar($datos);

?>