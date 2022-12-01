<?php
include_once 'C_Usuario.php';
include_once 'AbmUsuario.php';

//Constructor que inicia la sesion

//iniciar($nombreUsuario,$psw). Actualiza las variables de sesión con los valores ingresados.

//validar(). Valida si la sesión actual tiene usuario y psw  válidos. Devuelve true o false

//activa(). Devuelve true o false si la sesión está activa o no.

//getUsuario().Devuelve el usuario logeado.

//getRol(). Devuelve el rol del usuario  logeado.

//cerrar(). Cierra la sesión actual.

class Session
{

    /** CONSTRUCTOR **/
    public function __construct()
    {
        session_start();
    }


    /** GETS Y SETS **/
    public function getIdUser()
    {
        if (isset($_SESSION['idusuario'])) {
            return $_SESSION['idusuario'];
        }
        return null;
    }

    public function setIdUser($idUser)
    {
        $_SESSION['idusuario'] = $idUser;
    }

    public function getUserName()
    {
        return $_SESSION['usnombre'];
    }

    public function setUserName($userName)
    {
        $_SESSION['usnombre'] = $userName;
    }

    public function getPass()
    {
        return $_SESSION['uspass'];
    }
    public function setPass($pass)
    {
        $_SESSION['uspass'] = $pass;
    }

    /** INICIAR **/
    public function iniciar($nombreUsuario, $passUsuario)
    {
        $this->setUserName($nombreUsuario);
        $this->setPass($passUsuario);
    }


    /** VALIDAR **/
    public function validar()
    {

        $inicia = false;
        $nombreUsuario = $this->getUserName();
        $passUsuario = $this->getPass();
        $abmUsuario = new AbmUsuario();
        $where = array();
        $filtro1 = array();
        $filtro1['usnombre'] = $nombreUsuario;
        $filtro2 = array();
        $filtro2['uspass'] = $passUsuario;
        $where['usnombre'] = $nombreUsuario;
        $where['uspass'] = $passUsuario;
        $listaUsuarios = $abmUsuario->buscar($where);
        $username = $abmUsuario->buscar($filtro1);
        $pass =  $abmUsuario->buscar($filtro2);
        $error = "";
        if ($username == null) {
            $error .= "Este usuario no existe";
        } elseif ($pass == null) {
            $error .= "Contraseña incorrecta";
        }
        if (is_array($listaUsuarios) &&  count($listaUsuarios) > 0) {
            if ($listaUsuarios[0]->getUsdeshabilitado() != '0000-00-00 00:00:00') {
                $error .= "El usuario está deshabilitado";
            } else {
                $inicia = true;
                $this->setIdUser($listaUsuarios[0]->getidusuario());
            }
        }
        return array($inicia, $error);
    }


    /** ACTIVA **/
    public function activa()
    {
        $activa = false;
        if (isset($_SESSION['usnombre'])) {
            $activa = true;
        }
        return $activa;
    }


    /** GET USUARIO **/
    public function getUsuario()
    {
        $abmUsuario = new AbmUsuario();
        $where = ['idusuario' => $_SESSION['idusuario']];
        //print($_SESSION['idusuario']);
        $listaUsuarios = $abmUsuario->buscar($where);
        if ($listaUsuarios >= 1) {
            $usuarioLog = $listaUsuarios[0];
        }
        //print_r($usuarioLog);
        return $usuarioLog;
    }


    /** GET ROL **/
    public function getRol()
    {
        $abmUsuarioRol = new AbmUsuario();
        $usuario = $this->getUsuario();
        $idUsuario = $usuario->getIdUsuario();
        $param = ['idusuario' => $idUsuario];
        $listaRolesUsu = $abmUsuarioRol->buscar($param);
        if ($listaRolesUsu > 1) {
            $rol = $listaRolesUsu;
        } else {
            $rol = $listaRolesUsu[0];
        }
        return $rol;
    }

