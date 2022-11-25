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
            $htmlHijos = [];
            if ($itemMenu->getIdpadre() == NULL) { // Si no tiene padre crea el li y revisa si tiene hijos

                //Recorro los menus y busco los hijos de este menu
                foreach ($menues as $menu) {
                    //Si el menu tiene idpadre igual al id del menu actual, lo agrego a un array
                    if ($menu->getIdpadre() == $itemMenu->getIdmenu()) {
                        //$hijos[] = $itemMenu;
                        $htmlHijos[] = "<li><a class='dropdown-item text-light' href=".$menu->getScript().">{$menu->getMenombre()}</a></li>";
                        //echo "<li><a class='dropdown-item text-dark' href=".$menu->getScript().">{$menu->getMenombre()}</a></li>";
                    }
                }
                if (count($htmlHijos) > 0) {
                    
                    $htmlItemMenu = "<li class='nav-item dropdown'><a class= 'nav-link dropdown-toggle text-light' data-bs-toggle='dropdown' href='#' role='button' aria-expanded='false' id='dropdownMenu'>{$itemMenu->getMenombre()}</a>";
                    
                    $htmlDesplegable = "<ul class='dropdown-menu'id='dropdownMenu'> ";//aca va el id='dropdownMenu'
                    foreach ($htmlHijos as $item) {
                        $htmlDesplegable = $htmlDesplegable . $item;
                    }
                    $htmlDesplegable = $htmlDesplegable . "</ul>";
                    $htmlItemMenu = $htmlItemMenu . $htmlDesplegable . "</li>";
                } else {
                    $htmlItemMenu = "<li class='nav-item'><a class='nav-link text-light' href='#'>{$itemMenu->getMenombre()}</a></li>";
                }
                
                $arrayItemsMenu[] = $htmlItemMenu;
            } else {
                //NO HACE NADA, ENTONCES SI ES UN ITEM HIJO ES IGNORADO HASTA QUE ENCUENTRE A SU PADRE
            }
        }
        $htmlCompleto = "<ul class='nav nav-pills text-light' id='navbarHeader'>";
        foreach ($arrayItemsMenu as $item) {
            $htmlCompleto = $htmlCompleto . $item;
        }
        $htmlCompleto = $htmlCompleto ."</ul>";
        //echo $htmlCompleto;
        return $htmlCompleto;
    }
}
