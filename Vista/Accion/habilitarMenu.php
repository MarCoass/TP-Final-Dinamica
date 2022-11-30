<?php
include_once("../../configuracion.php");

$datos=data_submitted();
$objMenu=new C_Menu();
$menuHabilitado=$objMenu->habilitar($datos);

?>