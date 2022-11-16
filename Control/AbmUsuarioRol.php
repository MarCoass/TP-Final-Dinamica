<?php
class AbmRol
{
    //Espera como parametro un arreglo asociativo donde las claves coinciden con los uspasss de las variables instancias del objeto


    /**
     * Espera como parametro un arreglo asociativo donde las claves coinciden con los uspasss de las variables instancias del objeto
     * @param array $param
     * @return rol
     */
    private function cargarObjeto($param)
    {
        $obj = null;
        if (
            array_key_exists('idrol', $param)
            and array_key_exists('roldescripcion', $param)
        ) {
            $obj = new Rol();
            $obj->setear($param['idrol'], $param['roldescripcion']);
        }
        return $obj;
    }


    /**
     * Espera como parametro un arreglo asociativo donde las claves coinciden con los uspasss de las variables instancias del objeto que son claves
     * @param array $param
     * @return rol
     */
    private function cargarObjetoConClave($param)
    {
        $obj = null;
        if (isset($param['idrol'])) {
            $obj = new Rol();
            $obj->setear($param['idrol'], "", ""); //???---------------------------2 o 3?
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
        if (isset($param['idrol']))
            $resp = true;
        return $resp;
    }


    /**
     * ALTA
     * @param array $param
     */
    public function alta($param)
    {
        $resp = false;
        $buscar2 = array();
        $buscar2['idrol'] = $param['idrol'];
        $encuentraPer = $this->buscar($buscar2);

        if ($encuentraPer == null) {
            $elObjtrol = $this->cargarObjeto($param);
            if ($elObjtrol != null and $elObjtrol->insertar()) {
                $resp = true;
            }
        }
        return $resp;
    }


    /**
     * BAJA
     * @param array $param
     * @return boolean
     */
    public function baja($param)
    {
        $resp = false;
        if ($this->seteadosCamposClaves($param)) {
            $elObjtrol = $this->cargarObjetoConClave($param);
            if ($elObjtrol != null and $elObjtrol->eliminar()) {
                $resp = true;
            }
        }
        return $resp;
    }


    /**
     * MODIFICACION
     * @param array $param
     * @return boolean
     */
    public function modificacion($param)
    {
        $resp = false;
        if ($this->seteadosCamposClaves($param)) {
            $buscar2 = array();
            $buscar2['idrol'] = $param['idrol'];
            $larol = $this->buscar($buscar2);
            if ($larol != null) {
                $larol[0]->setroldescripcion($param['roldescripcion']);

                if ($larol[0] != null and $larol[0]->modificar()) {
                    $resp = true;
                }
            }
        }
        return $resp;
    }


    /**
     * BUSCAR
     * @param array $param
     * @return array
     */
    public function buscar($param)
    {
        $where = " true ";
        if ($param <> NULL) {
            if (isset($param['idrol']))
                $where .= " and idrol =" . $param['idrol'];
            if (isset($param['roldescripcion']))
                $where .= " and roldescripcion ='" . $param['roldescripcion'] . "'";
        }
        $arreglo = Rol::listar($where);
        return $arreglo;
    }
}
