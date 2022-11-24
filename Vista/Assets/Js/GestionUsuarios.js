$(document).on('click', '.deshabilitar', function() {
    const form=$(this.parentNode);
    console.log(form);
    deshabilitarUsuario(form);
}
)

function deshabilitarUsuario(form){
    $.ajax({
        type: "POST",
        url: 'Accion/deshabilitarUser.php',
        data: form.serialize(),
        success: function(response){
            location.reload();
       }
   });
}

$(document).on('click', '.habilitar', function() {
    const form=$(this.parentNode);
    habilitarUsuario(form);
}
)


function habilitarUsuario(form){
    $.ajax({
        type: "POST",
        url: 'Accion/habilitarUser.php',
        data: form.serialize(),
        success: function(response){
            location.reload();
       }
   });
}