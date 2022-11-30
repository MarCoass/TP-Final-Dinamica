<?php

//echo $_SESSION['ROOT'].'Modelo/';
$menues = [];
if ($sesion->activa()) {
    $idRoles = $sesion->getRoles();
    $objMenuRol = new C_Menurol();
    $menues = $objMenuRol->menuesByIdRol($idRoles);
    $objMenu = new C_Menu();


    $htmlCompleto = '';
    foreach ($menues as $itemMenu) {
        $htmlHijos = [];
        if ($itemMenu->getMedeshabilitado() != NULL && $itemMenu->getMedeshabilitado() != '0000-00-00 00:00:00') {
            continue;
        }

        if ($itemMenu->getIdpadre() == NULL) { // Si no tiene padre crea el li y revisa si tiene hijos

            //Recorro los menus y busco los hijos de este menu
            foreach ($menues as $menu) {
                //Si el menu tiene idpadre igual al id del menu actual, lo agrego a un array
                if ($menu->getIdpadre() == $itemMenu->getIdmenu()) {
                    //$hijos[] = $itemMenu;
                    $htmlHijos[] = "<li><a class='dropdown-item text-light' href=" . $menu->getScript() . ">{$menu->getMenombre()}</a></li>";
                    //echo "<li><a class='dropdown-item text-dark' href=".$menu->getScript().">{$menu->getMenombre()}</a></li>";
                }
            }
            if (count($htmlHijos) > 0) {

                $htmlItemMenu = "<li class='nav-item dropdown'><a class= 'nav-link dropdown-toggle text-light fs-5' data-bs-toggle='dropdown' href='#' role='button' aria-expanded='false' id='dropdownMenu'>{$itemMenu->getMenombre()}</a>";

                $htmlDesplegable = "<ul class='dropdown-menu'id='dropdownMenu'> "; //aca va el id='dropdownMenu'
                foreach ($htmlHijos as $item) {
                    $htmlDesplegable = $htmlDesplegable . $item;
                }
                $htmlDesplegable = $htmlDesplegable . "</ul>";
                $htmlItemMenu = $htmlItemMenu . $htmlDesplegable . "</li>";
            } else {
                $htmlItemMenu = "<li class='nav-item'><a class='nav-link text-light' href='#'>{$itemMenu->getMenombre()}</a></li>";
            }

            $arrayItemsMenu[] = $htmlItemMenu;
        } else {
            //NO HACE NADA, ENTONCES SI ES UN ITEM HIJO ES IGNORADO HASTA QUE ENCUENTRE A SU PADRE
        }
    }
    $htmlCompleto = "<ul class='nav nav-pills text-light' id='navbarHeader'>";
    foreach ($arrayItemsMenu as $item) {
        $htmlCompleto = $htmlCompleto . $item;
    }
    $htmlCompleto = $htmlCompleto . "</ul>";









    $htmlMenu = $htmlCompleto . "<div class='col align-self-end'><a href='Perfil.php'><button class='btn text-light mx-3 fs-5'>Perfil</button></a><a href='cerrarSesion.php'><button class='btn text-light fs-5'>Cerrar Sesi&oacute;n</button></a></div>";
} else {
    //  $aux = "<div class='col align-self-end'><button class='btn text-light btn-outline-light' id='botonLogin' >Iniciar sesion</button></div>";
    $aux = "
    <ul class='nav nav-pills'>
    <li class='nav-item dropdown'>
                <a class='nav-link dropdown-toggle text-light fs-5' href='#' role='button' data-bs-toggle='dropdown' aria-expanded='false' id='dropdownMenu'>
                    Productos
                </a>
            <ul class='dropdown-menu' id='dropdownMenu'>
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