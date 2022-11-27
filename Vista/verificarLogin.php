<?php
//agregar confi
include_once("Common/Header.php");

$datos = data_submitted();
$name = $datos['usuario'];
$pass = md5($datos['password']);

$sesion->setUserName($name);
$sesion->setPass($pass);
list($valido, $error) = $sesion->validar();

if ($valido) {
?>
    <script>
            Swal.fire({
                icon: 'success',
                title: 'Se inicio sesion correctamente!',
                showConfirmButton: false,
                timer: 1500
            })
            setTimeout(function() {
                redireccionarIndex();
            }, 1500);
    </script>
<?php
} else {
    $sesion->cerrar();
?>
    <script>
            Swal.fire({
                icon: 'error',
                title: 'La contraseña y/o el usuario no coinciden!',
                showConfirmButton: false,
                timer: 5000
            })
            setTimeout(function() {
                recargarPagina();
            }, 1500);
    </script>
<?php
}
?>


<script>
    function redireccionarIndex() {
        location.href = "Home.php"
    }
</script>

<script>
    function recargarPagina() {
        location.href = "Login.php"
    }
</script>