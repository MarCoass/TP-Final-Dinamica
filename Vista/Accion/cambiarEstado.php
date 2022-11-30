<?php

include_once("../Common/Header.php");

$datos = data_submitted();
$obj_estado = new C_Compraestado();
$obj_compra = new C_Compra();
$obj_compra_item = new C_Compraitem();
//falta verificar a que tipo de estado se quiere transferir
// si es de tipo 4 osea cancelar solo debe permitirlo si la compara tiene
// estado uno sino no

//si se desea cancelar una compra de estado uno
//se debe registrar el estado aterior y registrar el nuevo estado de la compra
//luego de eso el stock de la compra vuelve a los productos de la pagina


$compra = $obj_compra->buscar(array('idcompra'=> $datos["idcompra"]));

if($compra != null){
    $estado = $obj_estado->buscar(array('idcompra' =>  $datos["idcompra"] ));
    if($datos["idcompraestadotipo"] == 4){
        $param_estado_anterior = array(
            'idcompraestado' => NULL,
            'idcompra' =>   $datos["idcompra"],
            'idcompraestadotipo' => 1,
            'cefechaini' => $estado[0]->getCefechaini(),
            'cefechafin' => date('Y-m-d H:i:s')
        );
        
        $obj_estado->alta($param_estado_anterior);

        $param_estado_nuevo = array(
            'idcompraestado' => $estado[0]->getIdcompraestado(),
            'idcompra' => $datos["idcompra"],
            'idcompraestadotipo' => $datos["idcompraestadotipo"] ,
            'cefechaini' => $estado[0]->getCefechaini(),
            'cefechafin' => NULL
        );

        
        $obj_estado->modificacion($param_estado_nuevo);

     
        $productos_compra = $obj_compra_item->buscar(array('idcompra' =>$datos["idcompra"]));
    
        foreach($productos_compra as $indice => $prd){
        
                $producto = $prd->getIdproducto();
              
                $producto->setProcantstock($producto->getProcantstock()+$prd->getCicantidad());
               
                //modifico el stock
                $producto->modificar();
        }
    }

    if($datos["idcompraestadotipo"] == 1){
            $param_estado_anterior = array(
                'idcompraestado' => NULL,
                'idcompra' =>   $datos["idcompra"],
                'idcompraestadotipo' => 4,
                'cefechaini' => $estado[0]->getCefechaini(),
                'cefechafin' => date('Y-m-d H:i:s')
            );
            
            $obj_estado->alta($param_estado_anterior);
    
            $param_estado_nuevo = array(
                'idcompraestado' => $estado[0]->getIdcompraestado(),
                'idcompra' => $datos["idcompra"],
                'idcompraestadotipo' => $datos["idcompraestadotipo"] ,
                'cefechaini' => $estado[0]->getCefechaini(),
                'cefechafin' => NULL
            );
    
            
            $obj_estado->modificacion($param_estado_nuevo);
    
         
            $productos_compra = $obj_compra_item->buscar(array('idcompra' => $datos["idcompra"]));
        
            foreach($productos_compra as $indice => $prd){
            
                    $producto = $prd->getIdproducto();
                    if($producto->getProcantstock() >= $prd->getCicantidad() || $producto->getProcantstock() <= $prd->getCicantidad()){
	
                    $producto->setProcantstock($producto->getProcantstock()-$prd->getCicantidad());
                   
                    //modifico el stock
                    $producto->modificar();
                    }
            }
        }
   
}
?>
<script>
window.history.back();
</script>
    