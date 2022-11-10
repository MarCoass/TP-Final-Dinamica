<?php
include_once '../Modelo/Conector/BaseDatos.php';
class Producto
{
    private $idproducto;
    private $pronombre;
    private $prodetalle;
    private $procantstock;
    private $mensaje;

    public function __construct()
    {
        $this->idproducto = "";
        $this->pronombre = "";
        $this->prodetalle = "";
        $this->procantstock = "";
    }

    public function cargar($idproducto, $pronombre, $prodetalle, $procantstock)
    {
        $this->setIdproducto($idproducto);
        $this->setPronombre($pronombre);
        $this->setProdetalle($prodetalle);
        $this->setProcantstock($procantstock);
    }

    //Metodos de acceso
    
    public function getIdproducto(){
        return $this->idproducto;
    }

    public function setIdproducto($idproducto){
        $this->idproducto = $idproducto;
    }

    public function getPronombre(){
        return $this->pronombre;
    }

    public function setPronombre($pronombre){
        $this->pronombre = $pronombre;
    }

    public function getProdetalle(){
        return $this->prodetalle;
    }

    public function setProdetalle($prodetalle){
        $this->prodetalle = $prodetalle;
    }

    public function getProcantstock()
    {
        return $this->procantstock;
    }

    public function setProcantstock($procantstock)
    {
        $this->procantstock = $procantstock;
    }

    public function getMensaje(){
        return $this->mensaje;
    }

    public function setMensaje($mensaje){
        $this->mensaje = $mensaje;
    }

    public function __toString()
    {
        return "idproducto: " . $this->getIdproducto() .
            "\npronombre: " . $this->getPronombre() .
            "\nprodetalle: " . $this->getProdetalle() .
            "\nprocantstock: " . $this->getProcantstock() ;
    }

    //Funciones BD

    //BUSCAR
    public function buscar($idproducto)
    {
        $base = new BaseDatos();
        $resp = false;
        $sql = "SELECT * FROM producto WHERE idproducto = '" . $idproducto . "'";
        if ($base->Iniciar()) {
            if ($base->Ejecutar($sql)) {
                if ($row2 = $base->Registro()) {
                    $this->setIdproducto($row2['idproducto']);
                    $this->setPronombre($row2['pronombre']);
                    $this->setProdetalle($row2['prodetalle']);
                    $this->setProcantstock($row2['procantstock']);
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
                    $objproducto = new producto();
                    $objproducto->buscar($row2['idproducto']);
                    $array[] = $objproducto;
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
        $idproducto = $this->getIdproducto();
        $pronombre = $this->getPronombre();
        $prodetalle = $this->getProdetalle();
        $procantstock = $this->getProcantstock();
        //Creo la consulta 
        $sql = "INSERT INTO producto (idproducto, pronombre, prodetalle, procantstock) VALUES ('{$idproducto}', '{$pronombre}', '{$prodetalle}', '{$procantstock}')";
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
        $idproducto = $this->getIdproducto();
        $pronombre = $this->getPronombre();
        $prodetalle = $this->getProdetalle();
        $procantstock = $this->getProcantstock();
        $sql = "UPDATE producto SET pronombre = '{$pronombre}', prodetalle = '{$prodetalle}' , procantstock = '{$procantstock}' WHERE idproducto = '{$idproducto}'";
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
        $consulta = "DELETE FROM producto WHERE idproducto = " . $this->getIdproducto();
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
