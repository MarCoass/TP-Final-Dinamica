<?php
include_once('../Common/Header.php');

$usuario = $sesion->getUsuario();
$compra = $sesion->obtener_compra_relacionada_a_session();


$objCompraEstado = new C_Compraestado();
$estado = $objCompraEstado->buscar(['idcompra'=>$compra[0]->getIdcompra()]);
//idcompraestado

//$estado->modificacion($param);
//2) Actualizo el stock 

$objProducto = new C_Producto();
$arrayProductos = $sesion->obtener_carrito()['productos'];
print_r($arrayProductos);
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
$sesion->setear_carrito();

//4) Redirect a Mis Compras (?)
