<?php
//agregar confi
include_once("Common/Header.php");

$datos = data_submitted();
$name = $datos['usuario'];
$pass = md5($datos['password']);

$sesion->setUserName($name);
$sesion->setPass($pass);
list($valido, $error) = $sesion->validar();

if ($valido) {
    $sesion->iniciar_carrito();
    header("Location:Home.php");
} else {
    $sesion->cerrar();
    header("Location:login.php?error=" . urlencode($error));
}