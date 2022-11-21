<?php
include_once('../Vista/Common/Header.php');

?>

<div class="container mx-auto" style="margin:30px;height:80vh;">
    <div class="container bg-dark p-3">
        <div class="display-1 text-light  text-center" id="titulo">
            <h2>Perfil</h2>
        </div>
        <hr class="border border-ligtht border-2 opacity-50" >
        <div class="container" id="">
            <div class="text-light" id="InfoUsuario">
                Username: <?php echo $objSession->getUserName() ?> <br>
                Mail: <?php echo $objSession->getUsuario()->getUsmail() ?> <br>
                Contraseña: ***********
            </div>
            <div id="ContenedorBotones m-5">
                <button class="btn btn-light">Editar perfil</button>
                <button class="btn btn-danger">Borrar cuenta</button>
            </div>
        </div>
    </div>


</div>

<?php
include_once('../Vista/Common/Footer.php')
?>