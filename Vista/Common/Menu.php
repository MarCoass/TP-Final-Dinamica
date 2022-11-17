<?php

$objSession = new Session();
print_r($objSession->activa());
$menues = [];
if ($objSession->activa()) {
    $idRoles = $_SESSION['roles'];
    $objMenuRol = new C_MenuRol();
    $menues = $objMenuRol->menuesByIdRol($idRoles);
    $objMenu = new C_Menu();
    $htmlMenu = $objMenu->armarMenu($menues);
} else {
    $htmlMenu = "Menu vacio o no tenes permiso menso.";
}
?>



<div class="navbar" id="">
    <?php echo $htmlMenu ?>
</div>