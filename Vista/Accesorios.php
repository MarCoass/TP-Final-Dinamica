<?php

include_once("Common/Header.php");

$objControlProducto = new C_Producto();
$param = array();
$param['protipo'] = "Accesorio";
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
<div class="container">

<div class="display-1 text-light  text-center" id="titulo"><h1>Productos 2D</h1></div>
<div class="row" style="justify-content: center;">
        <?php
        while ($i < $cantidadProductos) {
                if( $arrayProductos[$i]->getProcantstock() == 0){
                        // si el stock del producto esta en cero quiere decir que no esta activo
                         continue;
                 }
        ?>
                <div class="card m-4" style="width: 18rem;" id="formulario">
                        <form id="formulario" name="formulario" method="post" action="cart.php">
                                <input name="id_producto" id="id_producto" type="hidden" value="<?php echo $arrayProductos[$i]->getIdproducto(); ?>" />
                                <img src="<?php echo $arrayProductos[$i]->getProimagen() ?>" class="card-img-top mt-3" alt="Foto del producto">

                                <div class="card-body">
                                        <h5 class="card-title"><?php echo $arrayProductos[$i]->getPronombre() ?></h5>
                                        <p class="card-text"><b>Descripci&oacute;n:</b> <?php echo $arrayProductos[$i]->getProdetalle() ?> - Precio: $<?php echo $arrayProductos[$i]->getProprecio() ?> - Stock Disponible: <?php echo $arrayProductos[$i]->getProcantstock(); ?></p>
                                        <input name="cantidad" type="number" id="cantidad" value="1" min="1" max="<?php echo $arrayProductos[$i]->getProcantstock() ?>" class="pl-2 form-control" />

                                </div>
                                <div class="card-footer">
                                        <button class="btn  btn-outline-light" type="submit" id="botonModal"><i class="bi bi-cart-plus-fill"></i> Añadir al carrito</button>
                                </div>
                        </form>
                </div>

        <?php
                $i++;
        } ?>
</div>
</div>

<?php
    $i++;
}?>
</div>
</div>
</div>
<?php
include_once("Common/Footer.php");
?>