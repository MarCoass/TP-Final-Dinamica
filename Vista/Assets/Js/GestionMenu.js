$(document).on('click', '.deshabilitar', function() {
    const form=$(this.parentNode);
    console.log(form);
    deshabilitarMenu(form);
}
)

function deshabilitarMenu(form){
    $.ajax({
        type: "POST",
        url: 'Accion/deshabilitarMenu.php',
        data: form.serialize(),
        success: function(response){
            location.reload();
       }
   });
}

$(document).on('click', '.habilitar', function() {
    const form=$(this.parentNode);
    habilitarMenu(form);
}
)


function habilitarMenu(form){
    $.ajax({
        type: "POST",
        url: 'Accion/habilitarMenu.php',
        data: form.serialize(),
        success: function(response){
            location.reload();
       }
   });
}