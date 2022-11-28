$(document).on('click', '.deshabilitar', function() {
    const form=$(this.parentNode);
    console.log(form);
    enviarFormulario(form, 'Accion/deshabilitarUser.php');
}
)

$(document).on('click', '.habilitar', function() {
    const form=$(this.parentNode);
    enviarFormulario(form, 'Accion/habilitarUser.php') ;
}
)
