<?php
include_once("Common/Header.php");
include_once 'Login.php';

$datos = data_submitted();
$name = $datos['usuario_nuevo'];
$pass = md5($datos['password_nuevo']);
$mail = $datos['mail_nuevo'];


$obj_Usuario = new C_Usuario();
$obj_AbmUsuario = new AbmUsuario();
$existe_usuario = $obj_AbmUsuario->buscar(array('usnombre' => $name,'usmail' => $mail));

if(count($existe_usuario) == 0){

$obj_Usuario->alta(array('usnombre' => $name,'uspass' => $pass,'usmail'=>$mail));

$param = array();
$param['usnombre'] = $name;
$param['uspass'] = $pass;
$param['usmail'] = $mail;
$usuario = $obj_AbmUsuario->buscar($param);

$obj_UsuarioRol = new C_Usuariorol();
$obj_UsuarioRol->alta(array('idusuario' => $usuario[0]->getidusuario(), 'idrol' => 3));
}
?>
