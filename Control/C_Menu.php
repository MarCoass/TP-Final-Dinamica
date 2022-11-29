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
                $where .= " and idmenu ='" . $param['idmenu'] . "'";
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

    
    function habilitar($param)
    {
        $resp = false;
        $arrayObjMenues = $this->buscar($param);
        $objMenu = $arrayObjMenues[0];
        $objMenu->setMeDeshabilitado('NULL');
        if ($objMenu != null and $objMenu->modificar()) {
            $resp = true;
        }
        return $resp;
    }


     //Cambiar roles
    public function modificarRoles($param){
        $resp = false;
        //busco el menu con el id que recibe la funcion
        $objMenuRol = new C_MenuRol();
        //busco los roles el menu
        $rolesMenu = $objMenuRol->buscar(['idmenu'=>$param['idmenu']]);
        //roles recibidos por parametro
        $rolesNuevos = $param['rol'];

        //agrega roles, parece funcionar
        foreach($rolesNuevos as $rolAgregar){
            if($objMenuRol->buscar(['idmenu'=>$param['idmenu'], 'idrol'=>$rolAgregar]) == null){
                $idMenu = $param['idmenu'];
                $menuRol = new MenuRol();
                $menuRol->cargar(NULL, $idMenu, $rolAgregar);
                $menuRol->insertar(); 
            }
        }

        //elimina roles, no funciona
        foreach($rolesMenu as $rolEliminar){
            if(!in_array($rolEliminar->getIdrol()->getIdrol(),$rolesNuevos)){
                $idMenu = $param['idmenu'];
                $rolEliminar->eliminar(); 
            }
        }
        return $resp;
    }


    
}
