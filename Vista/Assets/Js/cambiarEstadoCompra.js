$(document).on('click', '.siguienteEstado', function() {
    const form=$(this.parentNode);
    console.log(form);
    /**$.ajax({
        type: "POST",
        url: 'Accion/siguienteEstado.php',
        data: form.serialize(),
        success: function(response){
            location.reload();
       }
   });*/
});