
<?php include_once ('Common/Header.php')?>
<link rel="stylesheet" href="Assets/css/login.css">
<script src="Assets/Js/md5.js"></script>
<script src="Assets/Js/login.js"></script>

<div class="wrapper fadeInDown">
  <div id="formContent">
    <!-- Tabs Titles -->

    <!-- Icon -->
    <div class="fadeIn first">
      <img src="/TPInvestigacion/Vista/Assets/Img/logo simple.png" width="70px" class="mb-1">
    </div>

    <!-- Login Form -->
    <form id="login_from">
      <input type="text" id="usuario" class="fadeIn second" name="usuario" placeholder="usuario@gmail.com">
      <input type="text" id="password" class="fadeIn third" name="password" placeholder="password">
      <input type="submit" class="fadeIn fourth" value="Log In">
    </form>

    <form id="nuevo_usuario">
      <input type="text" id="usuario_nuevo" class="fadeIn second" name="usuario_nuevo" placeholder="usuario@gmail.com">
      <input type="text" id="password_nuevo" class="fadeIn third" name="password_nuevo" placeholder="password">
      <input type="button" onclick="registrar_nuevo_usuario()" class="fadeIn fourth" value="Registrar">
    </form>

    <!-- Remind Passowrd -->
    <div id="formFooter">
      <a class="underlineHover" onclick="mostrar_nuevo_usuario()" href="#">Registrate</a>
      |
      <a class="underlineHover" onclick="mostrar_login()" href="#">Login</a>
    
    </div>

  </div>
</div>