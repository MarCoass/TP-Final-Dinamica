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
  //  $aux = "<div class='col align-self-end'><button class='btn text-light btn-outline-light' id='botonLogin' >Iniciar sesion</button></div>";
    $aux = "
    <ul class='nav nav-pills '>
    <li class='nav-item dropdown'>
                <a class='nav-link dropdown-toggle text-light fs-5' href='#' role='button' data-bs-toggle='dropdown' aria-expanded='false'>
                    Productos
                </a>
            <ul class='dropdown-menu' id='dropdown'>
                <li><a class='dropdown-item text-light' href='/TP-Final-Dinamica/Vista/Productos2D.php'>Impresiones 2D</a></li>
                <li><a class='dropdown-item text-light' href='/TP-Final-Dinamica/Vista/Productos3D.php'>Impresiones 3D</a></li>
                <li><a class='dropdown-item text-light' href='/TP-Final-Dinamica/Vista/Accesorios.php'>Accesorios</a></li>
            </ul>
            </li>
        <li class='nav-item'>
            <a class='nav-link active text-light fs-5' aria-current='page' href='/TP-Final-Dinamica/Vista/Login.php'>Iniciar Sesion</a>
        </li>
        </ul>
    ";
    
    $htmlMenu = $aux;
}
?>



<div class="navbar mx-3" id="">
    <?php echo $htmlMenu ?>
</div>