<?php
//echo $_SESSION['ROOT'].'Modelo/';
$objSession = new Session();
$menues = [];

if ($objSession->activa()) {
    $idRoles = $objSession->getOtroRol();
    
    $objMenuRol = new C_Menurol();
    $menues = $objMenuRol->menuesByIdRol($idRoles);
    $objMenu = new C_Menu();
    $htmlMenu = $objMenu->armarMenu($menues) . "<div class='col-md-3 text-end'><button class='btn btn-outline-dark mx-3'>Perfil</button><a href='cerrarSesion.php'><button class='btn btn-outline-dark'>Cerrar Session</button></a></div>";
    
} else {
    $aux = "<div class='col-md-3 text-end'><button class='btn btn-outline-dark'>Iniciar sesion</button></div>";
    $htmlMenu = $aux;
}
?>



<div class="navbar mx-3" id="">
    <?php echo $htmlMenu ?>
</div>