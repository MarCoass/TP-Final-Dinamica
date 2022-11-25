<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/html2canvas@1.0.0-rc.1/dist/html2canvas.min.js"></script>
<?php
$carrito = $sesion->obtener_carrito();
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
  <tbody>
    <?php
    if(count($carrito['productos']) > 0){
      $i = 1;
      foreach($carrito['productos'] as $producto){
    ?>
    <tr>
      <th scope="row"><?php echo  $i ?></th>
      <td><?php echo $producto['descripcion'] ?></td>
      <td><?php echo $producto['cantidad'] ?></td>
      <td><?php echo ($producto['cantidad']*$producto['precio']) ?></td>
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

<script src="Assets/Js/iniciarCompra.js"></script>
</body>
</html>