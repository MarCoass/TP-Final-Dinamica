<?php
include_once("../Control/Session.php");
$obj_sesion = new Session();
if($obj_sesion->activa()){    
include_once("Common/Header.php");
}else{
    include_once("Common/Header_publico.php");
}
include_once '../Control/AbmUsuario.php';
include_once '../Modelo/Usuario.php';
include_once '../Modelo/UsuarioRol.php';
include_once '../Modelo/Conector/BaseDatos.php';
include_once '../Modelo/UsuarioRol.php';
include_once 'Login.php';
include_once '../Util/funciones.php';

$datos = data_submitted();
$sesion = new Session();
$name = $datos['usuario_nuevo'];
$pass = md5($datos['password_nuevo']);
$sesion->iniciar($name, $pass);
$obj_Usuario = new Usuario();
$obj_Usuario->setear(null, $name, $pass, $name,date('Y-m-d'));
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


