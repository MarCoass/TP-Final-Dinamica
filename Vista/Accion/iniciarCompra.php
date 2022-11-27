<?php
include_once('../Common/Header.php');

$usuario = $sesion->getUsuario();
$compra = $sesion->obtener_compra_relacionada_a_session();


$objCompraEstado = new C_Compraestado();
$estado = $objCompraEstado->buscar(['idcompra'=>$compra[0]->getIdcompra()]);

$param = array(
        'idcompraestado' => $estado[0]->getidcompraestado(),
        'idcompra' => $compra[0]->getIdcompra(),
        'idcompraestadotipo' => 1,
        'cefechaini' =>  $compra[0]->getCofecha,
        'cefechafin' => NULL,
);

$objCompraEstado->modificacion($param);
//2) Actualizo el stock 

$objProducto = new C_Producto();
$arrayProductos = $sesion->obtener_carrito()['productos'];

foreach ($arrayProductos as $key => $value) {
        $cantidad = $sesion->obtener_carrito()['productos'][$key]['cantidad'];
        //key es el id del producto
        $producto = $objProducto->buscar(['idproducto' => $key])[0];
        $producto->setProcantstock($producto->getProcantstock()-$cantidad);
        //modifico el stock
        $producto->modificar();

        //creo objeto compraItem
       
}

//3) Vacio el carrito


//4) Redirect a Mis Compras (?)
