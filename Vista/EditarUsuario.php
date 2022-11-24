<?php 
include ('Common/Header.php');

$datos=data_submitted();
        $objUsuario=new C_Usuario();
        $objUsuarioRol=new C_UsuarioRol();
        $objRol=new C_Rol();
        $roles=$objRol->buscar(null);
        $usuarioModificar=$objUsuario->buscar($datos);

?>

<div class="container-md mb-5">
<main class="w-50 m-auto mt-5 text-center">
    <form class="row gy-2 text-center justify-content-center rounded bg-dark text-white needs-validation" novalidate>
    <div class="col-10" style="display:none;">
        <label for="floatingInput" class="form-label mt-2">ID</label>
        <input type="number" class="form-control" 
                name="idUsuario" id="idUsuario" value="<?php echo $usuarioModificar[0]->getIdUsuario()?>">
    </div>
    <div class="col-10 col-lg-7">
        <label for="floatingInput" class="form-label mt-2">NOMBRE DE USUARIO</label>
        <input type="text" class="form-control" placeholder="Username" pattern="[a-zA-Z]+\s?[0-9]*" minlength="3"
                name="usNombre" id="usNombre" value="<?php echo $usuarioModificar[0]->getUsNombre()?>" required>
                <div class="invalid-feedback">
                    Porfavor ingrese un nombre valido.
                </div>
                
    </div>
    <div class="col-10 col-lg-7">
    <label for="usNombre" class="form-label mt-2">MAIL</label>
        <input type="text" class="form-control" placeholder="Mail" pattern="^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*\.([a-z]{3})(\.[a-z]{2})*$"
                name="usMail" id="usMail" value="<?php echo $usuarioModificar[0]->getUsMail()?>" required>
                <div class="invalid-feedback">
                    Porfavor ingrese un mail valido.
                </div>
    </div>
    <div class="col-10 col-lg-7">
    <label for="usPass" class="form-label mt-2">CONTRASEÑA</label>
        <input type="password" class="form-control" placeholder="***********" id="usPassNueva">
        <input type="password" class="form-control d-none"
            id="usPassAnterior" value="<?php echo $usuarioModificar[0]->getUsPass()?>">
            
    </div>
    <div class="col-8 col-lg-7 mt-4">
        <h6 class="text-center mb-3">ROLES</h6>
        
        
            <?php
            foreach($roles as $rol){
                    ?>
                    <div class="form-check">
                    <input class='form-check-input' type='checkbox' name='rol[]' value='<?php echo $rol->getIdRol() ?>'
                    <?php
                        foreach($descRolesUsuario[0] as $rolUsuario){
                            if($rolUsuario==$rol->getRodescripcion()){
                                ?>checked
                                <?php
                            }
                        }
                    ?>
                    >
                    <label class='form-check-label' for='admin'><?php echo $rol->getRodescripcion() ?> </label>
                    </div>
                    <?php
                
            }
            ?>
    </div>
    <button class="btn btn-lg btn-success my-3 col-10 col-lg-7 mt-4">MODIFICAR</button>
    </form>
</main>
</div>


<?php 
include ('Common/Footer.php')
?>