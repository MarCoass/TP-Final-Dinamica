<?php
include_once('../Vista/Common/Header.php');
$usuario = $sesion->getUsuario();
?>

<div class="container mx-auto" style="margin:30px;height:80vh;">
  <div class="container bg-dark p-3">
    <div class="display-1 text-light  text-center" id="titulo">
      <h2>Perfil</h2>
    </div>
    <hr class="border border-ligtht border-2 opacity-50">
    <div class="container" id="">
      <div class="text-light" id="InfoUsuario">
        Username: <?php echo $sesion->getUserName() ?> <br>
        Mail: <?php echo $sesion->getUsuario()->getUsmail() ?> <br>
        Contraseña: ***********
      </div>
      <div id="ContenedorBotones m-5">
        <a class="nav-link" data-bs-toggle="modal" data-bs-target="#modal_editar"><button class="btn btn-outline-light mt-2">Editar</button></a>
        <a class="nav-link" data-bs-toggle="modal" data-bs-target="#modal_borrar"><button class="btn btn-danger mt-2">Borrar cuenta</button></a>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="modal_editar" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content bg-dark text-light">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Editar Perfil</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form name="form" action="Accion/editarPerfil.php" method="post">
      <div class="modal-body">
        <form name="form" class="needs-validation" action="Accion/editarPerfil.php" method="post" novalidate>
          <div class="col-lg-7 col-12">Username:
            <input value='<?php echo $usuario->getUsnombre() ?>' class="form-control" type="text" style="width: 150px;"  name="usnombre" required></input>
          </div>
          <div class="col-lg-7 col-12">Mail:
            <input value='<?php echo $usuario->getUsmail() ?>' class="form-control" type="text" style="width: 150px;"  name="usmail" required></input>
          </div>
          <div class="col-lg-7 col-12">Contraseña:
            <input value='<?php echo $usuario->getUspass() ?>' class="form-control" type="password" style="width: 150px;" name="uspass" required></input>
          </div>
          <button type="submit" class="btn editar text-light mt-2" id="botonModal" href="">Guardar</button>
          <button type="button" class="btn btn-secondary mt-2" data-bs-dismiss="modal">Volver</button>
        </form>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="modal_borrar" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content bg-dark text-light">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Borrar cuenta</h5>
        <button type="button mt-2" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
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
<script src="Assets/Js/Validacion.js"> </script>
<script src="Assets/Js/EditarPerfil.js"></script>

<?php
include_once('../Vista/Common/Footer.php')
?>