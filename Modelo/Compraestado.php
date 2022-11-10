<?php
include_once '../Modelo/conector/BaseDatos.php';
class Compraestado
{
    private $idcompraestado;
    private $idcompra;
    private $idcompraestadotipo;
    private $cefechaini; 
    private $cefechafin;
    private $mensaje;

    public function __construct()
    {
        $this->idcompraestado = "";
        $this->idcompra = "";
        $this->idcompraestadotipo = "";
        $this->cefechaini = '';
        $this->cefechafin = "";
    }

    public function cargar($idcompraestado, $idcompra, $idcompraestadotipo, $cefechaini, $cefechafin)
    {
        $this->setIdcompraestado($idcompraestado);
        $this->setIdcompra($idcompra);
        $this->setIdcompraestadotipo($idcompraestadotipo);
        $this->setCefechaini($cefechaini);
        $this->setCefechafin($cefechafin);
    }

    public function getidcompraestado(){
        return $this->idcompraestado;
    }

    public function setIdcompraestado($idcompraestado){
        $this->idcompraestado = $idcompraestado;
    }

    public function getidcompra(){
        return $this->idcompra;
    }

    public function setIdcompra($idcompra){
        $this->idcompra = $idcompra;
    }

    public function getidcompraestadotipo(){
        return $this->idcompraestadotipo;
    }

    public function setIdcompraestadotipo($idcompraestadotipo){
        $this->idcompraestadotipo = $idcompraestadotipo;
    }

    public function getcefechaini(){
        return $this->cefechaini;
    }

    public function setCefechaini($cefechaini){
        $this->cefechaini = $cefechaini;
    }

    public function getcefechafin(){
        return $this->cefechafin;
    }

    public function setCefechafin($cefechafin){
        $this->cefechafin = $cefechafin;
    }

    public function getMensaje(){
        return $this->mensaje;
    }

    public function setMensaje($mensaje){
        $this->mensaje = $mensaje;
    }

    public function __toString()
    {
        return "idcompraestado: " . $this->getidcompraestado() .
            "\nidcompra: " . $this->getidcompra() .
            "\nidcompraestadotipo: " . $this->getidcompraestadotipo() .
            "\nDueño: " . $this->getcefechaini();
    }

    //Funciones BD

    //BUSCAR
    public function buscar($idcompraestado)
    {
        $base = new BaseDatos();
        $resp = false;
        $sql = "SELECT * FROM Compraestado WHERE idcompraestado = '" . $idcompraestado . "'";
        if ($base->Iniciar()) {
            if ($base->Ejecutar($sql)) {
                if ($row2 = $base->Registro()) {
                    $this->setIdcompraestado($row2['idcompraestado']);

                    //Creo un objeto para buscar al id y setear el objeto
                    $compra = new Compra();
                    $compra->buscar($row2['idcompra']);
                    $this->setIdcompra($compra);

                    $this->setIdcompraestadotipo($row2['idcompraestadotipo']);
                    //Creo un objeto para buscar al id y setear el objeto
                    $compraestadotipo = new Compraestadotipo();
                    $compraestadotipo->buscar($row2['idcompraestadotipo']);
                    $this->setIdcompraestadotipo($compraestadotipo);

                    $this->setCefechaini($row2['cefechaini']);
                    $this->setCefechafin($row2['cefechafin']);
                    $resp = true;
                }
            } else {
                $this->setCefechafin($base->getError());
            }
        } else {
            $this->setCefechafin($base->getError());
        }
        return $resp;
    }

    //LISTAR
    public function listar($condicion = '')
    {
        $array = null;
        $base = new BaseDatos();
        $sql =  "select * from Compraestado";
        if ($condicion != '') {
            $sql = $sql . ' where ' . $condicion;
        }
        if ($base->Iniciar()) {
            if ($base->Ejecutar($sql)) {
                $array = array();
                while ($row2 = $base->Registro()) {
                    $objCompraestado = new Compraestado();
                    $objCompraestado->buscar($row2['idcompraestado']);
                    $array[] = $objCompraestado;
                }
            } else {
                $this->setCefechafin($base->getError());
            }
        } else {
            $this->setCefechafin($base->getError());
        }

        return $array;
    }

    //INSERTAR
    public function insertar()
    {
        $base = new BaseDatos();
        $resp = false;
        //Asigno los datos a variables
        $idcompraestado = $this->getidcompraestado();
        $idcompra = $this->getidcompra();
        $idcompraestadotipo = $this->getidcompraestadotipo();
        $cefechaini = $this->getcefechaini();
        $cefechafin = $this->getcefechafin();


        //Creo la consulta 
        $sql = "INSERT INTO Compraestado (idcompraestado, idcompra, idcompraestadotipo, cefechaini, cefechafin) VALUES ('{$idcompraestado}', '{$idcompra}', '{$idcompraestadotipo}', '{$cefechaini}', '{$cefechafin}')";
        if ($base->Iniciar()) {
            if ($base->Ejecutar($sql)) {
                $resp = true;
            } else {
                $this->setCefechafin($base->getError());
            }
        } else {
            $this->setCefechafin($base->getError());
        }
        return $resp;
    }

    //MODIFICAR
    public function modificar()
    {
        $base = new BaseDatos();
        $resp = false;
        $idcompraestado = $this->getidcompraestado();
        $idcompra = $this->getidcompra();
        $idcompraestadotipo = $this->getidcompraestadotipo();
        $cefechaini = $this->getcefechaini();
        $cefechafin = $this->getcefechafin();

        $sql = "UPDATE Compraestado SET idcompra = '{$idcompra}', idcompraestadotipo = '{$idcompraestadotipo}', cefechaini = '{$cefechaini}', cefechafin = '{$cefechafin}' WHERE idcompraestado = '{$idcompraestado}'";
        if ($base->Iniciar()) {
            if ($base->Ejecutar($sql)) {
                $resp = true;
            } else {
                $this->setCefechafin($base->getError());
            }
        } else {
            $this->setCefechafin($base->getError());
        }
        return $resp;
    }

    //ELIMINAR
    public function eliminar()
    {
        $base = new BaseDatos();
        $rta = false;
        $consulta = "DELETE FROM Compraestado WHERE idcompraestado = " . $this->getidcompraestado();
        if ($base->Iniciar()) {
            if ($base->Ejecutar($consulta)) {
                $rta = true;
            } else {
                $this->setCefechafin($base->getError());
            }
        } else {
            $this->setCefechafin($base->getError());
        }
        return $rta;
    }

    
}