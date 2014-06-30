<?php

class Empresa_producto_model extends CI_Model {

    protected $_name = 'ac_empresa_productos';

    public function __construct() {
        parent::__construct();
    }

    /**
     * Register data for Empresa (periodos del gym)
     * @param $data
     * @return bool
     */
    public function addByArray($data)
    {  
        $this->db->insert_batch($this->_name, $data);
        if ($this->db->affected_rows() > 0 ) {
            return TRUE;
        }        
    }

    /**
     * Select all period for id company ('products')
     * @param $id
     * @return mixed
     */
    public function selectByEmpresa($id)
    {
        $keyCache = __CLASS__ .'_'. __FUNCTION__ .'_'. $id;
        if (($rs = $this->cache->file->get($keyCache)) == false) {
            $sqlString = "$this->_name.id, ".
                "$this->_name.nombre, ".
                "$this->_name.id_categoria, ".
                "$this->_name.id_periodo, ".
                "$this->_name.precio, ".
                "ac_periodos.nro_dia";

            $this->db->select($sqlString)->from($this->_name);
            $this->db->join("ac_periodos", "$this->_name.id_periodo = ac_periodos.id");
            $this->db->where("$this->_name.id_empresa", $id);
            $query = $this->db->get();
            $rs = $query->result_array();
            $this->cache->file->save($keyCache, $rs);
        }
        return $rs;
    }

}
