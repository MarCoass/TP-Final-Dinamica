<?php include_once('Common/Header.php');
$pagina="Deposito";
if ($sesion->tienePermisos($pagina)){
    $objProducto = new C_Producto();
    $arrayProductos = $objProducto->buscar([]);
?>

<div class="container-fluid" style="margin-bottom: 19%">

<div class="container bg-dark col-md-10 text-white mt-5">
<br/>
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#agregarProducto">
 Agregar Producto
</button>
<br/><br/>
    <h3 class="text-light">Admin productos</h3>
        <div class="mb-3">
            <div class="mt-3 mb-3 d-none">
                <a class="btn text-decoration-none btn btn-outline-light" href="cargarProducto.php" id="botonModal">AGREGAR PRODUCTO</a>
            </div>
            <?php
            if ($arrayProductos != null) {
            ?>

<table id="lista_productos" class="table table-dark table-hover p-5">
            <thead class="text-center">
                 <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Detalle</th>
                        <th>Cantidad de Stock</th>
                        <th>URL Imagen</th>
                        <th>Precio</th>
                        <th>Opciones</th>
                        
                    </tr>
            </thead>
            <tbody>
                <?php
                foreach ($arrayProductos as $producto) {
                    echo '<tr>';
                    echo '<td>' . $producto->getIdProducto() . '</td>';
                    echo '<td>' . $producto->getPronombre() . '</td>';
                    echo '<td>' . $producto->getProdetalle() . '</td>';
                    echo '<td>' . $producto->getProcantstock() . '</td>';
                    echo '<td>' . $producto->getProimagen() . '</td>';
                    echo '<td>' . $producto->getProprecio() . '</td>';
                    
                    echo '<td>
                    <form method="post" action="EditarProducto.php" id="' .  $producto->getIdproducto() . '">
                    <input style="display:none;" name="idproducto" id="idproducto" value="' .  $producto->getIdproducto() . '">
                    <button type="submit" class="ms-3 text-decoration-none text-light btn" id="botonModal"> EDITAR </button>

                </form>
                    </td>';
                    echo '</tr>';
                }
            } else {
                echo '<p class="lead">No hay productos registrados </p>';
            }
                ?>
            </tbody>
            <tfoot>
                 <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Detalle</th>
                        <th>Cantidad de Stock</th>
                        <th>URL Imagen</th>
                        <th>Precio</th>
                        <th>Opciones</th>
                        
                    </tr>
            </tfoot>
            </table>
        </div>
    </div>
    
</div>


<script>
$(document).ready(function () {
 $('#lista_productos').DataTable( {			
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
    "lengthMenu": [[3,50,-1], [10, 50, "Todos"]],
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

<?php include_once('Common/Footer.php'); 
} else {
    ?><script>
            window.location.href = "/TP-Final-Dinamica/Vista/Home.php";
        </script>
    <?php
    
    }
    ?>
<div class="modal fade" id="agregarProducto" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Agregar Producto</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div> 
      <form name="form" action="Accion/agregarProducto.php" method="post">
         <div class="modal-body">
                <div class="col-10 col-lg-7">
                    <label for="floatingInput" class="form-label mt-2">Nombre: </label>
                    <input type="text" class="form-control" placeholder="nombre" minlength="3" name="pronombre" id="pronombre" value="" required>
                </div>
                <div class="col-10 col-lg-7">
                    <label for="usmail" class="form-label mt-2">Detalle: </label>
                    <input type="text" class="form-control" placeholder="detalle" name="prodetalle" id="prodetalle" value="" required>
                </div>
                <div class="col-10 col-lg-7">
                    <label for="" class="form-label mt-2">Stock:</label>
                    <input type="number" class="form-control" id="procantstock" name="procantstock" value="">
                </div>
                <div class="col-10 col-lg-7">
                    <label for="" class="form-label mt-2">Tipo:</label>
                    <input type="text" class="form-control" id="protipo" name="protipo" value="">
                </div>
                <div class="col-10 col-lg-7">
                    <label for="" class="form-label mt-2">URL Imagen:</label>
                    <input type="text" class="form-control" id="proimagen" name="proimagen" value="">
                </div>
                <div class="col-10 col-lg-7">
                    <label for="" class="form-label mt-2">Precio:</label>
                    <input type="number" class="form-control" id="proprecio" name="proprecio" value="">
                </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" id="botonModal" class="btn btn-primary">Guardar</button>
      </div>
      </form>
    </div>
  </div>
</div>
