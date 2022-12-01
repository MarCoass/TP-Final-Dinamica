<?php
include_once("Common/Header.php");
$i = 0;
$pagina="Deposito";

//obtengo todas las compras del usuario
$objCompra = new C_Compra();
$arrayCompras = $objCompra->buscar([]);
$cantidadCompras = count($arrayCompras);

if ($sesion->tienePermisos($pagina)) {

        //obtengo todos los usuarios 
        $objC_Usuario = new C_Usuario();
        $usuarios = $objC_Usuario->buscar(NULL);
        $cantidadUsuarios = count($usuarios);
        $i = 0;
?>
<style>
  #compras_filter input{
      color:white;
  }
</style>
<div class="container bg-dark mt-3 mb-3">
    <h3 class="text-light">Gestion Compras</h3>
    <div class="rounded p-3 mb-2 bg-dark text-white">
        <table id="compras" class="table table-dark table-hover p-5">
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
                    $idcompra = $arrayCompras[$i]->getIdcompra();
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
                        <?php if($estado->getIdcompraestadotipo() == 1){ ?>
                            <form name="form" action="Accion/cambiarEstado.php" method="post">
                                <input type="hidden" name='idcompraestado' id='idcompraestado' value='<?php echo $objCompraEstado->getIdcompraestado();  ?>'>
                                <input type="hidden" name='idcompra' id='idcompra' value='<?php echo $idcompra ?>'>
                                <input type="hidden" name='idcompraestadotipo' id='idcompraestadotipo' value='4'>
                                <button class="btn btn-outline-light" type="submit" <?php if ($estado->getIdcompraestadotipo() != 1) { ?> disabled <?php  } ?>>Cancelar</button>
                            </form>

                            <form name="form" action="Accion/cambiarEstado.php" method="post">
                                <input type="hidden" name='idcompraestado' id='idcompraestado' value='<?php echo $objCompraEstado->getIdcompraestado();  ?>'>
                                <input type="hidden" name='idcompra' id='idcompra' value='<?php echo $idcompra ?>'>
                                <input type="hidden" name='idcompraestadotipo' id='idcompraestadotipo' value='2'>
                                <button class="btn btn-outline-light" type="submit">Aceptar</button>
                            </form>
                        <?php } ?>

                        <?php if($estado->getIdcompraestadotipo() == 2){ ?>
                            
                            <form name="form" action="Accion/cambiarEstado.php" method="post">
                                <input type="hidden" name='idcompraestado' id='idcompraestado' value='<?php echo $objCompraEstado->getIdcompraestado();  ?>'>
                                <input type="hidden" name='idcompra' id='idcompra' value='<?php echo $idcompra ?>'>
                                <input type="hidden" name='idcompraestadotipo' id='idcompraestadotipo' value='3'>
                                <button class="btn btn-outline-light" type="submit">Enviar</button>
                            </form>
                        <?php } ?>

                        </td>
                    </tr>
                <?php
                    $i++;
                } ?>
            </tbody>
        </table>
    </div>
</div>
<script>
$(document).ready(function () {
 $('#compras').DataTable( {			
    processing : true,
    responsive: true,
    "language": {
        "decimal": ",",
        "thousands": ".",
        "search": "Buscar: ",
        "processing": "Obteniendo datos...",
        "lengthMenu": "Mostrar MENU elementos por página",
        "zeroRecords": "Sin resultados",
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
} else {
        ?>
            <script>
                window.location.href = "/TP-Final-Dinamica/Vista/Home.php";
            </script>
        
        <?php
        }

        ?> 