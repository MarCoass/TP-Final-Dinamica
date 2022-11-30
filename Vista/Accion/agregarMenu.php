<?php
include_once("../Common/Header.php");
include_once("../../configuracion.php");

$datos = data_submitted();
$name = $datos['menombre'];
$desc = $datos['medescripcion'];
$padre = $datos['padre'];
if ($datos['padre']=="no"){
    $padre=null;
} else {
    $padre= $datos['idpadre'];
}
$script = $datos['script'];
$roles = $datos['rol'];
$obj_Menu = new C_Menu();
$existe_menu = $obj_Menu->buscar(array('menombre' => $name,'medescripcion' => $desc));

if(!isset($existe_menu)){

$obj_Menu->alta(array('menombre' => $name,'medescripcion' => $desc,'idpadre'=>$padre, 'script'=>$script));

$param = array();
$param['menombre'] = $name;
$param['medescripcion'] = $desc;
$param['idpadre'] = $padre;
$menu = $obj_Menu->buscar($param);

$obj_MenuRol = new C_Menurol();
foreach($roles as $rol){
    $obj_MenuRol->alta(array('idmenu' => $menu[0]->getidmenu(), 'idrol' => $rol));
}
}

?>

<script>
    window.history.back();
</script>
