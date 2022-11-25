<?php
include_once('../Common/Header.php');

$usuario = $sesion->getUsuario();

//1) Creo una compra con estado = 1 
$objCompra = new C_Compra();

$fecha = new DateTime();
$fechaStamp = $fecha->format('Y-m-d H:i:s');
$objCompra->alta(['idcompra'=> null, 'cofecha'=>$fechaStamp, 'idusuario'=>$usuario->getIdusuario()]);

$aux = $objCompra->buscar(['cofecha'=> $fechaStamp, 'idusuario'=>$usuario->getIdusuario()]);
//print_r($aux[0]->getIdcompra());

$objCompraEstado = new C_Compraestado();
$objCompraEstado->alta(['idcompraestado'=>null, 'idcompra'=>$aux[0]->getIdcompra(), 'idcompraestadotipo'=>1, 'cefechaini'=>$fechaStamp, 'cefechafin'=>null]);
//2) Actualizo el stock

$objProducto = new C_Producto();
$arrayProductos = $sesion->obtener_carrito()['productos'];
print_r($arrayProductos);
foreach ($arrayProductos as $key => $value) {
    echo "ACA";
        //key es el id del producto
        $producto = $objProducto->buscar(['idproducto' => $key])[0];
        $producto->setProcantstock($producto->getProcantstock()-1);
        //modifico el stock
        $producto->modificar();
}

//3) Vacio el carrito
$sesion->setear_carrito();

//4) Redirect a Mis Compras (?)
