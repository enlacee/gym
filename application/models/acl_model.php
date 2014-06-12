<?php

class ACL_model  extends CI_Model {
    
    protected $tb_roles = 'acl_roles'; // roles [admin,usuario,otros]
    protected $tb_resources = 'acl_resources'; // recursos []
    protected $tb_privileges = 'acl_privileges'; // privilegio (cada rol tiene recursos = privilegios)
    
    public function __construct() {
        parent::__construct();
    }    

    /**
     * List of socios by IDUSUARIO
     * @param type $dataGrid
     * @param type $idUsuario
     * @param type $numRows
     */
    public function getResources($idRol)
    {   
        $keyCache = __CLASS__ .'_'. __FUNCTION__ .'_'. $idRol;
        
        if (($rs = $this->cache->file->get($keyCache)) == false) {
            $this->db->select("$this->tb_privileges.*, $this->tb_resources.name");
            $this->db->from($this->tb_privileges);
            $this->db->join("$this->tb_roles", "$this->tb_privileges.role_id = $this->tb_roles.id", 'left');
            $this->db->join("$this->tb_resources", "$this->tb_privileges.resource_id = $this->tb_resources.id");
            $this->db->where("$this->tb_privileges.role_id", $idRol);
            $query = $this->db->get();
            $rs = $query->result_array();            
            $this->cache->file->save($keyCache, $rs);
        }
        return $rs;        
    }
    
}
