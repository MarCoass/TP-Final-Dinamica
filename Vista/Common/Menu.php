<?php
//echo $_SESSION['ROOT'].'Modelo/';
$menues = [];

if ($sesion->activa()) {
    $idRoles = $sesion->getRoles();
    $objMenuRol = new C_Menurol();
    $menues = $objMenuRol->menuesByIdRol($idRoles);
    $objMenu = new C_Menu();
    
    $htmlMenu = $objMenu->armarMenu($menues) . "<div class='col align-self-end'><a href='Perfil.php'><button class='btn text-light mx-3' id='botonUser'>Perfil</button></a><a href='cerrarSesion.php'><button class='btn text-light' id='botonUser'>Cerrar Sesi&oacute;n</button></a></div>";
    
} else {
  //  $aux = "<div class='col align-self-end'><button class='btn text-light btn-outline-light' id='botonLogin' >Iniciar sesion</button></div>";
    $aux = "
    <ul class='nav nav-pills'>
    <li class='nav-item dropdown' id='dropdownMenu'>
                <a class='nav-link dropdown-toggle text-light fs-5' href='#' role='button' data-bs-toggle='dropdown' aria-expanded='false' id='dropdownMenu'>
                    Productos
                </a>
            <ul class='dropdown-menu' id='dropdown'>
                <li><a class='dropdown-item text-light' href='Productos2D.php'>Impresiones 2D</a></li>
                <li><a class='dropdown-item text-light' href='Productos3D.php'>Impresiones 3D</a></li>
                <li><a class='dropdown-item text-light' href='Accesorios.php'>Accesorios</a></li>
            </ul>
            </li>
        <li class='nav-item'>
            <a class='nav-link active text-light fs-5' aria-current='page' href='Login.php' id='botonUser'>Iniciar Sesi&oacute;n</a>
        </li>
        </ul>
    ";
    
    $htmlMenu = $aux;
}
?>



<div class="navbar mx-3" id="">
    <?php echo $htmlMenu ?>
</div>