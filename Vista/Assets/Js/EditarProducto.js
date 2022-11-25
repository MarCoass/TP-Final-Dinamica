$(document).ready(function() {
    $('form').submit(function(e) {
        e.preventDefault();

        $.ajax({
            type: "POST",
            url: 'Accion/editarProducto.php',
            data: $(this).serialize(),
            success: function(response){
                location.reload();
           }
       });
    });
});