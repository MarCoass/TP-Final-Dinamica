<?php

include_once("../Common/Header.php");

$datos = data_submitted();
$objCompraEstado = new C_Compraestado();

$fecha = new DateTime();
$fechaStamp = $fecha->format('Y-m-d H:i:s');

$compraEstado = $objCompraEstado->buscar($datos);
$paramCompraEstadoNuevo = [
    "idcompraestado" => $datos["idcompraestado"],
    "idcompra" => $datos["idcompra"],
    "idcompraestadotipo" => $datos["idcompraestadotipo"],
    "cefechaini" => $fechaStamp,
    "cefechafin" => null,
];

$objCompraEstado->modificacion($paramCompraEstadoNuevo);
