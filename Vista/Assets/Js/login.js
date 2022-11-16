$( document ).ready(function() {
    document.getElementById('nuevo_usuario').style.display = 'none';
});
function mostrar_nuevo_usuario(){
    document.getElementById('login_from').style.display = 'none';
    document.getElementById('nuevo_usuario').style.display = 'block';
}

function mostrar_login(){
    document.getElementById('nuevo_usuario').style.display = 'none';
    document.getElementById('login_from').style.display = 'block';
}

