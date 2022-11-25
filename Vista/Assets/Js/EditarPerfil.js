$(document).on('click', '.editar', function() {
    const form=$(this.parentNode);
    console.log(form);
    editarPerfil(form);
}
)

function editarPerfil(form){
    $.ajax({
        type: "POST",
        url: 'Accion/editarPerfil.php',
        data: form.serialize(),
        success: function(response){
            location.reload();
       }
   });
}
