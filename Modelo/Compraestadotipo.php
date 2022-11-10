<?php
include_once '../Modelo/Conector/BaseDatos.php';
class Compraestadotipo
{
    private $idcompraestadotipo;
    private $cetdescripcion;
    private $cetdetalle;
    private $mensaje;

    public function __construct()
    {
        $this->idcompraestadotipo = "";
        $this->cetdescripcion = "";
        $this->cetdetalle = "";
        $this->mensaje = "";
    }

    public function cargar($idcompraestadotipo, $cetdescripcion, $cetdetalle)
    {
        $this->setIdcompraestadotipo($idcompraestadotipo);
        $this->setCetdescripcion($cetdescripcion);
        $this->setCetdetalle($cetdetalle);
    }

    //Metodos de acceso
    
    public function getIdcompraestadotipo(){
        return $this->idcompraestadotipo;
    }

    public function setIdcompraestadotipo($idcompraestadotipo){
        $this->idcompraestadotipo = $idcompraestadotipo;
    }

    public function getCetdescripcion(){
        return $this->cetdescripcion;
    }

    public function setCetdescripcion($cetdescripcion){
        $this->cetdescripcion = $cetdescripcion;
    }

    public function getCetdetalle(){
        return $this->cetdetalle;
    }

    public function setCetdetalle($cetdetalle){
        $this->cetdetalle = $cetdetalle;
    }

    public function getMensaje()
    {
        return $this->mensaje;
    }

    public function setMensaje($mensaje)
    {
        $this->mensaje = $mensaje;
    }

    public function __toString()
    {
        return "idcompraestadotipo: " . $this->getIdcompraestadotipo() .
            "\ncetdescripcion: " . $this->getCetdescripcion() .
            "\ncetdetalle: " . $this->getCetdetalle() ;
    }

    //Funciones BD

    //BUSCAR
    public function buscar($idcompraestadotipo)
    {
        $base = new BaseDatos();
        $resp = false;
        $sql = "SELECT * FROM Compraestadotipo WHERE idcompraestadotipo = '" . $idcompraestadotipo . "'";
        if ($base->Iniciar()) {
            if ($base->Ejecutar($sql)) {
                if ($row2 = $base->Registro()) {
                    $this->setIdcompraestadotipo($row2['idcompraestadotipo']);
                    $this->setCetdescripcion($row2['cetdescripcion']);
                    $this->setCetdetalle($row2['cetdetalle']);
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
        $sql =  "select * from Compraestadotipo";
        if ($condicion != '') {
            $sql = $sql . ' where ' . $condicion;
        }
        if ($base->Iniciar()) {
            if ($base->Ejecutar($sql)) {
                $array = array();
                while ($row2 = $base->Registro()) {
                    $objCompraestadotipo = new Compraestadotipo();
                    $objCompraestadotipo->buscar($row2['idcompraestadotipo']);
                    $array[] = $objCompraestadotipo;
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
        $idcompraestadotipo = $this->getIdcompraestadotipo();
        $cetdescripcion = $this->getCetdescripcion();
        $cetdetalle = $this->getCetdetalle();
        //Creo la consulta 
        $sql = "INSERT INTO Compraestadotipo (idcompraestadotipo, cetdescripcion, cetdetalle) VALUES ('{$idcompraestadotipo}', '{$cetdescripcion}', '{$cetdetalle}')";
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
        $idcompraestadotipo = $this->getIdcompraestadotipo();
        $cetdescripcion = $this->getCetdescripcion();
        $cetdetalle = $this->getCetdetalle();
        $sql = "UPDATE Compraestadotipo SET cetdescripcion = '{$cetdescripcion}', cetdetalle = '{$cetdetalle}' WHERE idcompraestadotipo = '{$idcompraestadotipo}'";
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
        $consulta = "DELETE FROM Compraestadotipo WHERE idcompraestadotipo = " . $this->getIdcompraestadotipo();
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
