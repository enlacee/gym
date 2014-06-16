<?php
/**
 * Control de los Bug into process.
 */
class Log_model  extends CI_Model {
    
    protected $_name = 'ac_logs';
    
    public function __construct() {
        parent::__construct();
    }    
    
    /**
     * Insert data log (Error in process or deployement app)
     * @param Array $data
     * @return Boolean || Integer 
     */
    public function add($data)
    {   $id = FALSE;
        if (is_array($data) && count($data) > 0) {
            $this->db->insert($this->_name, $data);
            $id = $this->db->insert_id();
        }
        return $id;
    }
    
}
