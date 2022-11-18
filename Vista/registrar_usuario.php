<?php
include_once 'Common/Header.php';
include_once '../Control/AbmUsuario.php';
include_once '../Modelo/Usuario.php';
include_once '../Modelo/UsuarioRol.php';
include_once '../Modelo/Conector/BaseDatos.php';
include_once '../Modelo/UsuarioRol.php';
include_once '../Control/Session.php';
include_once 'Login.php';
include_once '../Util/funciones.php';

$datos = data_submitted();
$sesion = new Session();
$name = md5($datos['usuario_nuevo']);
$pass = md5($datos['password_nuevo']);
$sesion->iniciar($name, $pass);
$obj_Usuario = new Usuario();
$obj_Usuario->setear(null, $name, $pass, $name,null);
$obj_Usuario->insertar();

$obj_AbmUsuario = new AbmUsuario();
$param = array();
$param['usnombre'] = $name;
$param['uspass'] = $pass;
$usuario = $obj_AbmUsuario->buscar($param);

$obj_UsuarioRol = new UsuarioRol();
$obj_UsuarioRol->cargar(null, $usuario[0]->getidusuario(), 1);
$obj_UsuarioRol->insertar();

//falta registrar el rol del usuario.
?>


