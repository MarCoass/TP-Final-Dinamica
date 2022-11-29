<?php
include_once("../../configuracion.php");

$datos=data_submitted();
$objMenu=new C_Menu();
$mwnuHabilitado=$objMenu->habilitar($datos);

?>