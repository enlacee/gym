<?php

class Socio_model  extends CI_Model {
    
    protected $_name = 'ac_socios';
    
    public function __construct() {
        parent::__construct();
    }    
    
    /**
     * 
     * @param Array $data
     * @return Boolean 
     */
    public function add($data)
    {
        if (is_array($data) && count($data) > 0) {
            $this->db->insert($this->_name, $data);
        }        
    }
    
    /**
     * Delete
     * @param Integer $id
     * @return boolean
     */
    public function del($id)
    {
        if (!empty($id)) {
            $this->db->where('id', $id);          
            $this->db->delete($this->_name);
            return true;
        }
    }
    
    /**
     * Update
     * @param Integer $id
     * @param Array $data
     * @return boolean
     */
    public function update($id, $data = array())
    {
        if (!empty($id)) {
            $this->db->where('id', $id);
            if(is_array($data) && count($data) > 0 ) {
                $dataUpdate = $data; //array('nombre' => $this->input->post('nombre'));
                $this->db->update($this->_name, $dataUpdate);
                return true;
            }            
        }
    }     
    
}
