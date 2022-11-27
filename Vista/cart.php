<?php
include_once("Common/Header.php");

include_once '../Control/C_Producto.php';

$datos = data_submitted();
$obj_producto = new C_Producto();

$producto = $obj_producto->buscar(array( 'idproducto' => $datos['id_producto']));

if($producto != null){
	if($producto[0]->getProcantstock() >= $datos['cantidad'] || $producto[0]->getProcantstock() <= $datos['cantidad']){
		$obj_compra = new C_Compra();
		$compra_borrador = $obj_compra->obtener_compra_borrador_de_usuario($sesion->getIdUser());
	
		if(is_array($compra_borrador) && $compra_borrador != null){
			$obj_compra_item = new C_Compraitem();
		
            $productoitem = $obj_compra_item->buscar(['idproducto' => $datos['id_producto'],'idcompra' => $compra_borrador[0]->getIdcompra()]);
            
			if(is_array($productoitem) && $productoitem != null){
				$productoitem = $productoitem[0];
				$productoitem->setCicantidad($productoitem->getCicantidad()+$datos['cantidad']);
				
				$param = array(
					'idcompraitem' => $productoitem->getIdcompraitem(),
					'idproducto' =>  $datos['id_producto'],
					'idcompra' => $compra_borrador[0]->getIdcompra(),
					'cicantidad' =>$productoitem->getCicantidad()
				);
				$obj_compra_item->modificacion($param);
			}else{
				$obj_compra_item->alta(['idcompraitem'=>NULL, 'idproducto'=>$datos['id_producto'], 'idcompra'=>$compra_borrador[0]->getIdcompra(), 'cicantidad'=>$datos['cantidad']]);
		    }

		}else{

			$compra_borrado = new C_Compra();
            $compra_estado = new C_Compraestado();
			$objCompraItem = new C_Compraitem();

            $param_compra = array(
                'idcompra'  => NULL,
                'cofecha'  => date('Y-m-d H:i:s'),
                'idusuario'  => $sesion->getIdUser(),
            );

            $compra_borrado->alta($param_compra);
            $compra = $compra_borrado->buscar(['cofecha'=> $param_compra['cofecha'], 'idusuario'=>$param_compra['idusuario']]);
     
            $compra_estado->alta(['idcompraestado'=>NULL, 'idcompra'=>$compra[0]->getIdcompra(), 'idcompraestadotipo'=>0, 'cefechaini'=>$param_compra['cofecha'], 'cefechafin'=>NULL]);

			$objCompraItem->alta(['idcompraitem'=>NULL, 'idproducto'=>$datos['id_producto'], 'idcompra'=>$compra[0]->getIdcompra(), 'cicantidad'=>$datos['cantidad']]);
		 
		}
	}
}
	
?>

<script>
window.history.back();
</script>



