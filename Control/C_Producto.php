<?php
include_once '../Modelo/Producto.php';

class C_Producto
{

    /**
     * Espera como parametro un arreglo asociativo donde las claves coinciden con los nombres de las variables instancias del objeto
     * @param array $param
     * @return Producto
     */
    private function cargarObjeto($param)
    {
        $obj = null;
        if (array_key_exists('idproducto', $param)) {

            $obj = new Producto();
            $obj->cargar(
                $param['idproducto'],
                $param['pronombre'],
                $param['prodetalle'],
                $param['proprecio'],
                $param['procantstock'],
                $param['protipo'],
                $param['proimagen']
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
        if (isset($param['idproducto'])) {
            $obj = new Producto();
            $obj->cargar($param['idproducto'], null, null, null,null,null,null);
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
        if (isset($param['idproducto']))
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
        $param['idproducto'] = null;
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
            if  (isset($param['idproducto']))
                $where.=" and idproducto ='".$param['idproducto']."'"; 
            if  (isset($param['pronombre']))
                    $where.=" and pronombre ='".$param['pronombre']."'";
            if  (isset($param['prodetalle']))
                    $where.=" and prodetalle ='".$param['prodetalle']."'";
            if  (isset($param['proprecio']))
                    $where.=" and proprecio ='".$param['proprecio']."'";
            if  (isset($param['procantstock']))
                    $where.=" and procantstock ='".$param['procantstock']."'";
            if  (isset($param['protipo']))
                    $where.=" and protipo ='".$param['protipo']."'";    
            if  (isset($param['proimagen']))
                    $where.=" and proimagen ='".$param['primagen']."'";
        }
        $obj = new Producto();
        $arreglo =  $obj->listar($where);  
        
        return $arreglo;
    }

    public function validar_stock_producto_por_cantidad($id_producto,$cantidad){

        if($id_producto == null || $id_producto == '' ){
            return false;
        }

        $obj = new Producto();
        //return un booleano
        return $obj->validar_cantidad_stock($id_producto,$cantidad);


    }

}