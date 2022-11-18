<?php
//echo $_SESSION['ROOT'].'Modelo/';
$objSession = new Session();
$menues = [];

if ($objSession->activa()) {
    $idRoles = $objSession->getOtroRol();
    
    $objMenuRol = new C_Menurol();
    $menues = $objMenuRol->menuesByIdRol($idRoles);
    $objMenu = new C_Menu();
    $htmlMenu = $objMenu->armarMenu($menues) . "<div class='col align-self-end'><button class='btn text-light btn-outline-light mx-3' id='botonLogout'>Perfil</button><button class='btn text-light btn-outline-light'id='botonLogout'>Cerrar Session</button></div>";
    $htmlMenu = $objMenu->armarMenu($menues) . "<div class='col align-self-end'><button class='btn text-light btn-outline-light mx-3'id='botonLogout'>Perfil</button><a href='cerrarSesion.php'><button class='btn text-light btn-outline-light' id='botonLogout'>Cerrar Session</button></a></div>";
    
} else {
    $aux = "<div class='col align-self-end'><button class='btn text-light btn-outline-light' id='botonLogin' >Iniciar sesion</button></div>";
    $htmlMenu = $aux;
}
?>



<div class="navbar mx-3" id="">
    <?php echo $htmlMenu ?>
</div>