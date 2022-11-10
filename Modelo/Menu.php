<?php
include_once '../Modelo/conector/BaseDatos.php';
class Menu
{
    private $idmenu;
    private $menombre;
    private $medescripcion;
    private $idpadre; 
    private $medeshabilitado;
    private $mensaje;

    public function __construct()
    {
        $this->idmenu = "";
        $this->menombre = "";
        $this->medescripcion = "";
        $this->idpadre = '';
        $this->medeshabilitado = "";
    }

    public function cargar($idmenu, $menombre, $medescripcion, $idpadre, $medeshabilitado)
    {
        $this->setIdmenu($idmenu);
        $this->setMenombre($menombre);
        $this->setMedescripcion($medescripcion);
        $this->setIdpadre($idpadre);
        $this->setMedeshabilitado($medeshabilitado);
    }

    public function getIdmenu(){
        return $this->idmenu;
    }

    public function setIdmenu($idmenu){
        $this->idmenu = $idmenu;
    }

    public function getMenombre(){
        return $this->menombre;
    }

    public function setMenombre($menombre){
        $this->menombre = $menombre;
    }

    public function getMedescripcion(){
        return $this->medescripcion;
    }

    public function setMedescripcion($medescripcion){
        $this->medescripcion = $medescripcion;
    }

    public function getIdpadre(){
        return $this->idpadre;
    }

    public function setIdpadre($idpadre){
        $this->idpadre = $idpadre;
    }

    public function getMedeshabilitado(){
        return $this->medeshabilitado;
    }

    public function setMedeshabilitado($medeshabilitado){
        $this->medeshabilitado = $medeshabilitado;
    }

    public function getMensaje(){
        return $this->mensaje;
    }

    public function setMensaje($mensaje){
        $this->mensaje = $mensaje;
    }

    public function __toString()
    {
        return "idmenu: " . $this->getidmenu() .
            "\nmenombre: " . $this->getmenombre() .
            "\nmedescripcion: " . $this->getMedescripcion() .
            "\nDueño: " . $this->getidpadre();
    }

    //Funciones BD

    //BUSCAR
    public function buscar($idmenu)
    {
        $base = new BaseDatos();
        $resp = false;
        $sql = "SELECT * FROM Menu WHERE idmenu = '" . $idmenu . "'";
        if ($base->Iniciar()) {
            if ($base->Ejecutar($sql)) {
                if ($row2 = $base->Registro()) {
                    $this->setidmenu($row2['idmenu']);
                    $this->setmenombre($row2['menombre']);
                    $this->setmedescripcion($row2['medescripcion']);
                    $this->setidpadre($row2['idpadre']);
                    $this->setMedeshabilitado($row2['medeshabilitado']);
                    $resp = true;
                }
            } else {
                $this->setmedeshabilitado($base->getError());
            }
        } else {
            $this->setmedeshabilitado($base->getError());
        }
        return $resp;
    }

    //LISTAR
    public function listar($condicion = '')
    {
        $array = null;
        $base = new BaseDatos();
        $sql =  "select * from Menu";
        if ($condicion != '') {
            $sql = $sql . ' where ' . $condicion;
        }
        if ($base->Iniciar()) {
            if ($base->Ejecutar($sql)) {
                $array = array();
                while ($row2 = $base->Registro()) {
                    $objMenu = new Menu();
                    $objMenu->buscar($row2['idmenu']);
                    $array[] = $objMenu;
                }
            } else {
                $this->setmedeshabilitado($base->getError());
            }
        } else {
            $this->setmedeshabilitado($base->getError());
        }

        return $array;
    }

    //INSERTAR
    public function insertar()
    {
        $base = new BaseDatos();
        $resp = false;
        //Asigno los datos a variables
        $idmenu = $this->getidmenu();
        $menombre = $this->getmenombre();
        $medescripcion = $this->getMedescripcion();
        $idpadre = $this->getidpadre();
        $medeshabilitado = $this->getMedeshabilitado();


        //Creo la consulta 
        $sql = "INSERT INTO Menu (idmenu, menombre, medescripcion, idpadre, medeshabilitado) VALUES ('{$idmenu}', '{$menombre}', '{$medescripcion}', '{$idpadre}', '{$medeshabilitado}')";
        if ($base->Iniciar()) {
            if ($base->Ejecutar($sql)) {
                $resp = true;
            } else {
                $this->setmedeshabilitado($base->getError());
            }
        } else {
            $this->setmedeshabilitado($base->getError());
        }
        return $resp;
    }

    //MODIFICAR
    public function modificar()
    {
        $base = new BaseDatos();
        $resp = false;
        $idmenu = $this->getidmenu();
        $menombre = $this->getmenombre();
        $medescripcion = $this->getMedescripcion();
        $idpadre = $this->getidpadre();
        $medeshabilitado = $this->getMedeshabilitado();

        $sql = "UPDATE Menu SET menombre = '{$menombre}', medescripcion = '{$medescripcion}', idpadre = '{$idpadre}', medeshabilitado = '{$medeshabilitado}' WHERE idmenu = '{$idmenu}'";
        if ($base->Iniciar()) {
            if ($base->Ejecutar($sql)) {
                $resp = true;
            } else {
                $this->setmedeshabilitado($base->getError());
            }
        } else {
            $this->setmedeshabilitado($base->getError());
        }
        return $resp;
    }

    //ELIMINAR
    public function eliminar()
    {
        $base = new BaseDatos();
        $rta = false;
        $consulta = "DELETE FROM Menu WHERE idmenu = " . $this->getidmenu();
        if ($base->Iniciar()) {
            if ($base->Ejecutar($consulta)) {
                $rta = true;
            } else {
                $this->setmedeshabilitado($base->getError());
            }
        } else {
            $this->setmedeshabilitado($base->getError());
        }
        return $rta;
    }

    
}