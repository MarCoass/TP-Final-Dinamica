<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/html2canvas@1.0.0-rc.1/dist/html2canvas.min.js"></script>
<?php
$obj_compra = new C_Compra();
$obj_compra_item = new C_Compraitem();
$compra_borrador = $obj_compra->obtener_compra_borrador_de_usuario($sesion->getIdUser());

if($compra_borrador != null ){
  $productos_compra = $obj_compra_item->buscar(array('idcompra' => $compra_borrador[0]->getIdcompra()));
}else{
  $productos_compra = null;
}


?>
<div class="modal fade" id="modal_cart" tabindex="-1"  aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content bg-dark text-light">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Carrito</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
   <table class="table table-striped text-light">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Producto</th>
      <th scope="col">Cantidad</th>
      <th scope="col">Precio</th>
    </tr>
  </thead>
  <tbody >
    <?php
    if(is_array($productos_compra) && count($productos_compra) > 0){
      $i = 1;
      foreach($productos_compra as $indice => $prd){

        $obj_producto = new C_Producto();
        $producto = $prd->getIdproducto();
    ?>
    <tr>
      <th scope="row" class="text-light"><?php echo  $i ?></th>
      <td class="text-light"><?php echo $producto->getPronombre(); ?></td>
      <td class="text-light"><?php echo $prd->getCicantidad(); ?></td>
      <td class="text-light"><?php echo ($prd->getCicantidad()*$producto->getProprecio()) ?></td>
    </tr>
    <?php $i++;
      }}?>
  </tbody>
</table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
        <a type="button" class="btn btn-primary" href="borrarcarro.php" id="botonModal">Vaciar carrito</a>
        <button type="button" class="btn btn-primary iniciar" href="" id="botonModal">Iniciar Compra</button>
      </div>
    </div>
  </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.9.2/umd/popper.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.1/js/bootstrap.min.js"></script>
<footer class="page-footer font-small position-relative bottom-0">
  <div class="container row mt-2">
    <div class="text-light col-9 ms-2 mb-2" id="infoContacto">
      CONTACTO <br>
      Instagram: besto3d <br>
      Whatsapp: +54 299 655 1374 
    </div>
    <!-- Copyright -->
    <!-- Todavía no logro ubicar bien este div, tiene que quedar más pegado al lado derecho del footer  -->
    <div class="footer-copyright text-center py-3 text-light col mx-0 mt-2" id="copyright">Equipo Alfa Buena Onda :)
    </div>
  </div>
</footer>
<script src="Assets/Js/enviarFormulario.js"></script>
<script src="Assets/Js/iniciarCompra.js"></script>
</body>
</html>