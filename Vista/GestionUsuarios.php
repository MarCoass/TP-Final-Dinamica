<?php
include_once('Common/Header.php');

$roles = $sesion->getRoles();
$rol =  $roles[0]->getIdrol()->getIdrol();
if($rol == 1){

//obtengo todos los usuarios 
$objC_Usuario = new C_Usuario();
$usuarios = $objC_Usuario->buscar(NULL);
$cantidadUsuarios = count($usuarios);
$i = 0;
?>

<div class="container">
    <h3>Gestion de usuarios</h3>

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
                                foreach($rolesUsuario as $rolUsuario){
                                    echo $rolUsuario->getIdrol()->getRodescripcion() . " ";
                                }
                                ?>
                        </td>
                        <td class="text-center"> <?php echo $usuarios[$i]->getUsdeshabilitado() == "0000-00-00 00:00:00" ? "Habilitado" : "Deshabilitado"; ?> </td>
                        <td>
                            <form method='post' action='EditarUsuario.php' id="'<?php echo $usuarios[$i]->getIdUsuario() ?>">
                                <input style="display:none;" name='idusuario' id='idusuario' value='<?php echo $usuarios[$i]->getIdUsuario() ?>'>
                                <button type="submit" class="ms-3 text-decoration-none btn btn-outline-warning"> EDITAR </button>
                                <?php echo $usuarios[$i]->getUsdeshabilitado() == "0000-00-00 00:00:00" ?
                                    "<button type='button' class='mx-2 text-decoration-none btn btn-outline-danger deshabilitar'>
                        DESHABILITAR
                        </button>" :
                                    "<button type='button' class='mx-2 text-decoration-none btn btn-outline-danger habilitar'>
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
} 


?>

<script>
    window.location.href = "/TP-Final-Dinamica/Vista/Home.php"; 
</script>

