$(document).on('click', '.editar', function() {
    const form=$(this.parentNode);
    enviarFormulario(form, 'Accion/editarPerfil.php');
}
)


