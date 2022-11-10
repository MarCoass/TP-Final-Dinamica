<?php
include_once '../Modelo/conector/BaseDatos.php';
class Usuario
{
    private $idusuario;
    private $usnombre;
    private $uspass;
    private $usmail; 
    private $usdeshabilitado;
    private $mensaje;

    public function __construct()
    {
        $this->idusuario = "";
        $this->usnombre = "";
        $this->uspass = "";
        $this->usmail = '';
        $this->usdeshabilitado = "";
    }

    public function cargar($idusuario, $usnombre, $uspass, $usmail, $usdeshabilitado)
    {
        $this->setIdusuario($idusuario);
        $this->setUsnombre($usnombre);
        $this->setUspass($uspass);
        $this->setUsmail($usmail);
        $this->setUsdeshabilitado($usdeshabilitado);
    }

    public function getIdusuario(){
        return $this->idusuario;
    }

    public function setIdusuario($idusuario){
        $this->idusuario = $idusuario;
    }

    public function getUsnombre(){
        return $this->usnombre;
    }

    public function setUsnombre($usnombre){
        $this->usnombre = $usnombre;
    }

    public function getUspass(){
        return $this->uspass;
    }

    public function setUspass($uspass){
        $this->uspass = $uspass;
    }

    public function getUsmail(){
        return $this->usmail;
    }

    public function setUsmail($usmail){
        $this->usmail = $usmail;
    }

    public function getusdeshabilitado(){
        return $this->usdeshabilitado;
    }

    public function setUsdeshabilitado($usdeshabilitado){
        $this->usdeshabilitado = $usdeshabilitado;
    }

    public function getMensaje(){
        return $this->mensaje;
    }

    public function setMensaje($mensaje){
        $this->mensaje = $mensaje;
    }

    public function __toString()
    {
        return "idusuario: " . $this->getIdusuario() .
            "\nusnombre: " . $this->getUsnombre() .
            "\nuspass: " . $this->getUspass() .
            "\nusmail: " . $this->getUsmail() . 
            "\nusdeshabilitado: " . $this->getusdeshabilitado();
    }

    //Funciones BD

    //BUSCAR
    public function buscar($idusuario)
    {
        $base = new BaseDatos();
        $resp = false;
        $sql = "SELECT * FROM usuario WHERE idusuario = '" . $idusuario . "'";
        if ($base->Iniciar()) {
            if ($base->Ejecutar($sql)) {
                if ($row2 = $base->Registro()) {
                    $this->setIdusuario($row2['idusuario']);
                    $this->setUsnombre($row2['usnombre']);
                    $this->setUspass($row2['uspass']);
                    $this->setUsmail($row2['usmail']);
                    $this->setUsdeshabilitado($row2['usdeshabilitado']);
                    $resp = true;
                }
            } else {
                $this->setUsdeshabilitado($base->getError());
            }
        } else {
            $this->setUsdeshabilitado($base->getError());
        }
        return $resp;
    }

    //LISTAR
    public function listar($condicion = '')
    {
        $array = null;
        $base = new BaseDatos();
        $sql =  "select * from usuario";
        if ($condicion != '') {
            $sql = $sql . ' where ' . $condicion;
        }
        if ($base->Iniciar()) {
            if ($base->Ejecutar($sql)) {
                $array = array();
                while ($row2 = $base->Registro()) {
                    $objusuario = new usuario();
                    $objusuario->buscar($row2['idusuario']);
                    $array[] = $objusuario;
                }
            } else {
                $this->setUsdeshabilitado($base->getError());
            }
        } else {
            $this->setUsdeshabilitado($base->getError());
        }

        return $array;
    }

    //INSERTAR
    public function insertar()
    {
        $base = new BaseDatos();
        $resp = false;
        $idusuario = $this->getIdusuario();
        $usnombre = $this->getUsnombre();
        $uspass = $this->getUspass();
        $usmail = $this->getUsmail();
        $usdeshabilitado = $this->getusdeshabilitado();
        //Creo la consulta 
        $sql = "INSERT INTO usuario (idusuario, usnombre, uspass, usmail, usdeshabilitado) VALUES ('{$idusuario}', '{$usnombre}', '{$uspass}', '{$usmail}', '{$usdeshabilitado}')";
        if ($base->Iniciar()) {
            if ($base->Ejecutar($sql)) {
                $resp = true;
            } else {
                $this->setUsdeshabilitado($base->getError());
            }
        } else {
            $this->setUsdeshabilitado($base->getError());
        }
        return $resp;
    }

    //MODIFICAR
    public function modificar()
    {
        $base = new BaseDatos();
        $resp = false;
        $idusuario = $this->getIdusuario();
        $usnombre = $this->getUsnombre();
        $uspass = $this->getUspass();
        $usmail = $this->getUsmail();
        $usdeshabilitado = $this->getusdeshabilitado();

        $sql = "UPDATE usuario SET usnombre = '{$usnombre}', uspass = '{$uspass}', usmail = '{$usmail}', usdeshabilitado = '{$usdeshabilitado}' WHERE idusuario = '{$idusuario}'";
        if ($base->Iniciar()) {
            if ($base->Ejecutar($sql)) {
                $resp = true;
            } else {
                $this->setUsdeshabilitado($base->getError());
            }
        } else {
            $this->setUsdeshabilitado($base->getError());
        }
        return $resp;
    }

    //ELIMINAR
    public function eliminar()
    {
        $base = new BaseDatos();
        $rta = false;
        $consulta = "DELETE FROM usuario WHERE idusuario = " . $this->getIdusuario();
        if ($base->Iniciar()) {
            if ($base->Ejecutar($consulta)) {
                $rta = true;
            } else {
                $this->setUsdeshabilitado($base->getError());
            }
        } else {
            $this->setUsdeshabilitado($base->getError());
        }
        return $rta;
    }

    
}