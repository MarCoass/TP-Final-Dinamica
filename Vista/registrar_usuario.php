<?php
include_once("Common/Header.php");

include_once '../Control/AbmUsuario.php';
include_once '../Modelo/Usuario.php';
include_once '../Modelo/UsuarioRol.php';
include_once '../Modelo/Conector/BaseDatos.php';
include_once '../Modelo/UsuarioRol.php';
include_once 'Login.php';

$datos = data_submitted();
$name = $datos['usuario_nuevo'];
$pass = md5($datos['password_nuevo']);
$mail = $datos['mail_nuevo'];
$sesion->iniciar($name, $pass);
$obj_Usuario = new Usuario();
$obj_Usuario->setear(null, $name, $pass, $mail,NULL);
$obj_Usuario->insertar();

$obj_AbmUsuario = new AbmUsuario();
$param = array();
$param['usnombre'] = $name;
$param['uspass'] = $pass;
$param['usmail'] = $mail;
$usuario = $obj_AbmUsuario->buscar($param);

$obj_UsuarioRol = new UsuarioRol();
$obj_UsuarioRol->cargar(null, $usuario[0]->getidusuario(), '3');
$obj_UsuarioRol->insertar();

//falta registrar el rol del usuario.
?>


