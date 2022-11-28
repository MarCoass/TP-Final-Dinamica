$(document).ready(function() {
    $('form').submit(function(e) {
        e.preventDefault();
        $.ajax({
            type: "POST",
            url: 'Accion/editarUser.php',
            data: $(this).serialize(),
            success: function(response){
                location.reload();
           }
       });
    });
});