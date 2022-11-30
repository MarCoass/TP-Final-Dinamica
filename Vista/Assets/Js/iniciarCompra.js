$(document).on('click', '.iniciar', function() {

    $.ajax({
        type: "POST",
        url: 'Accion/iniciarCompra.php',
        success: function(response){
            location.reload();
       }
   });
});