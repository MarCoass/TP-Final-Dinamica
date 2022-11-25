<?php
include_once("Common/Header.php");
$i = 0;

//obtengo todas las compras del usuario
$objCompra = new C_Compra();
$arrayCompras = $objCompra->buscar([]);
$cantidadCompras = count($arrayCompras);
?>

<div class="container bg-dark">
    <h3 class="text-light">Gestion Compras</h3>
    <div class="rounded p-3 mb-2 bg-dark text-white">
        <table class="table table-dark table-hover p-5">
            <thead class="text-center">
                <tr>
                    <th scope="col-4">ID</th>
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
                    //proxima accion posible
                    $objCompraEstadoTipo = new C_Compraestadotipo();
                    $siguienteEstado = $objCompraEstadoTipo->buscar(['idcompraestadotipo' => $estado->getIdcompraestadotipo() + 1])[0];
                    //Obtengo los productos
                    $objCompraItem = new C_Compraitem();
                    $arrayProductos = $objCompraItem->traerProductos($arrayCompras[$i]->getIdcompra());
                ?>
                    <tr>
                        <th scope="row" class="text-center"><?php echo $arrayCompras[$i]->getIdcompra() ?></th>
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

                            <button class="ms-3 text-decoration-none btn btn-outline-warning" data-bs-toggle="modal" data-bs-target="#modal_estado"> <?php if ($estado->getIdcompraestadotipo() < 3) {
                                                                                                                                                        ?>Cambiar estado<?php
                                                                                                                                                                    } ?> </button>


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

<div class="modal fade" id="modal_estado" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Cambiar estado compra</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <h4>Elija el estado: </h4>
                <form action="">
                    <select class="form-select" aria-label="estado">
                        <?php
                        //obtengo todos los estados y armo los inputs
                        $objEstados = new C_Compraestadotipo();
                        $arrayEstados = $objEstados->buscar([]);
                        foreach ($arrayEstados as $itemEstado) {
                            if ($itemEstado->getIdcompraestadotipo() != 0) {
                        ?>
                                <option value="<?php echo $itemEstado->getIdcompraestadotipo() ?>"> <?php echo $itemEstado->getCetdescripcion() ?></option>

                        <?php

                            }
                        }
                        ?>
                    </select>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Volver</button>
                <a type="button" class="btn btn-success" href="borrarCuenta.php">Guardar</a>
            </div>
        </div>
    </div>
</div>

<script src="Assets/Js/cambiarEstadoCompra.js"></script>
<?php
include_once("Common/Footer.php");
?>