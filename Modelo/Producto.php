<?php
include_once '../Modelo/Conector/BaseDatos.php';
class Producto
{
    private $idproducto;
    private $pronombre;
    private $prodetalle;
    private $proprecio;
    private $procantstock;
    private $protipo;
    private $proimagen;
    private $mensaje;

    public function __construct()
    {
        $this->idproducto = "";
        $this->pronombre = "";
        $this->prodetalle = "";
        $this->proprecio = " ";
        $this->procantstock = "";
        $this->protipo = " ";
        $this->proimagen = " ";
    }

    public function cargar($idproducto, $pronombre, $prodetalle, $proprecio, $procantstock, $protipo, $proimagen)
    {
        $this->setIdproducto($idproducto);
        $this->setPronombre($pronombre);
        $this->setProdetalle($prodetalle);
        $this->setProprecio($proprecio);
        $this->setProcantstock($procantstock);
        $this->setProtipo($protipo);
        $this->setProimagen($proimagen);
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

    public function getProprecio()
    {
        return $this->proprecio;
    }

    public function setProprecio($proprecio)
    {
        $this->proprecio = $proprecio;
    }

    public function getProcantstock()
    {
        return $this->procantstock;
    }

    public function setProcantstock($procantstock)
    {
        $this->procantstock = $procantstock;
    }

    public function getProtipo()
    {
        return $this->protipo;
    }

    public function setProtipo($protipo)
    {
        $this->protipo = $protipo;
    }

    public function getProimagen()
    {
        return $this->proimagen;
    }

    public function setProimagen($proimagen)
    {
        $this->proimagen = $proimagen;
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
            "\nproprecio: ". $this->getProprecio().
            "\nprocantstock: " . $this->getProcantstock().
            "\nprotipo: ". $this->getProtipo().
            "\nproimagen: ". $this->getProimagen() ;
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
                    $this->setProprecio($row2['proprecio']);
                    $this->setProcantstock($row2['procantstock']);
                    $this->setProtipo($row2['protipo']);
                    $this->setProimagen($row2['proimagen']);
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
        $sql =  "select * from producto";
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
        $proprecio = $this->getProprecio();
        $procantstock = $this->getProcantstock();
        $protipo = $this->getProtipo();
        $proimagen = $this->getProimagen();
        //Creo la consulta 
        $sql = "INSERT INTO producto (idproducto, pronombre, prodetalle, proprecio, procantstock, protipo, proimagen) VALUES ('{$idproducto}', '{$pronombre}', '{$prodetalle}', '{$proprecio}', '{$procantstock}', '{$protipo}', '{$proimagen}')";
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
        $proprecio = $this->getProprecio();
        $procantstock = $this->getProcantstock();
        $protipo = $this->getProtipo();
        $proimagen = $this->getProimagen();
        $sql = "UPDATE producto SET pronombre = '{$pronombre}', prodetalle = '{$prodetalle}', proprecio = '{$proprecio}' , procantstock = '{$procantstock}', protipo = '{$protipo}', proimagen = '{$proimagen}' WHERE idproducto = '{$idproducto}'";
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

    public function validar_cantidad_stock($id_producto,$cantidad){
        $base = new BaseDatos();
        $rta = false;
        $consulta = "SELECT * FROM `producto` WHERE (`procantstock` >= ".$cantidad." OR `procantstock` <= ".$cantidad.") AND `idproducto` = ".$id_producto;
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
