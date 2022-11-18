<?php
include_once '../Modelo/Conector/BaseDatos.php';
class UsuarioRol
{
    private $idusuariorol;
    private $idusuario;
    private $idrol;
    private $mensaje;

    public function __construct()
    {
        $this->idusuariorol = "";
        $this->idusuario = "";
        $this->idrol = "";
        $this->mensaje = "";
    }

    public function cargar($idusuariorol, $idusuario, $idrol)
    {
        $this->setIdusuariorol($idusuariorol);
        $this->setIdusuario($idusuario);
        $this->setidrol($idrol);
    }

    //Metodos de acceso
    public function getIdrol()
    {
        return $this->idrol;
    }

    public function setidrol($idrol)
    {
        $this->idrol = $idrol;
    }

    public function getIdusuario()
    {
        return $this->idusuario;
    }

    public function setIdusuario($idusuario)
    {
        $this->idusuario = $idusuario;
    }

    public function getIdusuariorol()
    {
        return $this->idusuariorol;
    }

    public function setIdusuariorol($idusuariorol)
    {
        $this->idusuariorol = $idusuariorol;
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
        return "idusuariorol: " . $this->getIdusuariorol() .
            "\nidusuario: " . $this->getIdusuario() .
            "\nidrol: " . $this->getIdrol() ;
    }

    //Funciones BD

    //BUSCAR
    public function buscar($idusuariorol)
    {
        $base = new BaseDatos();
        $resp = false;
        $sql = "SELECT * FROM usuarioRol WHERE idusuariorol = '" . $idusuariorol . "'";
        if ($base->Iniciar()) {
            if ($base->Ejecutar($sql)) {
                if ($row2 = $base->Registro()) {
                    $this->setIdusuariorol($row2['idusuariorol']);

                    //Creo un objeto para buscar al id y setear el objeto
                    $usuario = new Usuario();
                    $usuario->buscar($row2['idusuario']);
                    $this->setIdusuario($usuario);

                    //Creo un objeto para buscar al id y setear el objeto
                    $rol = new Rol();
                    $rol->buscar($row2['idrol']);
                    $this->setidrol($rol);
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
        $sql =  "select * from usuarioRol";
        if ($condicion != '') {
            $sql = $sql . ' where ' . $condicion;
        }
        if ($base->Iniciar()) {
            if ($base->Ejecutar($sql)) {
                $array = array();
                while ($row2 = $base->Registro()) {
                    $objusuarioRol = new usuarioRol();
                    $objusuarioRol->buscar($row2['idusuariorol']);
                    $array[] = $objusuarioRol;
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
        $idusuariorol = $this->getIdusuariorol();
        $idusuario = $this->getIdusuario();
        $idrol = $this->getIdrol();
        //Creo la consulta 
        $sql = "INSERT INTO usuarioRol ( idusuario, idrol) VALUES ('{$idusuario}', '{$idrol}')";
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
        $idusuariorol = $this->getIdusuariorol();
        $idusuario = $this->getIdusuario();
        $idrol = $this->getIdrol();
        $sql = "UPDATE usuarioRol SET idusuario = '{$idusuario}', idrol = '{$idrol}' WHERE idusuariorol = '{$idusuariorol}'";
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
        $consulta = "DELETE FROM usuarioRol WHERE idusuariorol = " . $this->getIdusuariorol();
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
