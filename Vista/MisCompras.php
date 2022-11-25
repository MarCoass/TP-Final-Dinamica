<?php
include_once("Common/Header.php");
$i = 0;
$usuario = $sesion->getUsuario();
//obtengo todas las compras del usuario
$objCompra = new C_Compra();
$arrayCompras = $objCompra->buscar(['idusuario'=> $usuario->getIdusuario()]);
//$cantidadCompras = count($arrayCompras);
if(is_array($arrayCompras) && count($arrayCompras)>0){
    $cantidadCompras = count($arrayCompras);
    }else{
    $cantidadCompras = 0;
    }
$arrayCompras = $objCompra->buscar(['idusuario' => $usuario->getIdusuario()]);
$cantidadCompras = count($arrayCompras);
?>

<div class="container bg-dark mt-3 mb-3">
    <h3>Mis compras</h3>
    <div class="rounded p-3 mb-2 bg-dark text-white">
        <table class="table table-dark table-hover p-5">
            <thead class="text-center">
                <tr>
                    <th scope="col-4">N°</th>
                    <th scope="col-4">Fecha</th>
                    <th scope="col-4">Productos</th>
                    <th scope="col-4">Total</th>
                    <th scope="col-6">Estado</th>
                    <th scope="col-6">Opciones</th>
                </tr>
            </thead>
            <tbody>
                <?php
                while ($i < $cantidadCompras) {
                    //obtengo el estado
                    $objCompraEstado = new C_Compraestado();
                    $objCompraEstado = $objCompraEstado->buscar(['idcompra' => $arrayCompras[$i]->getIdcompra()])[0];
                    $estado = $objCompraEstado->getIdcompraestadotipo();
                    $idcompra = $arrayCompras[$i]->getIdcompra();
                    //Obtengo los productos
                    $objCompraItem = new C_Compraitem();
                    $arrayProductos = $objCompraItem->traerProductos($arrayCompras[$i]->getIdcompra());
                ?>
                    <tr>
                        <th scope="row" class="text-center"><?php echo $i + 1 ?></th>
                        <td> <?php echo $arrayCompras[$i]->getCofecha() ?> </td>
                        <td> <?php foreach ($arrayProductos as $producto) {
                                    echo $producto->getPronombre(); ?> <br> <?php
                                                                }
                                                                    ?> </td>
                        <td> <?php echo $objCompraItem->totalCompra($arrayCompras[$i]->getIdcompra()) ?>
                        </td>
                        <td>
                            <?php echo $estado->getCetdescripcion() ?>
                        </td>
                        <td>
                            <form name="form" action="Accion/cambiarEstado.php" method="post">
                                <input style="display:none;" name='idcompraestado' id='idcompraestado' value='<?php echo $objCompraEstado->getIdcompraestado();  ?>'>
                                <input style="display:none;" name='idcompra' id='idcompra' value='<?php echo $idcompra ?>'>
                                <input style="display:none;" name='idcompraestadotipo' id='idcompraestadotipo' value='4'>
                                <button class="btn cambiarEstado btn-outline-light" type="submit" <?php if ($estado->getIdcompraestadotipo() != 1) { ?> disabled <?php  } ?>>Cancelar</button>
                            </form>

                        </td>
                    </tr>
                <?php
                    $i++;
                } ?>
            </tbody>
        </table>
    </div>
</div>
<script src="Assets/Js/cambiarEstadoCompra.js"></script>
<?php
include_once("Common/Footer.php");
?>