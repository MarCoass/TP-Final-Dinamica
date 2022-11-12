<?php
//agregar confi
include_once '../Control/AbmUsuario.php';
include_once '../Modelo/Usuario.php';
include_once '../Modelo/conector/BaseDatos.php';

$datos = data_submitted();
$sesion = new Session();
$name = md5($datos['usuario']);
$pass = md5($datos['password']);
$sesion->iniciar($name, $pass);
list($valido, $error) = $sesion->validar();

if ($valido) {
    header("Location:paginaSegura.php");
} else {
    $sesion->cerrar();
    header("Location:login.php?error=" . urlencode($error));
}