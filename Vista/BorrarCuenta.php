<?php
include ('Common/Header.php');
//usuario activo
$usuarioActivo = $sesion->getUsuario();

//para deshabilitar la cuenta debo modificar usdeshabilitado a la fecha actual

$usuarioActivo->setUsdeshabilitado(date("Y-m-d H:i:s"));


//modifico el usuario
$usuarioActivo->modificar();

//cierro la session
$sesion->cerrar();
?>
<script>
            window.location.href = "/TP-Final-Dinamica/Vista/Login.php";
</script>