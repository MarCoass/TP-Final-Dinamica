<?php

include_once '../Modelo/Conector/BaseDatos.php';
class Rol
{
    private $idrol;
    private $rodescripcion;
    private $mensaje;
    

    public function __construct()
    {
        $this->idrol = "";
        $this->rodescripcion = "";
       
    }

    public function cargar($idrol, $rodescripcion)
    {
        $this->setidrol($idrol);
        $this->setrodescripcion($rodescripcion);
    }

    //Metodos de acceso
    public function getIdrol(){
        return $this->idrol;
    }

    public function setIdrol($idrol){
        $this->idrol = $idrol;
    }

    public function getRodescripcion(){
        return $this->rodescripcion;
    }

    public function setRodescripcion($rodescripcion){
        $this->rodescripcion = $rodescripcion;
    }

    public function getMensaje(){
        return $this->mensaje;
    }

    public function setMensaje($mensaje){
        $this->mensaje = $mensaje;
    }

    public function __toString()
    {
        return "idrol: " . $this->getidrol() .
            "\nrodescripcion: " . $this->getrodescripcion();
    }

    //Funciones BD

    //BUSCAR
    public function buscar($idrol)
    {
        $base = new BaseDatos();
        $resp = false;
        $sql = "SELECT * FROM rol WHERE idrol = '" . $idrol . "'";
        if ($base->Iniciar()) {
            if ($base->Ejecutar($sql)) {
                if ($row2 = $base->Registro()) {
                    $this->setidrol($row2['idrol']);
                    $this->setrodescripcion($row2['rodescripcion']);
                    $resp = true;
                }
            } else {
                $this->setMensaje($base->getError());
            }
        } else {
            $this->setMensaje($base->getError());
        }
        return $resp;
    }

    //LISTAR
    public function listar($condicion = '')
    {
        $array = null;
        $base = new BaseDatos();
        $sql =  "select * from rol";
        if ($condicion != '') {
            $sql = $sql . ' where ' . $condicion;
        }
        if ($base->Iniciar()) {
            if ($base->Ejecutar($sql)) {
                $array = array();
                while ($row2 = $base->Registro()) {
                    $objrol = new rol();
                    $objrol->buscar($row2['idrol']);
                    $array[] = $objrol;
                }
            } else {
                $this->setMensaje($base->getError());
            }
        } else {
            $this->setMensaje($base->getError());
        }

        return $array;
    }

    //INSERTAR
    public function insertar()
    {
        $base = new BaseDatos();
        $resp = false;
        //Asigno los datos a variables
        $idrol = $this->getidrol();
        $rodescripcion = $this->getrodescripcion();

        //Creo la consulta 
        $sql = "INSERT INTO rol (idrol, rodescripcion) VALUES ('{$idrol}', '{$rodescripcion}')";
        if ($base->Iniciar()) {
            if ($base->Ejecutar($sql)) {
                $resp = true;
            } else {
                $this->setMensaje($base->getError());
            }
        } else {
            $this->setMensaje($base->getError());
        }
        return $resp;
    }

    //MODIFICAR
    public function modificar()
    {
        $base = new BaseDatos();
        $resp = false;
        $idrol = $this->getidrol();
        $rodescripcion = $this->getrodescripcion();
        $sql = "UPDATE rol SET rodescripcion = '{$rodescripcion}' WHERE idrol = '{$idrol}'";
        if ($base->Iniciar()) {
            if ($base->Ejecutar($sql)) {
                $resp = true;
            } else {
                $this->setMensaje($base->getError());
            }
        } else {
            $this->setMensaje($base->getError());
        }
        return $resp;
    }

    //ELIMINAR
    public function eliminar()
    {
        $base = new BaseDatos();
        $rta = false;
        $consulta = "DELETE FROM rol WHERE idrol = " . $this->getidrol();
        if ($base->Iniciar()) {
            if ($base->Ejecutar($consulta)) {
                $rta = true;
            } else {
                $this->setMensaje($base->getError());
            }
        } else {
            $this->setMensaje($base->getError());
        }
        return $rta;
    }

    
}