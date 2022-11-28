<?php
include_once("../../configuracion.php");
$datos=data_submitted();
$objMenu=new C_Menu();
$menuModificado=$objMenu->modificacion($datos);

$rolAgregado=$objMenu->modificarRoles($datos);