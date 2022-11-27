<?php
include_once '../Modelo/Compra.php';

class C_Compra
{

    /**
     * Espera como parametro un arreglo asociativo donde las claves coinciden con los nombres de las variables instancias del objeto
     * @param array $param
     * @return Compra
     */
    private function cargarObjeto($param)
    {
        $obj = null;
        if (array_key_exists('idcompra', $param)) {

            $obj = new Compra();
            $obj->cargar(
                $param['idcompra'],
                $param['cofecha'],
                $param['idusuario']
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
        if (isset($param['idcompra'])) {
            $obj = new Compra();
            $obj->cargar($param['idcompra'], null, null);
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
        if (isset($param['idcompra']))
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
        $param['idcompra'] = null;
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
            if  (isset($param['idcompra']))
                $where.=" and idcompra ='".$param['idcompra']."'"; 
            if  (isset($param['cofecha']))
                    $where.=" and cofecha ='".$param['cofecha']."'";
            if  (isset($param['idusuario']))
                    $where.=" and idusuario ='".$param['idusuario']."'";
        }
        $obj = new Compra();
        $arreglo =  $obj->listar($where);  
        
        return $arreglo;
    }

    public function obtener_compra_borrador_de_usuario($id_usuario){
        $obj_compra = new C_Compra();
        $compra_borrador = null;
        $compras_usuario = $obj_compra->buscar(array('idusuario' =>$id_usuario));

		if(is_array($compras_usuario) && $compras_usuario != null){
			foreach($compras_usuario as $compra){
				$estado = new C_Compraestado();
				$estado_borrador = $estado->buscar(array('idcompra' => $compra->getIdcompra(), 'idcompraestadotipo' => 0,'cefechafin' => NULL ));
	
				if($estado_borrador != null){
					$compra_borrador = $obj_compra->buscar(array('idcompra' =>$compra->getIdcompra(),'idusuario' =>$id_usuario));
				}
			}
		}

        return $compra_borrador;
    }

    public function contarCarrito($id_usuario)
    {
        $totalcantidad = 0;
        $compra_borrador = $this->obtener_compra_borrador_de_usuario($id_usuario);
        $obj_compra_item = new C_Compraitem();
        $productos = $obj_compra_item->buscar(array('idcompra' => $compra_borrador[0]->getIdcompra()));

        foreach($productos as $prd){
            $totalcantidad += $prd->getCicantidad();
        }
        return $totalcantidad;
    }
}