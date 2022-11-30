<?php
include_once("Common/Header.php");
$pagina="Admin";
if ($sesion->tienePermisos($pagina)){

        //obtengo todos los menues
        $objC_Menu = new C_Menu();
        $menues = $objC_Menu->buscar(NULL);
        $cantidadMenues = count($menues);
        $i = 0;
        //FALTA TESTEAR ESTE CODIGO, COPIE EL DE EDITAR USUARIO Y CAMBIE TODAS LAS VARIABLES A MENU
?>

<div class="container">
        <div class="display-1 text-light  text-center mt-3 bg-dark" id="titulo"><h3>Gesti&oacute;n de men&uacute;</h3></div>
        <div class="rounded p-3 mb-2 bg-dark text-white">
            <table class="table table-dark table-hover p-5">
                <thead class="text-center">
                    <tr>
                        <th scope="col-4"><MENU></MENU></th>
                        <th scope="col-4">NOMBRE</th>
                        <th scope="col-4">DESCRIPCION</th>
                        <th scope="col-4">ROLES</th>
                        <th scope="col-6">ESTADO</th>
                        <th scope="col-6">OPCIONES</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    while ($i < $cantidadMenues) {
                        //NO SE SI ESTA BIEN HECHO, HAY QUE VERLO EN LA PAGINA
                    ?>
                        <tr>
                                <th scope="row" class="text-center"><?php echo $i + 1 ?></th>
                                <td><?php echo $menues[$i]->getMenombre() ?></td>
                                <td> <?php echo $menues[$i]->getMedescripcion() ?> </td>
                                <td> <?php
                                                $objMeRol = new C_Menurol();
                                                $rolesMenu = $objMeRol->buscar(['idmenu' => $menues[$i]->getIdmenu()]);
                                                foreach ($rolesMenu as $rolMenu) {
                                                        echo $rolMenu->getIdrol()->getRodescripcion() . " ";
                                                }
                                                ?>
                                        </td>
                                <td class="text-center"> <?php echo $menues[$i]->getMedeshabilitado() == NULL || $menues[$i]->getMedeshabilitado() == '0000-00-00 00:00:00' ? "Habilitado" : "Deshabilitado"; ?> </td>
                                <td>
                                        <form method='post' action='EditarMenu.php' id="'<?php echo $menues[$i]->getIdmenu() ?>">
                                        <input style="display:none;" name='idmenu' id='idmenu' value='<?php echo $menues[$i]->getIdmenu() ?>'>
                                        <button type="submit" class="ms-3 mt-3 text-decoration-none btn btn-outline-light"> EDITAR </button>
                                        <?php echo $menues[$i]->getMedeshabilitado() == NULL || $menues[$i]->getMedeshabilitado() == '0000-00-00 00:00:00' ?
                                                "<button type='button' class='mx-2 mt-1 text-decoration-none btn deshabilitar text-light' id='botonModal'>
                                DESHABILITAR
                                </button>" :
                                                "<button type='button' class='mx-2 mb-1 text-decoration-none btn habilitar text-light' id='botonModal'>
                                HABILITAR
                                </button>";
                                        ?>

                                        </form>
                                </td>       
                        </tr>
                       
                    <?php
                        $i++;
                    } ?>
                </tbody>
            </table>
        </div>

</div>

<script src="Assets/Js/GestionMenu.js"></script>
<?php
include_once("Common/Footer.php");
} else {
        ?>
            <script>
                window.location.href = "/TP-Final-Dinamica/Vista/Home.php";
            </script>
        
        <?php
        }

        ?>        