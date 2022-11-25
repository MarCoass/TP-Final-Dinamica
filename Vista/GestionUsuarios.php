<?php
include_once('Common/Header.php');


if ($sesion->esAdmin()) {

    //obtengo todos los usuarios 
    $objC_Usuario = new C_Usuario();
    $usuarios = $objC_Usuario->buscar(NULL);
    $cantidadUsuarios = count($usuarios);
    $i = 0;
?>

    <div class="container">
        <div class="display-1 text-light  text-center mt-3" id="titulo"><h3>Gesti&oacute;n de usuarios</h3></div>

        <div class="rounded p-3 mb-2 bg-dark text-white">
            <table class="table table-dark table-hover p-5">
                <thead class="text-center">
                    <tr>
                        <th scope="col-4">USUARIO</th>
                        <th scope="col-4">NOMBRE</th>
                        <th scope="col-4">MAIL</th>
                        <th scope="col-4">ROL</th>
                        <th scope="col-6">ESTADO</th>
                        <th scope="col-6">OPCIONES</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    while ($i < $cantidadUsuarios) {
                    ?>
                        <tr>
                            <th scope="row" class="text-center"><?php echo $i + 1 ?></th>
                            <td><?php echo $usuarios[$i]->getUsNombre() ?></td>
                            <td> <?php echo $usuarios[$i]->getUsMail() ?> </td>
                            <td> <?php
                                    $objUsRol = new C_Usuariorol();
                                    $rolesUsuario = $objUsRol->buscar(['idusuario' => $usuarios[$i]->getIdusuario()]);
                                    foreach ($rolesUsuario as $rolUsuario) {
                                        echo $rolUsuario->getIdrol()->getRodescripcion() . " ";
                                    }
                                    ?>
                            </td>
                            <td class="text-center"> <?php echo $usuarios[$i]->getUsdeshabilitado() == "0000-00-00 00:00:00" ? "Habilitado" : "Deshabilitado"; ?> </td>
                            <td>
                                <form method='post' action='EditarUsuario.php' id="'<?php echo $usuarios[$i]->getIdUsuario() ?>">
                                    <input style="display:none;" name='idusuario' id='idusuario' value='<?php echo $usuarios[$i]->getIdUsuario() ?>'>
                                    <button type="submit" class="ms-3 mt-3 text-decoration-none btn btn-outline-light"> EDITAR </button>
                                    <?php echo $usuarios[$i]->getUsdeshabilitado() == "0000-00-00 00:00:00" ?
                                        "<button type='button' class='mx-2 mt-1 text-decoration-none btn deshabilitar text-light' id='botonModal'>
                        DESHABILITAR
                        </button>" :
                                        "<button type='button' class='mx-2 mb-1 text-decoration-none btn habilitar' id='botonHab'>
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

    <script src="Assets/Js/GestionUsuarios.js"></script>
<?php

    include_once('Common/Footer.php');
} else {
?>
    <script>
        window.location.href = "/TP-Final-Dinamica/Vista/Home.php";
    </script>

<?php
}


?>