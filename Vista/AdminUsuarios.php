<?php

/**este es usando data table */
include_once('Common/Header.php');
//obtengo todos los usuarios
$objUsuario = new C_Usuario();
$usuarios = $objUsuario->buscar([]);

?>
<div class="container-fluid bg-dark ">

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
                    <th><form method='post' action='EditarUsuario.php' id="'<?php echo $usuario->getIdUsuario() ?>'">
                                    <input style="display:none;" name='idusuario' id='idusuario' value='<?php echo $usuario->getIdUsuario() ?>'>
                                <button type="submit" class="ms-3 mt-3 text-decoration-none btn btn-outline-light">Editar</button></form></th>
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
<?php include_once('Common/Footer.php'); ?>