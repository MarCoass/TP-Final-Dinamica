<?php

include_once("Common/Header.php");

$objControlProducto = new C_Producto();
$param = ['protipo' => "Accesorio"];
$arrayProductos = $objControlProducto->buscar($param);
if ($arrayProductos != null) {
    $cantidadProductos = count($arrayProductos);
} else {
    $cantidadProductos = -1;
}
$i = 0;
?>
<div class="container-fluid  mt-3" style="width: 100vw;">
    <div class="row ">

        <?php
        while ($i < $cantidadProductos) {
        ?>
            <div class="col-4">
                <div class="card mb-3" style="max-width: 540px;">
                    <div class="row g-0">
                        <div class="col-md-4">
                            <img src="<?php echo $arrayProductos[$i]->getProimagen() ?>" class="img-fluid rounded-start" alt="Foto del producto">
                        </div>
                        <div class="col-md-8">
                            <div class="card-body">
                                <h5 class="card-title"><?php echo $arrayProductos[$i]->getPronombre() ?></h5>
                                <p class="card-text"><b>Descripci&oacute;n:</b> <?php echo $arrayProductos[$i]->getProdetalle() ?> <br>
                                    <b>Precio:</b> $<?php echo $arrayProductos[$i]->getProprecio() ?>
                                </p>
                            </div>
                            <div class="card-footer">
                                <button class="btn  btn-outline-dark"><i class="bi bi-cart-plus-fill"></i> Añadir al carrito</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php
            $i++;
        }
        ?>
    </div>
</div>



<?php
include_once("Common/Footer.php");
?>