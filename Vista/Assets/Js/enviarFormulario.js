function enviarFormulario(form, action){
    $.ajax({
        type: "POST",
        url: action,
        data: form.serialize(),
        success: function(response){
            location.reload();
       }
   });
}