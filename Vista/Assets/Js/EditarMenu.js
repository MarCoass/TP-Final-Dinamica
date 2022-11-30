$(document).ready(function() {
    $('form').submit(function(e) {
        e.preventDefault();
        $.ajax({
            type: "POST",
            url: 'Accion/editarMenu.php',
            data: $(this).serialize(),
            success: function(response){
                window.history.back();
           }
       });
    });
});