    public function getRoles()
    {
        //$objC_Usuario = new C_Usuario();
        $usuarioActual = $this->getUsuario(); //Usuario actual
        $objC_UsuarioRol = new C_Usuariorol(); //Creo el obj controlador de usuariorol para usar su buscar
        $param = ['idusuario' => $usuarioActual->getIdusuario()]; //obtengo el id del usuario actual
        //print_r($param);
        $listaRoles = $objC_UsuarioRol->buscar($param);
        //echo "ROL: " . $listaRoles[0];
        //print_r($listaRoles);
        foreach ($listaRoles as $unRol) {
            // print($unRol->getIdRol());
        }
        return $listaRoles;
    }

    public function esAdmin()
    {
        $arrayRoles = $this->getRoles();
        $esAdmin = false;
        $i = 0;

        while ($i < count($arrayRoles) && !$esAdmin) {
            if ($arrayRoles[$i]->getIdrol()->getIdrol() == 1) {
                $esAdmin = true;
            }
            $i++;
        }
        return $esAdmin;
    }

    public function esDeposito()
    {
        $arrayRoles = $this->getRoles();
        $esDepo = false;
        $i = 0;

        while ($i < count($arrayRoles) && !$esDepo) {
            if ($arrayRoles[$i]->getIdrol()->getIdrol() == 2) {
                $esDepo = true;
            }
            $i++;
        }
        return $esDepo;
    }

    public function esCliente()
    {
        $arrayRoles = $this->getRoles();
        $esCliente = false;
        $i = 0;

        while ($i < count($arrayRoles) && !$esCliente) {
            if ($arrayRoles[$i]->getIdrol()->getIdrol() == 3) {
                $esCliente = true;
            }
            $i++;
        }
        return $esCliente;
    }


    public function tienePermisos($pagina)
    {
        $tienePermisos = false;
        if ($this->activa()) {
            $tienePermisos = true;
        } else {
            $tienePermisos = false;
        }
        if ($this->esAdmin() && $pagina == "Admin") {
            $tienePermisos = true;
        } elseif ($this->esDeposito() && $pagina == "Deposito") {
            $tienePermisos = true;
        } elseif ($this->esCliente() && $pagina == "Cliente") {
            $tienePermisos = true;
        } else {
            $tienePermisos = false;
        }

        return $tienePermisos;
    }

    /** CERRAR **/
    public function cerrar()
    {
        session_unset();
        session_destroy();
    }


    /**
     * basename($_SERVER['PHP_SELF']); <-- retorna el nombre, por ejemplo Productos3D.php
     */
    public function tienePermiso()
    {
        //obtengo el nombre de la pagina
        $nombrePagina = basename($_SERVER['PHP_SELF']);

        //busco el objMenu con el script = nombrePagina
        $objC_Menu = new C_Menu();
        $objMenuActual = $objC_Menu->buscar(['script' => $nombrePagina]);

        $existeEnBD = isset($objMenuActual);
        
        if ($this->activa() && $existeEnBD && $nombrePagina != 'Home.php' && $nombrePagina != 'Login.php') {

            //busco el objMenu con el script = nombrePagina
            $objC_Menu = new C_Menu();
            $objMenuActual = $objC_Menu->buscar(['script' => $nombrePagina])[0];

            //busco los roles de esa pagina
            $objC_MenuRoles = new C_Menurol();
            $rolesMenu = $objC_MenuRoles->buscar(['idmenu' => $objMenuActual->getIdmenu()]);

            //obtengo los roles del usuario
            $rolesUsuario = $this->getRoles();

            //recorro los roles del usuario
            $encontrado = false;
            
            foreach($rolesUsuario as $rolUsuario){
                foreach($rolesMenu as $rolMenu){
                    if($rolUsuario->getIdrol()->getIdrol() == $rolMenu->getIdrol()->getIdrol()){
                        $encontrado = true;
                    }
                }
            }
            
        } else {
            if ($nombrePagina != 'Home.php' && $nombrePagina != 'Login.php') {
                $encontrado = false;
            } else {
                $encontrado = true;
            }
        }
        return $encontrado;
    }
}
