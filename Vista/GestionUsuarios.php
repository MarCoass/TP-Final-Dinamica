<?php

/**este es usando data table */
include_once('Common/Header.php');
$pagina="Admin";
if ($sesion->tienePermisos($pagina)){

?>
<script src="../Vista/Assets/Js/enviarFormulario.js"></script>
<?php
//obtengo todos los usuarios
$objUsuario = new C_Usuario();
$obj_roles = new C_Rol();
$roles = $obj_roles->buscar([]);
$usuarios = $objUsuario->buscar([]);

?>
<div style="margin:30px;">
<div class="container-fluid bg-dark ">
<br/>
<button type="button" class="btn btn-primary" data-toggle="modal" id="botonModal" data-target="#agregarUsuario">
 Agregar Usuario
</button>
<br/><br/>
    <table id="lista_usuarios" class="text-light table table-bordered nowrap  table-condensed" style="width:100%">
        <thead>
            <tr>
                
                <th class="text" data-priority="1"> Nombre </th>
                <th class="text" data-priority="1"> Mail </th>
                <th class="text" data-priority="1"> Rol </th>
                <th class="text" data-priority="1"> Estado </th>
                <th></th>
            </tr>
        </thead>
        <tbody class="text-light">
            <?php foreach ($usuarios as $usuario) {

                $estadoUsuario = $usuario->getUsdeshabilitado() == '0000-00-00 00:00:00' ? "Habilitado" : "Deshabilitado";
                //busco los roles
                $objUsuarioRol = new C_UsuarioRol();
                //busco los roles el usuario
                $rolesUsuario = $objUsuarioRol->buscar(['idusuario' => $usuario->getIdusuario()]);
                $txtRoles = "";
                foreach ($rolesUsuario as $rol) {
                    $txtRoles = $txtRoles . " " . $rol->getIdrol()->getRodescripcion();
                } ?>

                <tr>
                    
                    <th> <?php echo $usuario->getUsnombre(); ?> </th>
                    <th> <?php echo $usuario->getUsmail(); ?> </th>
                    <th> <?php echo $txtRoles; ?> </th>
                    <th> <?php echo $estadoUsuario ?> </th>
                    <th><form method='post' action='EditarUsuario.php' id="'<?php echo $usuario->getIdUsuario() ?>">
                                    <input style="display:none;" name='idusuario' id='idusuario' value='<?php echo $usuario->getIdUsuario() ?>'>
                                    <button type="submit" class="ms-3 mt-3 text-decoration-none btn btn-outline-light"> EDITAR </button>
                                    <br/>
                                    <?php echo $usuario->getUsdeshabilitado() == "0000-00-00 00:00:00" ?
                                        "<button type='button' class='mx-2 mt-1 text-decoration-none btn deshabilitar text-light' id='botonModal'>
                        DESHABILITAR
                        </button>" :
                                        "<button type='button' class='mx-2 mb-1 text-decoration-none btn habilitar' id='botonModal'>
                        HABILITAR
                        </button>";
                                    ?>

                                </form></th>
                </tr>
            <?php
            } ?>
        </tbody>
        <tfoot>
            <tr>
                
                <th> Nombre </th>
                <th> Mail </th>
                <th> Rol </th>
                <th> Estado </th>
                <th></th>
            </tr>
        </tfoot>
    </table>

</div>
</div>
<form action="ACA VA EL ACTION" enctype="multipart/form-data" method="post" id="form_editarUsuario">
    <input type="hidden" name="idUsuario" id="idUsuario" />
</form>

<script>
    $(document).ready(function () {
 $('#lista_usuarios').DataTable( {			
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
              'checkboxes': {
                 'selectRow': true
              }
          }                   
    ],
    'select': {
        'style': 'single'
     }	            
  } );
});
</script>
<script src="Assets/Js/GestionUsuarios.js"></script>
<?php include_once('Common/Footer.php');
} else {
    ?><script>
            window.location.href = "/TP-Final-Dinamica/Vista/Home.php";
        </script>
    <?php
    
    }
?>

<div class="modal fade" id="agregarUsuario" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content bg-dark text-light">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Agregar Usuario</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div> 
      <form name="form" action="Accion/agregarUsuario.php" method="post">
         <div class="modal-body">
                <div class="col-10 col-lg-7">
                    <label for="floatingInput" class="form-label mt-2">Nombre: </label>
                    <input type="text" class="form-control" placeholder="nombre" minlength="3" name="nombre" id="nombre" value="" required>
                </div>
                <div class="col-10 col-lg-7">
                    <label for="" class="form-label mt-2">email: </label>
                    <input type="text" class="form-control" placeholder="usuario@gmail.com" name="email" id="email" value="" required>
                </div>
                <div class="col-10 col-lg-7">
                    <label for="" class="form-label mt-2">pass:</label>
                    <input type="password" class="form-control" id="password" name="password" value="">
                </div>
                <div class="col-10 col-lg-7">
                <label for="" class="form-label mt-2">Rol:</label>
                <select name="rol" class="form-select" aria-label="Default select example">
                    <?php foreach ($roles as $rol){ ?>
                    <option value="<?php echo $rol->getIdrol() ?>"><?php echo $rol->getRodescripcion() ?></option>
                    <?php } ?>
                </select>
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
