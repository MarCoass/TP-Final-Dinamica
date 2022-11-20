<?php
include_once("Common/Header.php");

$objControlProducto = new C_Producto();
$param = array();
$param['protipo'] = '2D';
$arrayProductos = $objControlProducto->buscar($param);
if ($arrayProductos != null) {
    $cantidadProductos = count($arrayProductos);
} else {
    $cantidadProductos = -1;
}
$i = 0;
?>
<div class="container mt-5">
<div class="row" style="justify-content: center;">
<?php
while ($i < $cantidadProductos) {
        ?>
<div class="card m-4" style="width: 18rem;">
        <form id="formulario" name="formulario" method="post" action="cart.php">
        <input name="precio" type="hidden" id="precio" value="10" />
        <input name="titulo" type="hidden" id="titulo" value="articulo 1" />
        <input name="cantidad" type="hidden" id="cantidad" value="1" class="pl-2" />
        <img src="<?php echo $arrayProductos[$i]->getProimagen() ?>" class="card-img-top" alt="Foto del producto">
                       
                <div class="card-body">
                        <h5 class="card-title"><?php echo $arrayProductos[$i]->getPronombre() ?></h5>
                        <p class="card-text"><b>Descripci&oacute;n:</b> <?php echo $arrayProductos[$i]->getProdetalle() ?> - Precio:  $<?php echo $arrayProductos[$i]->getProprecio() ?></p>
                        <button class="btn btn-primary" type="submit" ><i class="fas fa-shopping-cart"></i> Añadir al carrito</button>
                </div>
        </form>
</div>

<?php
    $i++;
}?>
</div>
</div>
<?php
include_once("Common/Footer.php");
?>