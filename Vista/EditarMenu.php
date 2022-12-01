<?php
include('Common/Header.php');

    $datos = data_submitted();
    $objMenu = new C_Menu();
    $objMenuRol = new C_MenuRol();
    $objRol = new C_Rol();
    $roles = $objRol->buscar(null);
    $menuModificar = $objMenu->buscar($datos)[0];
    $rolesMenu = $objMenuRol->buscar(['idmenu' => $menuModificar->getIdmenu()]);
//TENGO QUE VER PQ NO ME MANDA LOS DATOS DE EDITAR A LA BD
?>

<div class="container-md mb-5">
    <main class="w-50 m-auto mt-5 text-center">
        <form class="row gy-2 text-center justify-content-center rounded bg-dark text-white needs-validation" novalidate>
            <div class="col-10" style="display:none;">
                <label for="floatingInput" class="form-label mt-2">ID</label>
                <input type="number" class="form-control" name="idmenu" id="idmenu" value="<?php echo $menuModificar->getIdmenu() ?>">
            </div>
            <div class="col-10 col-lg-7">
                    <label for="floatingInput" class="form-label mt-2">NOMBRE DEL MENU</label>
                    <input type="text" class="form-control" placeholder="Nombre del Menu" pattern="[a-zA-Z]+\s?[0-9]*" minlength="3" name="menombre" id="menombre" value="<?php echo $menuModificar->getMenombre() ?>" required>
                    <div class="invalid-feedback">
                        Porfavor ingrese un nombre valido.
                    </div>
            </div>
            <div class="col-10 col-lg-7">
                    <label for="floatingInput" class="form-label mt-2">DESCRIPCION</label>
                    <input type="text" class="form-control" placeholder="Descripcion" pattern="[a-zA-Z]+\s?[0-9]*" name="medescripcion" id="medescripcion" value="<?php echo $menuModificar->getMedescripcion() ?>" required>
                    <div class="invalid-feedback">
                        Porfavor ingrese una descripcion valida.
                    </div>
            </div>
            <div class="col-8 col-lg-7 mt-4">
                    <h6 class="text-center mb-3">ROLES</h6>


                    <?php
                    foreach ($roles as $rol) {
                    ?>
                            <div class="form-check">
                                <input class='form-check-input' type='checkbox' name='rol[]' value='<?php echo $rol->getIdrol() ?>' <?php
                                                                                                                                    foreach ($rolesMenu as $rolMenu) {

                                                                                                                                        if ($rolMenu->getIdrol()->getRodescripcion() == $rol->getRodescripcion()) {
                                                                                                                                    ?>checked <?php
                                                                                                                                            }
                                                                                                                                        }
                                                                                                                                                ?>>
                                <label class='form-check-label' for='admin'><?php echo $rol->getRodescripcion() ?> </label>
                            </div>
                        <?php
                    }
                    ?>
                </div>
                <button class="btn btn-lg my-3 col-10 col-lg-7 mt-4 text-light" id="botonModal">MODIFICAR</button>
                <input class="d-none"  name="script" value="<?  echo $menuModificar->getScript(); ?>">
                <input class="d-none" name="medeshabilitado" value=" <?php echo $menuModificar->getMedeshabilitado(); ?>">
                <input class="d-none" name="idpadre" value="<?php echo $menuModificar->getIdpadre() ?>"> 
        </form>
    </main>
</div>


<script src="Assets/Js/EditarMenu.js"></script>
<?php
    include('Common/Footer.php');

?>