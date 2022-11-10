<?php
include_once '../Modelo/Conector/BaseDatos.php';
class menurol
{
    private $idmenurol;
    private $idmenu;
    private $idrol;
    private $mensaje;

    public function __construct()
    {
        $this->idmenurol = "";
        $this->idmenu = "";
        $this->idrol = "";
        $this->mensaje = "";
    }

    public function cargar($idmenurol, $idmenu, $idrol)
    {
        $this->setIdmenurol($idmenurol);
        $this->setIdmenu($idmenu);
        $this->setIdrol($idrol);
    }

    //Metodos de acceso
    public function getIdrol()
    {
        return $this->idrol;
    }

    public function setIdrol($idrol)
    {
        $this->idrol = $idrol;
    }

    public function getIdmenu()
    {
        return $this->idmenu;
    }

    public function setIdmenu($idmenu)
    {
        $this->idmenu = $idmenu;
    }

    public function getIdmenurol()
    {
        return $this->idmenurol;
    }

    public function setIdmenurol($idmenurol)
    {
        $this->idmenurol = $idmenurol;
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
        return "idmenurol: " . $this->getIdmenurol() .
            "\nidmenu: " . $this->getIdmenu() .
            "\nidrol: " . $this->getIdrol() ;
    }

    //Funciones BD

    //BUSCAR
    public function buscar($idmenurol)
    {
        $base = new BaseDatos();
        $resp = false;
        $sql = "SELECT * FROM menurol WHERE idmenurol = '" . $idmenurol . "'";
        if ($base->Iniciar()) {
            if ($base->Ejecutar($sql)) {
                if ($row2 = $base->Registro()) {
                    $this->setIdmenurol($row2['idmenurol']);
                    
                    //Creo un objeto para buscar al id y setear el objeto
                    $menu = new Menu();
                    $menu->buscar($row2['idmenu']);
                    $this->setIdmenu($menu);


                    //Creo un objeto para buscar al id y setear el objeto
                    $rol = new Rol();
                    $rol->buscar($row2['idrol']);
                    $this->setIdrol($rol);
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
        $sql =  "select * from menurol";
        if ($condicion != '') {
            $sql = $sql . ' where ' . $condicion;
        }
        if ($base->Iniciar()) {
            if ($base->Ejecutar($sql)) {
                $array = array();
                while ($row2 = $base->Registro()) {
                    $objmenurol = new menurol();
                    $objmenurol->buscar($row2['idmenurol']);
                    $array[] = $objmenurol;
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
        $idmenurol = $this->getIdmenurol();
        $idmenu = $this->getIdmenu();
        $idrol = $this->getIdrol();
        //Creo la consulta 
        $sql = "INSERT INTO menurol (idmenurol, idmenu, idrol) VALUES ('{$idmenurol}', '{$idmenu}', '{$idrol}')";
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
        $idmenurol = $this->getIdmenurol();
        $idmenu = $this->getIdmenu();
        $idrol = $this->getIdrol();
        $sql = "UPDATE menurol SET idmenu = '{$idmenu}', idrol = '{$idrol}' WHERE idmenurol = '{$idmenurol}'";
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
        $consulta = "DELETE FROM menurol WHERE idmenurol = " . $this->getIdmenurol();
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
