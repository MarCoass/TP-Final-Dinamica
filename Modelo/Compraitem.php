<?php
include_once '../Modelo/Conector/BaseDatos.php';
class Compraitem
{
    private $idcompraitem;
    private $idproducto;
    private $idcompra;
    private $cicantidad;
    private $mensaje;

    public function __construct()
    {
        $this->idcompraitem = "";
        $this->idproducto = "";
        $this->idcompra = "";
        $this->cicantidad = "";
    }

    public function cargar($idcompraitem, $idproducto, $idcompra, $cicantidad)
    {
        $this->setIdcompraitem($idcompraitem);
        $this->setIdproducto($idproducto);
        $this->setIdcompra($idcompra);
        $this->setCicantidad($cicantidad);
    }

    //Metodos de acceso
    
    public function getIdcompraitem(){
        return $this->idcompraitem;
    }

    public function setIdcompraitem($idcompraitem){
        $this->idcompraitem = $idcompraitem;
    }

    public function getIdproducto(){
        return $this->idproducto;
    }

    public function setIdproducto($idproducto){
        $this->idproducto = $idproducto;
    }

    public function getIdcompra(){
        return $this->idcompra;
    }

    public function setIdcompra($idcompra){
        $this->idcompra = $idcompra;
    }

    public function getCicantidad()
    {
        return $this->cicantidad;
    }

    public function setCicantidad($cicantidad)
    {
        $this->cicantidad = $cicantidad;
    }

    public function getMensaje(){
        return $this->mensaje;
    }

    public function setMensaje($mensaje){
        $this->mensaje = $mensaje;
    }

    public function __toString()
    {
        return "idcompraitem: " . $this->getIdcompraitem() .
            "\nidproducto: " . $this->getIdproducto() .
            "\nidcompra: " . $this->getIdcompra() .
            "\ncicantidad: " . $this->getCicantidad() ;
    }

    //Funciones BD

    //BUSCAR
    public function buscar($idcompraitem)
    {
        $base = new BaseDatos();
        $resp = false;
        $sql = "SELECT * FROM compraitem WHERE idcompraitem = '" . $idcompraitem . "'";
        if ($base->Iniciar()) {
            if ($base->Ejecutar($sql)) {
                if ($row2 = $base->Registro()) {
                    $this->setIdcompraitem($row2['idcompraitem']);

                    //Creo un objeto para buscar al id y setear el objeto
                    $producto = new Producto();
                    $producto->buscar($row2['idproducto']);
                    $this->setIdproducto($producto);

                    $this->setIdcompra($row2['idcompra']);
                    //Creo un objeto para buscar al id y setear el objeto
                    $compra = new Compra();
                    $compra->buscar($row2['idcompra']);
                    $this->setIdcompra($compra);

                    $this->setCicantidad($row2['cicantidad']);
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
                    $objcompraitem = new Compraitem();
                    $objcompraitem->buscar($row2['idcompraitem']);
                    $array[] = $objcompraitem;
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
        $idcompraitem = $this->getIdcompraitem();
        $idproducto = $this->getIdproducto();
        $idcompra = $this->getIdcompra();
        $cicantidad = $this->getCicantidad();
        //Creo la consulta 
        $sql = "INSERT INTO compraitem (idcompraitem, idproducto, idcompra, cicantidad) VALUES ('{$idcompraitem}', '{$idproducto}', '{$idcompra}', '{$cicantidad}')";
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
        $idcompraitem = $this->getIdcompraitem();
        $idproducto = $this->getIdproducto();
        $idcompra = $this->getIdcompra();
        $cicantidad = $this->getCicantidad();
        $sql = "UPDATE compraitem SET idproducto = '{$idproducto}', idcompra = '{$idcompra}' , cicantidad = '{$cicantidad}' WHERE idcompraitem = '{$idcompraitem}'";
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
        $consulta = "DELETE FROM compraitem WHERE idcompraitem = " . $this->getIdcompraitem();
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
