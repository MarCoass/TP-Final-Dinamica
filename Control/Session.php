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
        return $_SESSION['idusuario'];
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
        $listaUsuarios = $abmUsuario->buscar($where);
        if ($listaUsuarios >= 1) {
            $usuarioLog = $listaUsuarios[0];
        }
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

    public function getRoles(){
        //$objC_Usuario = new C_Usuario();
        $usuarioActual = $this->getUsuario(); //Usuario actual
        $objC_UsuarioRol = new C_Usuariorol(); //Creo el obj controlador de usuariorol para usar su buscar
        $param = ['idusuario' => $usuarioActual->getIdusuario()]; //obtengo el id del usuario actual
        $listaRoles = $objC_UsuarioRol->buscar($param);
        //echo "ROL: " . $listaRoles[0];
        //print_r($listaRoles);
        return $listaRoles;

    }

    /** CERRAR **/
    public function cerrar()
    {
        session_unset();
        session_destroy();
    }

    public function iniciar_carrito(){
        if (!isset($_SESSION['carrito'])) {
           $_SESSION['carrito'] = array();
           $_SESSION['carrito']['cantidad'] = 0;
           $_SESSION['carrito']['productos'] = array();
        }
    }

    public function insertar_producto_carrito($param){
        if(array_key_exists($param['id_producto'],$_SESSION['carrito']['productos'])){
            $_SESSION['carrito']['productos'][$param['id_producto']]['cantidad'] += $param['cantidad'];
            $_SESSION['carrito']['cantidad'] += $param['cantidad'];
        }else{
            $_SESSION['carrito']['productos'][$param['id_producto']] = array(
                'descripcion' => $param['nombre'],
                'cantidad' => $param['cantidad']
            );

            $_SESSION['carrito']['cantidad'] = $param['cantidad'];
        }
        
    }

    public function contarCarrito(){
      $totalcantidad = 0;
      if(isset( $_SESSION['carrito']['cantidad'])){
         $totalcantidad = $_SESSION['carrito']['cantidad'];
      }
        return $totalcantidad;
    }

    public function obtener_carrito(){
        
        if(isset( $_SESSION['carrito']['cantidad'])){
            $result =  $_SESSION['carrito'];
        }else{
            $result = false;
        }

        return $result;
    }
}