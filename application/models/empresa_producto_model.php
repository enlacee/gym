<?php

class Empresa_producto_model extends CI_Model {

    protected $_name = 'ac_empresa_productos';

    public function __construct() {
        parent::__construct();
    }
    
    
    public function addByArray($data)
    {  
        $this->db->insert_batch($this->_name, $data);
        if ($this->db->affected_rows() > 0 ) {
            return TRUE;
        }        
    }

}
