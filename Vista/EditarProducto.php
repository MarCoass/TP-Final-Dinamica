<?php
include('Common/Header.php');
$pagina="Deposito";
if ($sesion->tienePermisos($pagina)){
    $datos = data_submitted();
    $objProducto = new C_Producto();
    $productoModificar = $objProducto->buscar($datos)[0];
    
?>

    <div class="container-md mb-5">
        <main class="w-50 m-auto mt-5 text-center">
            <form class="row gy-2 text-center justify-content-center rounded bg-dark text-white needs-validation" novalidate>
                <div class="col-10" style="display:none;">
                    <label for="floatingInput" class="form-label mt-2">ID</label>
                    <input type="number" class="form-control" name="idproducto" id="idproducto" value="<?php echo $productoModificar->getIdproducto() ?>">
                </div>
                <div class="col-10 col-lg-7">
                    <label for="floatingInput" class="form-label mt-2">Nombre: </label>
                    <input type="text" class="form-control" placeholder="nombre" minlength="3" name="pronombre" id="pronombre" value="<?php echo $productoModificar->getPronombre() ?>" required>
                </div>
                <div class="col-10 col-lg-7">
                    <label for="usmail" class="form-label mt-2">Detalle: </label>
                    <input type="text" class="form-control" placeholder="detalle" name="prodetalle" id="prodetalle" value="<?php echo $productoModificar->getProdetalle() ?>" required>
                </div>
                <div class="col-10 col-lg-7">
                    <label for="uspass" class="form-label mt-2">Stock:</label>
                    <input type="number" class="form-control" id="procantstock" name="procantstock" value="<?php echo $productoModificar->getProcantstock() ?>">
                </div>
                <div class="col-10 col-lg-7">
                    <label for="uspass" class="form-label mt-2">URL Imagen:</label>
                    <input type="text" class="form-control" id="proimagen" name="proimagen" value="<?php echo $productoModificar->getProImagen() ?>">
                </div>
                <div class="col-10 col-lg-7">
                    <label for="uspass" class="form-label mt-2">Precio:</label>
                    <input type="number" class="form-control" id="proprecio" name="proprecio" value="<?php echo $productoModificar->getProprecio() ?>">
                </div>

                <button class="btn btn-lg text-light my-3 col-10 col-lg-7 mt-4" id="botonModal" >MODIFICAR</button>
            </form>
        </main>
    </div>

    <script src="Assets/Js/EditarProducto.js"></script>
    <script src="Assets/Js/enviarFormulario.js"></script>
<?php
    include('Common/Footer.php');
} else {
?><script>
        window.location.href = "/TP-Final-Dinamica/Vista/Home.php";
    </script>
<?php
}
?>