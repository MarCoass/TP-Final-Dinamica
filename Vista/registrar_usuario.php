<?php
include_once '../Control/AbmUsuario.php';
include_once '../Modelo/Usuario.php';
include_once '../Modelo/Conector/BaseDatos.php';
include_once '../Control/Session.php';
include_once 'Login.php';
//include_once '../configuracion.php';
include_once '../Util/funciones.php';
$datos = data_submitted();
$sesion = new Session();
$name = md5($datos['usuario_nuevo']);
$pass = md5($datos['password_nuevo']);
$sesion->iniciar($name, $pass);
$obj_Controlador = new Usuario();
$obj_Controlador->setear(null, $name, $pass, $name, date('Y-m-d'));
$obj_Controlador->insertar();
$obj_Controlador->getusmail();
?>

<script>
window.location.href = "http://localhost/TP-Final-Dinamica/Vista/Login.php";
</script>


