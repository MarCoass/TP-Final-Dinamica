<?php
include_once('../configuracion.php');
$sesion = new Session();
$sesion->cerrar();
$message = "Sesión cerrada";
header('Location: login.php?message=' . urlencode($message));
