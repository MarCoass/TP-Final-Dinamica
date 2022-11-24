<?php
include_once("Common/Header.php");

include_once '../Control/C_Producto.php';

$datos = data_submitted();
$obj_producto = new C_Producto();
if(isset($datos['id_producto']) && isset($datos['cantidad'])){
	$id_producto = $datos['id_producto'];
	$cantidad = $datos['cantidad'];
	$result = $obj_producto->validar_stock_producto_por_cantidad($id_producto,$cantidad);

	if($result){
		$sesion->insertar_producto_carrito($datos);
	}
}
	

header("Location: ".$_SERVER['HTTP_REFERER']."");
?>



