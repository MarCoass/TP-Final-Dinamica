<?php 
include_once("Common/Header.php");
$obj_compra = new C_Compra();
$obj_estado = new C_Compraestado();
$compra_borrador = $obj_compra->obtener_compra_borrador_de_usuario($sesion->getIdUser());
$estado = $obj_estado->buscar(array('idcompra' => $compra_borrador[0]->getIdcompra() ));
$param = array(
    'idcompraestado' => $estado[0]->getIdcompraestado(),
    'idcompra' => $compra_borrador[0]->getIdcompra(),
    'cefechaini' => $estado[0]->getCefechaini(),
    'cefechafin' => date('Y-m-d H:i:s')
);

$obj_estado->modificacion($param);

?>


<script>
window.history.back();
</script>