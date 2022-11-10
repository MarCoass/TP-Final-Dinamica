<?php
include_once '../Modelo/Conector/BaseDatos.php';
class Compra
{
    private $idcompra;
    private $cofecha;
    private $idusuario;
    private $mensaje;

    public function __construct()
    {
        $this->idcompra = "";
        $this->cofecha = "";
        $this->idusuario = "";
        $this->mensaje = "";
    }

    public function cargar($idcompra, $cofecha, $idusuario)
    {
        $this->setIdcompra($idcompra);
        $this->setCofecha($cofecha);
        $this->setIdusuario($idusuario);
    }

    //Metodos de acceso
    
    public function getIdcompra(){
        return $this->idcompra;
    }

    public function setIdcompra($idcompra){
        $this->idcompra = $idcompra;
    }

    public function getCofecha(){
        return $this->cofecha;
    }

    public function setCofecha($cofecha){
        $this->cofecha = $cofecha;
    }

    public function getIdusuario(){
        return $this->idusuario;
    }

    public function setIdusuario($idusuario){
        $this->idusuario = $idusuario;
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
        return "idcompra: " . $this->getidcompra() .
            "\ncofecha: " . $this->getCofecha() .
            "\nidusuario: " . $this->getIdusuario() ;
    }

    //Funciones BD

    //BUSCAR
    public function buscar($idcompra)
    {
        $base = new BaseDatos();
        $resp = false;
        $sql = "SELECT * FROM compra WHERE idcompra = '" . $idcompra . "'";
        if ($base->Iniciar()) {
            if ($base->Ejecutar($sql)) {
                if ($row2 = $base->Registro()) {
                    $this->setIdcompra($row2['idcompra']);
                    $this->setCofecha($row2['cofecha']);

                    //Creo un objeto para buscar al id y setear el objeto
                    $usuario = new Usuario();
                    $usuario->buscar($row2['idusuario']);
                    $this->setIdusuario($usuario);
                    
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
        $sql =  "select * from compra";
        if ($condicion != '') {
            $sql = $sql . ' where ' . $condicion;
        }
        if ($base->Iniciar()) {
            if ($base->Ejecutar($sql)) {
                $array = array();
                while ($row2 = $base->Registro()) {
                    $objcompra = new compra();
                    $objcompra->buscar($row2['idcompra']);
                    $array[] = $objcompra;
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
        $idcompra = $this->getidcompra();
        $cofecha = $this->getCofecha();
        $idusuario = $this->getIdusuario();
        //Creo la consulta 
        $sql = "INSERT INTO compra (idcompra, cofecha, idusuario) VALUES ('{$idcompra}', '{$cofecha}', '{$idusuario}')";
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
        $idcompra = $this->getidcompra();
        $cofecha = $this->getCofecha();
        $idusuario = $this->getIdusuario();
        $sql = "UPDATE compra SET cofecha = '{$cofecha}', idusuario = '{$idusuario}' WHERE idcompra = '{$idcompra}'";
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
        $consulta = "DELETE FROM compra WHERE idcompra = " . $this->getidcompra();
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
