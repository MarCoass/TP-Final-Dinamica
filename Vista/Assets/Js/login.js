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


//No me funciono ashuda D: es una función para el registro
(() => {
    'use strict'
  
    // Fetch all the forms we want to apply custom Bootstrap validation styles to
    const forms = document.querySelectorAll('.needs-validation')
  
    // Loop over them and prevent submission
    Array.from(forms).forEach(form => {
      form.addEventListener('submit', event => {
        if (!validaF()) {
          event.preventDefault()
          event.stopPropagation()
          
        }else{
          form.contrasenia.classList.remove('is-invalid');
        }
  
        //form.classList.add('was-validated')
      }, false)
    })
  })()
  
  
  function validaF(){
      let valida=true;
      if(!usuarioValido()){
        valida=false;
      }if(!contraseniaValida()){
        valida=false;
      }
      if(!mailValido()){
        valida=false;
      }
      return valida;
    }
  
  
  //funcion que se asegura de que la contraseña contenga numeros y caracteres
  //form.checkValidity()
  function contraseniaValida(){
      const form=document.querySelector('#nuevo_usuario');
      const password=form.password_nuevo.value;
      let valida=true;
      if(password.length<8){
        valida=false;
        form.contrasenia.classList.add('is-invalid');
        form.contrasenia.classList.remove('is-valid');
      }else if (password==""){
        form.contrasenia.classList.add('is-invalid');
        form.contrasenia.classList.remove('is-valid');
      }else if(!/[a-z][0-9]+$|[0-9][a-z]+$/i.test(password)){
          valida=false;
          form.contrasenia.classList.add('is-invalid');  
          form.contrasenia.classList.remove('is-valid'); 
      } else {
        form.contrasenia.classList.add('is-valid');
        form.contrasenia.classList.remove('is-invalid');
      }
      return valida;
    }
  
    function usuarioValido (){
      const form=document.querySelector('#nuevo_usuario');
      const username=form.usuario_nuevo.value;
      let valida=true;
      if (username==""){
        valida=false;
        form.usuario.classList.add('is-invalid');
      } else {
        form.usuario.classList.add('is-valid');
        form.usuario.classList.remove('is-invalid');
      }
      return valida;
    }

    function mailValido (){
        const form=document.querySelector('#nuevo_usuario');
        const username=form.mail_nuevo.value;
        let valida=true;
        if (username==""){
          valida=false;
          form.usuario.classList.add('is-invalid');
        } else {
          form.usuario.classList.add('is-valid');
          form.usuario.classList.remove('is-invalid');
        }
        return valida;
    }