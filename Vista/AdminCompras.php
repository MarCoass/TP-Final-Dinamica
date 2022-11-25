<?php
include_once ("Common/Header.php");
$i=0;

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
                    $objCompraEstado = $objCompraEstado->buscar(['idcompra'=>$arrayCompras[$i]->getIdcompra()])[0];
                    $estado = $objCompraEstado->getIdcompraestadotipo();
                    //proxima accion posible
                    $objCompraEstadoTipo = new C_Compraestadotipo();
                    $siguienteEstado = $objCompraEstadoTipo->buscar(['idcompraestadotipo'=>$estado->getIdcompraestadotipo()+1])[0];
                    //Obtengo los productos
                    $objCompraItem = new C_Compraitem();
                    $arrayProductos = $objCompraItem->traerProductos($arrayCompras[$i]->getIdcompra());
                ?>
                    <tr>
                        <th scope="row" class="text-center"><?php echo $arrayCompras[$i]->getIdcompra() ?></th>
                        <td> <?php echo $arrayCompras[$i]->getCofecha()?> </td>
                        <td> <?php foreach($arrayProductos as $producto){
                            echo $producto->getPronombre(); ?> <br> <?php 
                        }
                        ?> </td>
                        <td> <?php echo $objCompraItem->totalCompra($arrayCompras[$i]->getIdcompra())?>
                        </td>
                        <td>
                            <?php echo $estado->getCetdescripcion()?>
                        </td>
                        <td>
                            <button class="btn btn-light">
                                <?php if($estado->getIdcompraestadotipo()<3){
                                    
                                    echo $siguienteEstado->getCetdescripcion();
                                } ?>
                            </button>
                            <button class="btn btn-danger">
                                Cancelar
                            </button>
                        </td>
                    </tr>
                <?php
                    $i++;
                } ?>
            </tbody>
        </table>
    </div>
</div>

<?php
include_once ("Common/Footer.php");
?>