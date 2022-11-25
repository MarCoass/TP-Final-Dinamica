
$(document).on('click', '.cambiarEstado', function() {
    const form = $(this.parentNode);
    console.log(form);
    $.ajax({
        type: "POST",
        url: 'Accion/cambiarEstado.php',
        data: form.serialize(),
        success: function(response){
            location.reload();
       }
   });
});