<?php
include_once ("Common/Header.php");
$i=0;
$usuario = $sesion->getUsuario();
//obtengo todas las compras del usuario
$objCompra = new C_Compra();
$arrayCompras = $objCompra->buscar(['idusuario'=> $usuario->getIdusuario()]);
$cantidadCompras = count($arrayCompras);
?>

<div class="container bg-dark">
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
                </tr>
            </thead>
            <tbody>
                <?php
                while ($i < $cantidadCompras) {
                ?>
                    <tr>
                        <th scope="row" class="text-center"><?php echo $i + 1 ?></th>
                        <td> <?php echo $arrayCompras[$i]->getCofecha()?> </td>
                        <td> <?php ?> Aca van los productos </td>
                        <td> <?php ?> Aca va el total
                        </td>
        
                        <td>
                            Aca va el estado
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