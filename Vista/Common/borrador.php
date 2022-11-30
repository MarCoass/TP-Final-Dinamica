
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


public function tienePermisos($pagina){
        $arrayRoles = $this->getRoles();
        $tienePermisos = false;
        $i = 0;

        while ($i< count($arrayRoles) && !$tienePermisos){
            $rol = $arrayRoles[$i]->getIdRol();
            if($rol==1 && $pagina=="Admin"){
                $tienePermisos=true;
            }elseif($rol==2 && $pagina=="Deposito"){
                $tienePermisos=true;
            }
            $i++;
        }
    }

    
    public function getRoles()
    {
        //$objC_Usuario = new C_Usuario();
        $usuarioActual = $this->getUsuario(); //Usuario actual
        $objC_UsuarioRol = new C_Usuariorol(); //Creo el obj controlador de usuariorol para usar su buscar
        $param = ['idusuario' => $usuarioActual->getIdusuario()]; //obtengo el id del usuario actual
        $listaRoles = $objC_UsuarioRol->buscar($param);
        //echo "ROL: " . $listaRoles[0];
        //print_r($listaRoles);
        $roles = array();
        foreach ($listaRoles as $unRol){
            $roles=array_push($unRol->getIdRol());
        }
        print_r($roles);
        return $roles;
    }

    window.history.back();