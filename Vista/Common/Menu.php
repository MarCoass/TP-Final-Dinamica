<?php
//echo $_SESSION['ROOT'].'Modelo/';
$objSession = new Session();
$menues = [];
if ($objSession->activa()) {
    $idRoles = $objSession->getRol();
    $objMenuRol = new C_Menurol();
    $menues = $objMenuRol->menuesByIdRol($idRoles);
    $objMenu = new C_Menu();
    $htmlMenu = $objMenu->armarMenu($menues);
} else {
    
    $idRoles = [3];
    $objMenuRol = new C_Menurol();
    $menues = $objMenuRol->menuesByIdRol($idRoles);
    $objMenu = new C_Menu();
    $htmlMenu = $objMenu->armarMenu($menues);
}
?>



<div class="navbar " id="">
    <?php echo $htmlMenu ?>
</div>