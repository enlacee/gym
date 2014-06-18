<?php

class Empresa_model extends CI_Model {

    protected $_name = 'ac_empresas';
    
    const INSTALACION_TRUE = 1;
    const INSTALACION_FALSE = 0;

    public function __construct() {
        parent::__construct();
    }
    
    public function update(array $data = array())
    {   
        $id = 'id';
        if (count($data) > 0 && isset($data[$id])) {
            $this->db->where('id', $data[$id]);
            unset($data[$id]);
            $this->db->update($this->_name ,$data);
        }        
    }    
    

}
