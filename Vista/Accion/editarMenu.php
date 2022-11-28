<?php
include_once("../../configuracion.php");
$datos=data_submitted();
$objMenu=new C_Menu();
$menuModificado=$objMenu->modificacion($datos);

$objMenuRol = new C_Menurol
$menuRol = $objMenuRol->buscar()
$rolAgregado=$objMenu->modificarRoles($datos);