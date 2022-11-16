<?php
include_once '../Modelo/Menu.php';

class C_Menu
{
    /**
     * Espera como parametro un arreglo asociativo donde las claves coinciden con los nombres de las variables instancias del objeto
     * @param array $param
     * @return Menu
     */
    private function cargarObjeto($param)
    {
        $obj = null;
        if (array_key_exists('idmenu', $param)) {

            if (isset($param['idpadre'])) {
                $padre = new Menu();
                $padre->buscar(['idmenu' => $param['idpadre']]);
            } else {
                $padre = null;
            }

            $obj = new Menu();
            $obj->cargar(
                $param['idMenu'],
                $param['menombre'],
                $param['medescripcion'],
                $padre,
                $param['medeshabilitado'],
                $param['script']
            );
        }
        return $obj;
    }

    /**
     * Espera como parametro un arreglo asociativo donde las claves coinciden con los nombres de 
     * las variables instancias del objeto que son claves
     * @param array $param
     * @return Producto
     */
    private function cargarObjetoConClave($param)
    {
        $obj = null;
        if (isset($param['idMenu'])) {
            $obj = new Menu();
            $obj->cargar($param['idMenu'], null, null, null, null, null);
        }
        return $obj;
    }

    /**
     * Corrobora que dentro del arreglo asociativo estan seteados los campos claves
     * @param array $param
     * @return boolean
     */

    private function seteadosCamposClaves($param)
    {
        $resp = false;
        if (isset($param['idmenu']))
            $resp = true;
        return $resp;
    }

    /**
     * Inserta un objeto
     * @param array $param
     */
    public function alta($param)
    {
        $resp = false;
        $param['idmenu'] = null;
        $obj = $this->cargarObjeto($param);
        if ($obj != null and $obj->insertar()) {
            $resp = true;
        }
        return $resp;
    }

    /**
     * permite eliminar un objeto 
     * @param array $param
     * @return boolean
     */
    public function baja($param)
    {
        $resp = false;
        if ($this->seteadosCamposClaves($param)) {
            $obj = $this->cargarObjetoConClave($param);
            if ($obj != null and $obj->eliminar()) {
                $resp = true;
            }
        }
        return $resp;
    }

    /**
     * permite modificar un objeto
     * @param array $param
     * @return boolean
     */
    public function modificacion($param)
    {
        $resp = false;
        if ($this->seteadosCamposClaves($param)) {
            $obj = $this->cargarObjeto($param);
            if ($obj != null && $obj->modificar()) {
                $resp = true;
            }
        }
        return $resp;
    }

    /**
     * permite buscar un objeto
     * @param array $param
     * @return array
     */
    public function buscar($param)
    {
        $where = " true ";
        if ($param <> NULL) {
            $where .= '';
            if (isset($param['idmenu']))
                $where .= " and idmenu ='" . $param['idMenu'] . "'";
            if (isset($param['menombre']))
                $where .= " and menombre ='" . $param['menombre'] . "'";
            if (isset($param['medescripcion']))
                $where .= " and medescripcion ='" . $param['medescripcion'] . "'";
            if (isset($param['idpadre']))
                $where .= " and idpadre ='" . $param['idpadre'] . "'";
            if (isset($param['medeshabilitado']))
                $where .= " and medeshabilitado ='" . $param['medeshabilitado'] . "'";
            if (isset($param['script']))
                $where .= " and script ='" . $param['script'] . "'";
        }
        $obj = new Menu();
        $arreglo =  $obj->listar($where);

        return $arreglo;
    }

    //AIUDA

    /**Funcion que arma la estructura de un menu (esto puede malir sal)
     * Recibe por parameto un array de menues (obtenidos con menuesByIdRol() de C_Menurol)
     * tiene foreachs anidados asi que debe ser la cosa menos eficiente jamas vista, pero solo me salio asi si es para un menu de hasta 2 niveles
     * **/
    public function armarMenu($menues)
    {
        $htmlCompleto = '';
        foreach ($menues as $itemMenu) {
            if ($itemMenu->getidPadre() == NULL) { // Si no tiene padre crea el li y revisa si tiene hijos
                $htmlItemMenu = "<li class='nav-item'><a class='nav-link' href='{$itemMenu->getScript()}'>'{$itemMenu->getMenombre()}'</a>";

                //Veo si tiene hijos, supongo que esto se puede modularizar
                foreach ($menues as $otroMenu) {

                    if ($otroMenu->getIdpadre() == $itemMenu->getIdmenu()) {
                        //Si los id coinciden, se agrega a un array
                        $hijosDeItemMenu[] = $otroMenu;
                    }
                }
                //Si el array no esta vacio
                if (count($hijosDeItemMenu) > 0) {
                    //Armo la estructura html de cada hijo adentro de un ul class dropdown
                    $ulDropdown = "<ul class='dropdown-menu'>";
                    foreach ($hijosDeItemMenu as $hijo) {
                        $ulDropdown = $ulDropdown . "<li><a class='dropdown-item' href='{$hijo->getScript()}'>'{$hijo->getMenombre()}'</a></li>";
                    }

                    $ulDropdown = $ulDropdown . "</ul>";
                }
                $htmlItemMenu = $htmlItemMenu . "</li>";
            } else {
                //NO HACE NADA, ENTONCES SI ES UN ITEM HIJO ES IGNORADO HASTA QUE ENCUENTRE A SU PADRE
            }
            $htmlCompleto = $htmlCompleto . $htmlItemMenu; //despues de cada iteracion agrega el html del item que se reviso a un html general
        }
        return $htmlCompleto;
    }
}
