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
//$arrayCompras = $objCompra->buscar(['idusuario' => $usuario->getIdusuario()]);
//$cantidadCompras = count($arrayCompras);
?>

<div class="container bg-dark mt-3 mb-3">
<h3 class="text-light">Mis Compras</h3>
    <div class="rounded p-3 mb-2 bg-dark text-white">
        <table id="mis_compras" class="table table-dark table-hover p-5">
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
                if($cantidadCompras != 0){
                while ($i < $cantidadCompras) {
                    //obtengo el estado
                    $objCompraEstado = new C_Compraestado();
                    $objCompraEstado = $objCompraEstado->buscar(['idcompra' => $arrayCompras[$i]->getIdcompra()])[0];
                    $estado = $objCompraEstado->getIdcompraestadotipo();
                    $idcompra = $arrayCompras[$i]->getIdcompra();
                    //Obtengo los productos
                    $objCompraItem = new C_Compraitem();
                    //$arrayProductos = $objCompraItem->traerProductos($arrayCompras[$i]->getIdcompra());
                    $productos_compra = $objCompraItem->buscar(array('idcompra' => $arrayCompras[$i]->getIdcompra()));

                ?>  
                    <tr>
                        <th scope="row" class="text-center"><?php echo $i + 1 ?></th>
                        <td> <?php echo date('d/m/Y H:i:s', strtotime($arrayCompras[$i]->getCofecha())) ?> </td>
                        <td> <?php foreach ($productos_compra as $prd) {
                                $producto = $prd->getIdproducto();
                                echo '<span title="Cantidad retirada: '.$prd->getCicantidad().'">'.$producto->getPronombre().'</span>'; ?> <br> <?php
                                                                }
                                                                    ?> </td>
                        <td> <?php echo $objCompraItem->totalCompra($arrayCompras[$i]->getIdcompra()) ?>
                        </td>
                        <td>
                            <?php echo $estado->getCetdescripcion() ?>
                        </td>
                        <td>

                        <?php if($estado->getIdcompraestadotipo() == 1){ ?>
                            <form name="form" action="Accion/cambiarEstado.php" method="post">
                                <input type="hidden" name='idcompraestado' id='idcompraestado' value='<?php echo $objCompraEstado->getIdcompraestado();  ?>'>
                                <input type="hidden" name='idcompra' id='idcompra' value='<?php echo $idcompra ?>'>
                                <input type="hidden" name='idcompraestadotipo' id='idcompraestadotipo' value='4'>
                                <button class="btn btn-outline-light" type="submit" <?php if ($estado->getIdcompraestadotipo() != 1) { ?> disabled <?php  } ?>>Cancelar</button>
                            </form>
                        <?php } ?>

                        <?php if($estado->getIdcompraestadotipo() == 4){ ?>
                            <form name="form_iniciar_compra" action="Accion/cambiarEstado.php" method="post">
                                <input type="hidden" name='idcompraestado' id='idcompraestado' value='<?php echo $objCompraEstado->getIdcompraestado();  ?>'>
                                <input type="hidden" name='idcompra' id='idcompra' value='<?php echo $idcompra ?>'>
                                <input type="hidden" name='idcompraestadotipo' id='idcompraestadotipo' value='1'>
                                <button class="btn btn-outline-light" type="submit">Iniciar Compra</button>
                            </form>
                        <?php } ?>
                        </td>
                    </tr>
                <?php
                    $i++;
                }} ?>
            </tbody>
        </table>
    </div>
</div>
<script>
$(document).ready(function () {
 $('#mis_compras').DataTable( {			
    processing : true,
    responsive: true,
    "language": {
        "decimal": ",",
        "thousands": ".",
        "search": "Buscar: ",
        "processing": "Obteniendo datos...",
        "lengthMenu": "Mostrar MENU elementos por página",
        "zeroRecords": "Sin resultados",
        "info": "Mostrando PAGE de PAGES páginas",
        "infoEmpty": "No se encontraron elementos",
        "infoFiltered": "(filtrado de MAX total elementos)",
        "paginate": {
            "first": "Primera",
            "last": "Última",
            "next": "Siguiente",
            "previous": "Anterior"
        }
    },
    "lengthMenu": [[10,50,-1], [10, 50, "Todos"]],
    dom: 'frtipB',
    buttons: [
              {
                  extend: 'pageLength',
                  text:      '<i class="fa fa-eye"></i> Elementos',
                  className: 'buttons-excel buttons-html5 btn red btn-outline',                      
                  
              },     
              {
                  extend: 'excelHtml5',
                  text:      '<i class="fa fa-file-excel-o"></i> Excel',
                  className: 'buttons-excel buttons-html5 btn red btn-outline',
                  title: 'Exportar_excel'
              }                                             
    ],
    columnDefs: [ 	             
          {   'targets': 0,
            
          }                   
    ],       
  } );
});

</script>
<?php
include_once("Common/Footer.php");
?>