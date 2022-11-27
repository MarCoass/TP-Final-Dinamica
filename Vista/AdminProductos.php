<?php include_once('Common/Header.php');
$pagina="Deposito";
if ($sesion->tienePermisos($pagina)){
    $objProducto = new C_Producto();
    $arrayProductos = $objProducto->buscar([]);
?>

<div class="container-fluid" style="margin-bottom: 19%">
    <div class="container bg-dark col-md-10 text-white mt-5">
    <h3 class="text-light">Admin productos</h3>
        <div class="mb-3">
            <div class="mt-3 mb-3 d-none">
                <a class="btn text-decoration-none btn btn-outline-light" href="cargarProducto.php" id="botonModal">AGREGAR PRODUCTO</a>
            </div>
            <?php
            if ($arrayProductos != null) {
            ?>

                <table class="table table-striped table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Detalle</th>
                        <th>Cantidad de Stock</th>
                        <th>URL Imagen</th>
                        <th>Precio</th>
                        <th>Opciones</th>
                        
                    </tr>

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
                </table>
        </div>
    </div>


    
</div>


<?php include_once('Common/Footer.php'); 
} else {
    ?><script>
            window.location.href = "/TP-Final-Dinamica/Vista/Home.php";
        </script>
    <?php
    
    }
    ?>