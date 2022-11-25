$(document).ready(function() {
    $('form').submit(function(e) {
        e.preventDefault();

        let contra=document.querySelector('#uspassAnterior').value;
        let contraNueva=document.querySelector('#uspassNueva').value;
        if(contraNueva.length>0){
            contraNueva = hex_md5(contraNueva).toString();
            document.querySelector('#uspassNueva').value = contraNueva;
            document.querySelector('#uspassNueva').name='uspass';
        }else{
            document.querySelector('#uspassAnterior').value=contra;
            document.querySelector('#usPassAnterior').name='uspass';
        }
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