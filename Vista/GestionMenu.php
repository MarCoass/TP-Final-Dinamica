<?php
include_once("Common/Header.php");
if ($sesion->esAdmin()) {

        //obtengo todos los usuarios 
        $objC_Usuario = new C_Usuario();
        $usuarios = $objC_Usuario->buscar(NULL);
        $cantidadUsuarios = count($usuarios);
        $i = 0;
?>

<div class="container">
        <div class="display-1 text-light  text-center mt-3" id="titulo"><h3>Gesti&oacute;n de men&uacute;</h3></div>
</div>

<?php
include_once("Common/Footer.php");
} else {
        ?>
            <script>
                window.location.href = "/TP-Final-Dinamica/Vista/Home.php";
            </script>
        
        <?php
        }

        ?>        