<?php
include_once('../Common/Header.php');

$usuario = $sesion->getUsuario();

$obj_compra = new C_Compra();
$obj_estado = new C_Compraestado();
$obj_compra_item = new C_Compraitem();
$compra_borrador = $obj_compra->obtener_compra_borrador_de_usuario($sesion->getIdUser());

if($compra_borrador != null){
$estado = $obj_estado->buscar(array('idcompra' => $compra_borrador[0]->getIdcompra() ));

$param_estado_anterior = array(
        'idcompraestado' => NULL,
        'idcompra' =>  $compra_borrador[0]->getIdcompra(),
        'idcompraestadotipo' => 0,
        'cefechaini' => $estado[0]->getCefechaini(),
        'cefechafin' => date('Y-m-d H:i:s')
);

$obj_estado->alta($param_estado_anterior);
//es un update
$param_estado_nuevo = array(
    'idcompraestado' => $estado[0]->getIdcompraestado(),
    'idcompra' => $compra_borrador[0]->getIdcompra(),
    'idcompraestadotipo' => 1,
    'cefechaini' => $estado[0]->getCefechaini(),
    'cefechafin' => NULL
);

$obj_estado->modificacion($param_estado_nuevo);

//2) Actualizo el stock 
$productos_compra = $obj_compra_item->buscar(array('idcompra' => $compra_borrador[0]->getIdcompra()));

foreach($productos_compra as $indice => $prd){

        $producto = $prd->getIdproducto();

        $producto->setProcantstock($producto->getProcantstock()-$prd->getCicantidad());
        //modifico el stock
        $producto->modificar();
}
}
