
<?php 
include_once("Common/Header.php");
?>
<link rel="stylesheet" href="Assets/Css/login.css">
<script src="Assets/Js/login.js"></script>

<div class="wrapper fadeInDown">
  <div id="formContent">
    <!-- Tabs Titles -->

    <!-- Icon -->
    <div class="fadeIn first">
      <img src="/TP-Final-Dinamica/Vista/Assets/Img/logo simple.png" width="70px" class="mb-1">
    </div>

    <!-- Login Form -->
    <form id="login_from" class="form-signin needs-validation" name="login_from" method="POST" action="verificarLogin.php" novalidate>
      <input type="text" id="usuario" class="fadeIn second form-control" name="usuario" placeholder="username" required>
      <div class="invalid-feedback">
        Ingresar un usuario
      </div>
      <input type="password" id="password" class="fadeIn third form-control" name="password" placeholder="password" required>
      <div class="invalid-feedback">
        Ingresar una contraseña
      </div>
      <input type="submit" class="fadeIn fourth" value="Log In">
    </form>

    <form id="nuevo_usuario" class="form-signin needs-validation" name="nuevo_usuario" method="POST" action="registrar_usuario.php" novalidate>
      <input type="text" id="usuario_nuevo" class="fadeIn second form-control" name="usuario_nuevo" placeholder="username" required>
      <div class="invalid-feedback">
        Ingresar un usuario
      </div>
      <input type="text" id="mail_nuevo" class="fadeIn second form-control" name="mail_nuevo" placeholder="usuario@gmail.com" required>
      <div class="invalid-feedback">
        Ingresar un mail
      </div>
      <input type="password" id="password_nuevo" class="fadeIn third form-control" name="password_nuevo" placeholder="password" required>
      <div class="invalid-feedback">
        Ingresar una contraseña
      </div>
      <input type="submit" class="fadeIn fourth" value="Registrar">
    </form>

    <!-- Remind Passowrd -->
    <div id="formFooter">
      <a class="underlineHover" onclick="mostrar_nuevo_usuario()" href="#">Registrate</a>
      |
      <a class="underlineHover" onclick="mostrar_login()" href="#">Login</a>
    
    </div>

  </div>
</div>

<script src="Assets/Js/Validacion.js"> </script>
<?php
include_once("Common/Footer.php");
?>