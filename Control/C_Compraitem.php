<?php
include_once '../Modelo/Compraitem.php';

class C_Compraitem
{

    /**
     * Espera como parametro un arreglo asociativo donde las claves coinciden con los nombres de las variables instancias del objeto
     * @param array $param
     * @return Compraitem
     */
    private function cargarObjeto($param)
    {
        $obj = null;
        if (array_key_exists('idcompraitem', $param)) {

            $obj = new Compraitem();
            $obj->cargar(
                $param['idcompraitem'],
                $param['idproducto'],
                $param['idcompra'],
                $param['cicantidad']
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
        if (isset($param['idcompraitem'])) {
            $obj = new Compraitem();
            $obj->cargar($param['idcompraitem'], null, null, null);
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
        if (isset($param['idcompraitem']))
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
        $param['idcompraitem'] = null;
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
            if  (isset($param['idcompraitem']))
                $where.=" and idcompraitem ='".$param['idcompraitem']."'"; 
            if  (isset($param['idproducto']))
                    $where.=" and idproducto ='".$param['idproducto']."'";
            if  (isset($param['idcompra']))
                    $where.=" and idcompra ='".$param['idcompra']."'";
            if  (isset($param['cicantidad']))
                    $where.=" and cicantidad ='".$param['cicantidad']."'";
        }
        $obj = new Compraitem();
        $arreglo =  $obj->listar($where);  
        
        return $arreglo;
    }

    public function traerProductos($idCompra){
        $arrayCompraItem = $this->buscar(['idcompra' => $idCompra]);
        $arrayProductos = [];
        foreach($arrayCompraItem as $compraItem){
            $arrayProductos[] = $compraItem->getIdproducto();
        }
        return $arrayProductos;
    }
}