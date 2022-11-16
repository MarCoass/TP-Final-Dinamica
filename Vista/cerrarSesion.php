<?php
//agregar confi

$sesion = new Session();
$sesion->cerrar();
$message = "Sesión cerrada";
header('Location: login.php?message=' . urlencode($message));
