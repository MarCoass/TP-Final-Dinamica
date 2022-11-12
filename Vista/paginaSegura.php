<?php
//FALTA EL CONFI
include_once '../Control/AbmUsuario.php';
include_once '../Control/AbmUsuarioRol.php';
include_once '../Modelo/Usuario.php';
include_once '../Modelo/UsuarioRol.php';
include_once '../Modelo/conector/BaseDatos.php';
include_once '../Modelo/Rol.php';

$sesion = new Session();
$datos = data_submitted();

if (!$sesion->activa()) {
    header('Location: login.php');
} else {
    list($sesionValidar, $error) = $sesion->validar();
    if ($sesionValidar) {
        $user = $sesion->getUsuario();
        $name = $user->getusnombre();
        $mail = $user->getusmail();
        $usrol = $sesion->getRol();
        $rol = $usrol[0]->getobjrol();
        $descrp = $rol->getroldescripcion();
        $Titulo = "Pagina Segura";
        include_once("../Common/Header");
    } else {
        header('Location: cerrarSesion.php');
    }
}
?>

<div class="row my-5">
    <form class="mb-5" id="pagSeg" name="pagSeg" method="POST" action="cerrarSesion.php">
        <div class="d-flex justify-content-center">
            <div class='card text-center border border-3 border-warning' style='width: 25rem;'>
                <div class='card-body my-3'>
                    <?php
                    echo "<h3 class='card-title'>BIENVENID@ objetoUsuario</h3>";
                    echo "Email: $mail" . "<br>";
                    echo "Rol: $descrp" . "<br>";
                    if ($descrp == "Admin") {
                        echo "<div class='text-center'>
                        <img alt='homer' class='mb-2 w-50' src='../../img/imgAdmin.png'>
                        </div>";
                    } else {
                        echo "<div class='text-center'>
                        <img alt='homer' class='mb-2 w-50' src='../../img/imgProle.png'>
                        </div>";
                    }
                    ?>
                    <button href='#' class='btn btn-primary' id='cerrarSesion' name='cerrarSesion' type='submit' value='cerrarSesion'>Cerrar sesión</button>
                </div>
            </div>
        </div>
    </form>
</div>
