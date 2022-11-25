<?php
include_once ("HeaderIndex.php");
?>
<div>
    <div class="display-1 text-light  text-center mt-3" id="titulo"><h1>Bienvenidas a nuestro trabajo pr&aacute;ctico final</h1></div>
    <div class="text-center">
  <img src="Vista/Assets/Img/Puppycat.png" class="rounded" alt="Gatito estresado" id="imagenIndex">
</div>
    <a class="text-light" href="Vista/Home.php"><button type="button" class="btn btn-primary btn-lg ms-2" id="botonUser">Ir a la vista</button></a>
    <!-- Button trigger modal -->
<button type="button" class="btn btn-primary ms-2" data-bs-toggle="modal" data-bs-target="#exampleModal" id="botonUser">
  Ver integrantes del grupo
</button>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content bg-dark text-light">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Integrantes</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">

      <table class="table">
  <thead>
    <tr class="text-light">
      <th scope="col">Nombre</th>
      <th scope="col">Legajo</th>
    </tr>
  </thead>
  <tbody class="text-light">
    <tr>
      <td>Martina Milagros Rosales</td>
      <td>FAI-2752</td>
    </tr>
    <tr>
      <td>Martina Coassin-Fernández</td>
      <td>FAI-2542</td>
    </tr>
    <tr>
      <td>Micaela Aluhe Paillamilla Martinez</td>
      <td>FAI-2296</td>
    </tr>
  </tbody>
</table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" id="botonModal">Close</button>
      </div>
    </div>
  </div>
</div>
</div>
<?php
include_once ("FooterIndex.php");
?>