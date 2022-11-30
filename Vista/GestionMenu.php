<?php
include_once("Common/Header.php");
$pagina="Admin";
if ($sesion->tienePermisos($pagina)){

        //obtengo todos los menues
        $objC_Menu = new C_Menu();
        $menues = $objC_Menu->buscar(NULL);
        $cantidadMenues = count($menues);
        $obj_roles = new C_Rol();
        $roles = $obj_roles->buscar([]);
        $i = 0;
        //FALTA TESTEAR ESTE CODIGO, COPIE EL DE EDITAR USUARIO Y CAMBIE TODAS LAS VARIABLES A MENU
?>

<div class="container-fluid mb-5">
<div class="container bg-dark col-md-10 text-white mt-5">
<br/>
<button type="button" class="btn btn-primary" data-toggle="modal" id="botonModal" data-target="#agregarMenu">
 Agregar Menu
</button>
<br/><br/>
<h3 class="text-light">Gestionar Menu</h3>
    <table id="lista_menues" class="text-light table table-bordered nowrap  table-condensed" style="width:100%">
        <thead>
            <tr>
                
                <th class="text" data-priority="1"> Nombre </th>
                <th class="text" data-priority="1"> Descripcion </th>
                <th class="text" data-priority="1"> Rol </th>
                <th class="text" data-priority="1"> Estado </th>
                <th></th>
            </tr>
        </thead>
        <tbody class="text-light">
            <?php foreach ($menues as $menu) {

                $estadoMenu = $menu->getMedeshabilitado() == null || $menu->getMedeshabilitado() == '0000-00-00 00:00:00' ? "Habilitado" : "Deshabilitado";
                //busco los roles
                $objMenuRol = new C_MenuRol();
                //busco los roles del menu
                $rolesMenu = $objMenuRol->buscar(['idmenu' => $menu->getIdmenu()]);
                $txtRoles = "";
                foreach ($rolesMenu as $rol) {
                    $txtRoles = $txtRoles . " " . $rol->getIdrol()->getRodescripcion();
                } ?>

                <tr>
                    
                    <th> <?php echo $menu->getMenombre(); ?> </th>
                    <th> <?php echo $menu->getMedescripcion(); ?> </th>
                    <th> <?php echo $txtRoles; ?> </th>
                    <th> <?php echo $estadoMenu ?> </th>
                    <th><form method='post' action='EditarMenu.php' id="'<?php echo $menu->getIdmenu() ?>">
                                    <input style="display:none;" name='idmenu' id='idmenu' value='<?php echo $menu->getIdmenu() ?>'>
                                    <button type="submit" class="ms-3 mt-3 text-decoration-none btn btn-outline-light"> EDITAR </button>
                                    <?php echo $menu->getMedeshabilitado() == null || $menu->getMedeshabilitado() == '0000-00-00 00:00:00'  ?
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
                <th> Descripcion </th>
                <th> Rol </th>
                <th> Estado </th>
                <th></th>
            </tr>
        </tfoot>
    </table>
</div>
</div>

<form action="ACA VA EL ACTION" enctype="multipart/form-data" method="post" id="form_editarMenu">
    <input type="hidden" name="idMenu" id="idMenu" />
</form>

<script>
    $(document).ready(function () {
 $('#lista_menues').DataTable( {			
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
    "lengthMenu": [[4,50,-1], [10, 50, "Todos"]],
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
<script src="Assets/Js/GestionMenu.js"></script>

<div class="modal fade" id="agregarMenu" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content bg-dark text-light">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Agregar <Menu></Menu></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div> 
      <form name="form" action="Accion/agregarMenu.php" method="post">
         <div class="modal-body">
                <div class="col-10 col-lg-7">
                    <label for="floatingInput" class="form-label mt-2">Nombre: </label>
                    <input type="text" class="form-control" placeholder="nombre" minlength="3" name="menombre" id="menombre" value="" required>
                </div>
                <div class="col-10 col-lg-7">
                    <label for="" class="form-label mt-2">descripcion </label>
                    <input type="text" class="form-control" placeholder="descripcion" name="medescripcion" id="medescripcion" value="" required>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" value="false" name="padre" id="flexRadioDefault1">
                    <label class="form-check-label" for="flexRadioDefault1">
                        Tiene men&uacute; padre
                    </label>
                    </div>
                    <div class="form-check">
                    <input class="form-check-input" type="radio" value="true" name="padre" id="flexRadioDefault2" checked>
                    <label class="form-check-label" for="flexRadioDefault2">
                        No tiene men&uacute; padre
                    </label>
                    </div>
                <div>
                <select name="idpadre" class="form-select" aria-label="Default select example">
                    <?php 
                    $menues = $objMenuRol->menuesByIdRol($idRoles);
                    foreach ($menues as $itemMenu) {
                        if ($itemMenu->getIdpadre() == NULL) { 
                            $idPadre = $itemMenu->getIdmenu()?>
                    <option value= <?php echo $idPadre ?>><?php echo $itemMenu->getMenombre()?></option>
                    
                    <?php 
                } 
                    }?>
                </select>
                </div>
                <div class="col-10 col-lg-7">
                <div class="col-8 col-lg-7 mt-4">
                    <h6 class="text-center mb-3">Roles</h6>


                    <?php
                    foreach ($roles as $rol) {
                    ?>
                            <div class="form-check">
                                <input class='form-check-input' type='checkbox' name='rol[]' value='<?php echo $rol->getIdrol() ?>' <?php
                                                                                                                                    foreach ($rolesMenu as $rolMenu) {

                                                                                                                                    ?><?php
                                                                                                                                            
                                                                                                                                        }
                                                                                                                                                ?>>
                                <label class='form-check-label' for='admin'><?php echo $rol->getRodescripcion() ?> </label>
                            </div>
                        <?php
                    }
                    ?>
                </div>
                <div class="col-10 col-lg-7">
                    <label for="" class="form-label mt-2">script</label>
                    <input type="text" class="form-control" placeholder="script" name="script" id="script" value="" required>
                </div>
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