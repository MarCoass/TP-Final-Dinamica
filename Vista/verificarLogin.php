<?php
//agregar confi
include_once("Common/Header.php");
include_once '../Control/AbmUsuario.php';
include_once '../Modelo/Usuario.php';
include_once '../Modelo/conector/BaseDatos.php';
include_once '../Control/Session.php';
include_once '../Util/funciones.php';

$datos = data_submitted();
$name = $datos['usuario'];
$pass = md5($datos['password']);

$sesion->setUserName($name);
$sesion->setPass($pass);
list($valido, $error) = $sesion->validar();

if ($valido) {
    header("Location:Home.php");
} else {
    $sesion->cerrar();
    header("Location:login.php?error=" . urlencode($error));
}