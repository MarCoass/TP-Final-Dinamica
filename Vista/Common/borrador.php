
<div class="collapse navbar-collapse" id="navbarHeader">
<ul class="navbar-nav">
    <li class="nav-item">
        <a class="nav-link active text-light fs-5" aria-current="page" href="Home.php">Inicio</a>
    </li>
    <li class="nav-item">
        <a class="nav-link text-light fs-5" href="#">Informes</a>
    </li>
    <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle text-light fs-5" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Productos
        </a>
        <ul class="dropdown-menu" id="dropdown">
            <li><a class="dropdown-item text-light" href="Productos2D.php">Impresiones 2D</a></li>
            <li><a class="dropdown-item text-light" href="Productos3D.php">Impresiones 3D</a></li>
            <li><a class="dropdown-item text-light" href="Accesorios.php">Accesorios</a></li>
        </ul>
    </li>


    include_once("Common/Header.php");

$datos = data_submitted();
$name = $datos['usuario'];
$pass = md5($datos['password']);

$sesion->setUserName($name);
$sesion->setPass($pass);
list($valido, $error) = $sesion->validar();

if ($valido) {
    header("Location:Home.php");
} else {
    $sesion->cerrar();
    header("Location:login.php?error=" . urlencode($error));
}