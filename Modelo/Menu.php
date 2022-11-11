<?php
include_once '../Modelo/conector/BaseDatos.php';
class Menu
{
    private $idmenu;
    private $menombre;
    private $medescripcion;
    private $idpadre; 
    private $medeshabilitado;
    private $script;
    private $mensaje;

    public function __construct()
    {
        $this->idmenu = "";
        $this->menombre = "";
        $this->medescripcion = "";
        $this->idpadre = '';
        $this->medeshabilitado = "";
        $this->script = "";
    }

    public function cargar($idmenu, $menombre, $medescripcion, $idpadre, $medeshabilitado, $script)
    {
        $this->setIdmenu($idmenu);
        $this->setMenombre($menombre);
        $this->setMedescripcion($medescripcion);
        $this->setIdpadre($idpadre);
        $this->setMedeshabilitado($medeshabilitado);
        $this->setScript($script);
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

    public function getScript(){
        return $this->script;
    }

    public function setScript($script){
        $this->script = $script;
    }

    public function getMensaje(){
        return $this->mensaje;
    }

    public function setMensaje($mensaje){
        $this->mensaje = $mensaje;
    }

    public function __toString()
    {
        return "idmenu: " . $this->getIdmenu() .
            "\nmenombre: " . $this->getMenombre() .
            "\nmedescripcion: " . $this->getMedescripcion() .
            "\npadre: " . $this->getIdpadre() . 
            "\nscriot: " . $this->getScript();
    }

    //Funciones BD

    //BUSCAR
    public function buscar($idmenu)
    {
        $base = new BaseDatos();
        $resp = false;
        $sql = "SELECT * FROM menu WHERE idmenu = '" . $idmenu . "'";
        if ($base->Iniciar()) {
            if ($base->Ejecutar($sql)) {
                if ($row2 = $base->Registro()) {
                    $this->setIdmenu($row2['idmenu']);
                    $this->setMenombre($row2['menombre']);
                    $this->setMedescripcion($row2['medescripcion']);
                    $this->setIdpadre($row2['idpadre']);
                    $this->setMedeshabilitado($row2['medeshabilitado']);
                    $this->setScript($row2['script']);
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
        $sql =  "select * from menu";
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
        $idmenu = $this->getIdmenu();
        $menombre = $this->getMenombre();
        $medescripcion = $this->getMedescripcion();
        $idpadre = $this->getIdpadre();
        $medeshabilitado = $this->getMedeshabilitado();
        $script = $this->getScript();


        //Creo la consulta 
        $sql = "INSERT INTO menu (idmenu, menombre, medescripcion, idpadre, medeshabilitado, script) VALUES ('{$idmenu}', '{$menombre}', '{$medescripcion}', '{$idpadre}', '{$medeshabilitado}', '{$script}')";
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
        $idmenu = $this->getIdmenu();
        $menombre = $this->getMenombre();
        $medescripcion = $this->getMedescripcion();
        $idpadre = $this->getIdpadre();
        $medeshabilitado = $this->getMedeshabilitado();
        $script = $this->getScript();

        $sql = "UPDATE menu SET menombre = '{$menombre}', medescripcion = '{$medescripcion}', idpadre = '{$idpadre}', medeshabilitado = '{$medeshabilitado}', script = '{$script}' WHERE idmenu = '{$idmenu}'";
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
        $consulta = "DELETE FROM menu WHERE idmenu = " . $this->getIdmenu();
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