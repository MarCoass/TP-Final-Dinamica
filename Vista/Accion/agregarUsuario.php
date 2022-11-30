<?php
include_once("../Common/Header.php");
include_once("../../configuracion.php");

include_once 'Login.php';

$datos = data_submitted();
$name = $datos['nombre'];
$pass = md5($datos['password']);
$mail = $datos['email'];
$rol = $datos['rol'];
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
$obj_UsuarioRol->alta(array('idusuario' => $usuario[0]->getidusuario(), 'idrol' => $rol));
}
?>

<script>
window.history.back();
</script>

