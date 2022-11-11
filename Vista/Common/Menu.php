<?php
include
//Debo buscar todos los roles que no tengan padre (idPadre= NULL);
$controladorMenu = new C_Menu();
$condicion = ['idpadre' => NULL];
$menusPadre = $controladorMenu->buscar($condicion); //se supone que esto trae a los menus que no tengan padre
$cantPadres = count($menusPadre);
?>

<nav class="navbar navbar-expand-md navbar-dark bg-dark">
    <a class="navbar-brand" href="#">Besto 3D</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExample04" aria-controls="navbarsExample04" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="">
        <ul class="navbar-nav mr-auto">
            <?php for ($i = 0; $i < $cantPadres; $i++) {
                $padreActual = $menusPadre[$i];
                $condicion = ['idpadre' => $padreActual->getIdmenu()]; //para buscar todos los hijos que tengan como idpadre al del padreActual
                $hijos = $controladorMenu->buscar($condicion);
                $cantHijos = count($hijos);
            ?>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="dropdown04" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?php echo $padreActual->getMenombre() ?></a>
                    <div class="dropdown-menu" aria-labelledby="dropdown04">
                        <?php for ($j = 0; $j < $cantHijos; $j++) {
                            $hijoActual = $hijos[$j];
                        ?>
                            <a class="dropdown-item" href="#"><?php echo $hijoActual->getMenombre() ?></a>
                        <?php }; ?>
                    </div>
                <?php }; ?>

                <!--Por cada menu PADRE tengo que recorrer todos sus hijos y hacer esta estructura
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="dropdown04" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Menu Padre</a>
                        <div class="dropdown-menu" aria-labelledby="dropdown04">
                        <a class="dropdown-item" href="#">Menu Hijo a</a>
                        <a class="dropdown-item" href="#">Menu Hijo b</a>
                        </div>
                    </li>-->

        </ul>

    </div>
</nav>