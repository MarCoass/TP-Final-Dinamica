<?php
include('Common/Header.php');

    $datos = data_submitted();
    $objUsuario = new C_Usuario();
    $objUsuarioRol = new C_UsuarioRol();
    $objRol = new C_Rol();
    $roles = $objRol->buscar(null);
    $usuarioModificar = $objUsuario->buscar($datos)[0];
    $rolesUsuario = $objUsuarioRol->buscar(['idusuario' => $usuarioModificar->getIdusuario()]);

?>

    <div class="container-md mb-5">
        <main class="w-50 m-auto mt-5 text-center">
            <form class="row gy-2 text-center justify-content-center rounded bg-dark text-white needs-validation" novalidate>
                <div class="col-10" style="display:none;">
                    <label for="floatingInput" class="form-label mt-2">ID</label>
                    <input type="number" class="form-control" name="idusuario" id="idusuario" value="<?php echo $usuarioModificar->getIdusuario() ?>">
                </div>
                <div class="col-10 col-lg-7">
                    <label for="floatingInput" class="form-label mt-2">NOMBRE DE USUARIO</label>
                    <input type="text" class="form-control" placeholder="Username" pattern="[a-zA-Z]+\s?[0-9]*" minlength="3" name="usnombre" id="usnombre" value="<?php echo $usuarioModificar->getUsnombre() ?>" required>
                    <div class="invalid-feedback">
                        Porfavor ingrese un nombre valido.
                    </div>

                </div>
                <div class="col-10 col-lg-7">
                    <label for="usmail" class="form-label mt-2">MAIL</label>
                    <input type="text" class="form-control" placeholder="Mail" pattern="^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*\.([a-z]{3})(\.[a-z]{2})*$" name="usmail" id="usmail" value="<?php echo $usuarioModificar->getUsmail() ?>" required>
                    <div class="invalid-feedback">
                        Porfavor ingrese un mail valido.
                    </div>
                </div>
                <div class="col-10 col-lg-7">
                    <label for="uspass" class="form-label mt-2">CONTRASEÑA</label>
                    <input type="password" class="form-control" placeholder="***********" id="uspassNueva">
                    <input type="password" class="form-control d-none" id="uspassAnterior" value="<?php echo $usuarioModificar->getUspass() ?>">

                </div>



                <div class="col-8 col-lg-7 mt-4">
                    <h6 class="text-center mb-3">ROLES</h6>


                    <?php
                    foreach ($roles as $rol) {
                        if ($rol->getRodescripcion() != 'Cliente') {
                    ?>
                            <div class="form-check">
                                <input class='form-check-input' type='checkbox' name='rol[]' value='<?php echo $rol->getIdrol() ?>' <?php
                                                                                                                                    foreach ($rolesUsuario as $rolUsuario) {

                                                                                                                                        if ($rolUsuario->getIdrol()->getRodescripcion() == $rol->getRodescripcion()) {
                                                                                                                                    ?>checked <?php
                                                                                                                                            }
                                                                                                                                        }
                                                                                                                                                ?>>
                                <label class='form-check-label' for='admin'><?php echo $rol->getRodescripcion() ?> </label>
                            </div>
                        <?php

                        } else {
                        ?>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" checked disabled>
                                <label class="form-check-label" for="user">
                                    Cliente
                                </label>
                            </div>
                    <?php
                        }
                    }
                    ?>
                </div>

                <button class="btn btn-lg my-3 col-10 col-lg-7 mt-4 text-light" id="botonModal">MODIFICAR</button>
            </form>
        </main>
    </div>

    <script src="Assets/Js/EditarUsuario.js"></script>
<?php
    include('Common/Footer.php');

?>