<?php 
/**este es usando data table */
include_once('Common/Header.php');
?>

<div class="container-fluid bg-light">

<table id="lista_de_productos" class="table table-bordered nowrap table-striped table-condensed" style="width:100%">
                                                        <thead>
                                                        <tr>
                                                            <th data-priority="1"></th>	
                                                            <th class="text" data-priority="1"> Nombre </th>									
                                                            <th class="text" data-priority="1"> Mail </th>
                                                            <th class="text" data-priority="1"> Rol </th>
                                                            <th class="text" data-priority="1"> Estado </th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>    
                                                        </tbody>
                                                        <tfoot>
                                                        <tr> 
                                                        <th ></th>	
                                                            <th > Nombre </th>									
                                                            <th > Mail </th>
                                                            <th > Rol </th>
                                                            <th > Estado </th>                                         	  	                                       	                                          	                                          	  	                 	  	                                      	  
                                                        </tr>
                                                        </tfoot>      
                                                    </table>

</div>

<form action="ACA VA EL ACTION" enctype="multipart/form-data" method="post" id="form_editarUsuario">
 <input type="hidden" name="idUsuario" id="idUsuario" />
</form>

<script src="Assets/Js/AdminUsuarios.js"></script>
<?php include_once('Common/Footer.php'); ?>