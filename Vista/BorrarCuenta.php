<?php
include ('Common/Header.php');
//usuario activo
$usuarioActivo = $objSession->getUsuario();

//para deshabilitar la cuenta debo modificar usdeshabilitado a la fecha actual

$usuarioActivo->setUsdeshabilitado(date("Y-m-d H:i:s"));


//modifico el usuario
$usuarioActivo->modificar();

//cierro la session
$objSession->cerrar();

header($INICIO);//ESTO REDIRECCIONA AL LOGIN 