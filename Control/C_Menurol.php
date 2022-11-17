<?php
include_once '../Modelo/Menurol.php';
include_once '../Modelo/Menu.php';

class C_Menurol
{

    /**
     * Espera como parametro un arreglo asociativo donde las claves coinciden con los nombres de las variables instancias del objeto
     * @param array $param
     * @return Menurol
     */
    private function cargarObjeto($param)
    {
        $obj = null;
        if (array_key_exists('idmenurol', $param)) {

            $obj = new Menurol();
            $obj->cargar(
                $param['idmenurol'],
                $param['idmenu'],
                $param['idrol']
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
        if (isset($param['idmenurol'])) {
            $obj = new Menurol();
            $obj->cargar($param['idmenurol'], null, null);
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
        if (isset($param['idmenurol']))
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
        $param['idmenurol'] = null;
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
    public function modificacion($param){
        $resp = false;
        if ($this->seteadosCamposClaves($param)){
            $obj= $this->cargarObjeto($param);
            if($obj!=null && $obj->modificar()){
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
    public function buscar($param){
        $where = " true "; 
        if ($param<>NULL){
            $where .= '';
            if  (isset($param['idmenurol']))
                $where.=" and idmenurol ='".$param['idmenurol']."'"; 
            if  (isset($param['idmenu']))
                    $where.=" and idmenu ='".$param['idmenu']."'";
            if  (isset($param['idrol']))
                    $where.=" and idrol ='".$param['idrol']."'";
        }
        $obj = new Menurol();
        $arreglo =  $obj->listar($where);  
        
        return $arreglo;
    }

    //FUNCIONES QUE PODRIAN FUNCIONAR O NO

    /**
     * Recibe por parametro un array de id roles que corresponden a la sesion activa.
     */
    public function menuesByIdRol($idRoles){
        $arrayDeMenuRol = []; // Array de todos los obj MenuRol con $idRol igual a los que hay en $idRoles
        foreach($idRoles as $idRol){
            $param = ['idrol' => $idRol]; //Armo el parametro de busqueda, en este caso por idrol
            $arrayDeMenuRol[] = $this->buscar($param); 
            //agrego lo que devuelva la busqueda, si es solo un menu se agregara solo un objMenuRol y si son
            //varios se agregara un array de objMenuRol
        }

        $menuRoles = []; //Array donde se guardaran solo objMenuRol, no arrays
        foreach($arrayDeMenuRol as $elemento){
            if(is_array($elemento)){
                //Si elemento es un array, recorre sus posiciones y las va agregando al array
                foreach($elemento as $posicion){
                    $menuRoles[] = $posicion;
                }
            } else {
                //Si no es array, simplemente lo agrega.
                $menuRoles[] = $elemento;
            }
        }

        //Esta parte puede hacerse a la vez que la anterior CREO
        $arrayDeMenues = [];
        foreach($menuRoles as $menuRol){//Por cada objMenuRol almacena el objeto Menu
            
            $arrayDeMenues[] = $menuRol->getIdmenu();
        }
        return $arrayDeMenues;
    }

    
}