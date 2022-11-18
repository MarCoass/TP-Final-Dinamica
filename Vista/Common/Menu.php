<?php
//echo $_SESSION['ROOT'].'Modelo/';
$objSession = new Session();
$menues = [];


if ($objSession->activa()) {
    $idRoles = $objSession->getOtroRol();
    
    $objMenuRol = new C_Menurol();
    $menues = $objMenuRol->menuesByIdRol($idRoles);
    $objMenu = new C_Menu();
    $htmlMenu = $objMenu->armarMenu($menues);
} else {
    $htmlMenu ="Armar menu sin permisos";
}
?>



<div class="navbar " id="">
    <?php echo $htmlMenu ?>
</div>