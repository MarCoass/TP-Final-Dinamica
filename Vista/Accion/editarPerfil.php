<?php
include_once("../../configuracion.php");

$datos = data_submitted();

$datos['uspass'] = md5($datos['uspass']);

$objUsuario = new C_Usuario();
$usuarioModificado = $objUsuario->modificacion($datos);
?>