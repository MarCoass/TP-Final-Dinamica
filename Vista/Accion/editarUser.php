<?php
include_once("../../configuracion.php");
$datos=data_submitted();
$objUsuario=new C_Usuario();
$usuarioModificado=$objUsuario->modificacion($datos);


$rolAgregado=$objUsuario->modificarRoles($datos);

?>