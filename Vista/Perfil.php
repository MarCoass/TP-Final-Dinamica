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
                Username: <?php echo $sesion->getUserName() ?> <br>
                Mail: <?php echo $sesion->getUsuario()->getUsmail() ?> <br>
                Contraseña: ***********
            </div>
            <div id="ContenedorBotones m-5">
                <button class="btn btn-light">Editar perfil</button>
                <a class="nav-link" data-bs-toggle="modal" data-bs-target="#modal_borrar"><button class="btn btn-danger">Borrar cuenta</button></a>
            </div>
        </div>
    </div>


</div>

<div class="modal fade" id="modal_borrar" tabindex="-1"  aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Borrar cuenta</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <h4>¿Esta seguro? Esta accion no puede deshacerse.</h4>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Volver</button>
        <a type="button" class="btn btn-danger" href="borrarCuenta.php">Borrar Cuenta</a>
      </div>
    </div>
  </div>
</div>

<?php
include_once('../Vista/Common/Footer.php')
?>