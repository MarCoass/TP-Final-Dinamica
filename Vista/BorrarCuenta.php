<?php
include ('Common/Header.php');
//usuario activo
$usuarioActivo = $objSession->getUsuario();
echo "ANTES: " . $usuarioActivo->getUsdeshabilitado();

//para deshabilitar la cuenta debo modificar usdeshabilitado a la fecha actual

$usuarioActivo->setUsdeshabilitado(date("Y-m-d H:i:s"));
echo "DESPUES: " . $usuarioActivo->getUsdeshabilitado();


//cierro la session
//$objSession->cerrar();

//header($INICIO);//ESTO REDIRECCIONA AL LOGIN 