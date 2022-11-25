

function enviarDato(id_compra){
    $.ajax({
        type: "POST",
        url: 'Accion/cambiarEstado.php',
        data: {
            idcompraestado: $('#idcompraestado_'+id_compra).val(),
            idcompra: id_compra,
            idcompraestadotipo: $('#idcompraestadotipo_'+id_compra).val()
        },
        success: function(response){
            location.reload();
       }
   });
}
