<?php
include_once("../Common/Header.php");

$datos = data_submitted();
$usuario = $sesion->getUsuario();

if($usuario->getUspass() != $datos['uspass']){
    $datos['uspass'] = md5($datos['uspass']);
}

$objUsuario = new C_Usuario();
$usuarioModificado = $objUsuario->modificacion($datos);
?>

<script>
window.history.back();
</script>