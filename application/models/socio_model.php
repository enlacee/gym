<?php

class Socio_model  extends CI_Model {
    
    protected $_name = 'ac_socios';
    
    public function __construct() {
        parent::__construct();
    }    

    public function add($data)
    {   
        $idSocio = FALSE;
        if (is_array($data) && count($data) > 0) {
            //inicio
            $this->db->trans_begin();
            try {
                // 01 insert socio                
                $socioSuscrito = $data['additional'];                
                unset($data['additional']);
                $this->db->insert($this->_name, $data);
                $idSocio = $this->db->insert_id();

                // 02 inset socio suscrito
                if (isset($socioSuscrito) && isset($socioSuscrito['empresa_id']) ) {
                    $data2['id_socio'] = $idSocio;
                    $data2['id_empresa'] = $socioSuscrito['empresa_id'];
                    $data2['observacion'] = $socioSuscrito['observacion'];                    
                    $this->db->insert('ac_socios_suscriptores', $data2);
                }           
                $this->db->trans_commit();

            } catch (Exception $exc) {
                insert_log($exc->getTraceAsString());
                $this->db->trans_rollback();
            }            
            //fin
        }
        
        return $idSocio;
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
    
    /**
     * List of socios by IDUSUARIO
     * @param type $dataGrid
     * @param type $idUsuario
     * @param type $num_rows
     */
    public function jqListSociosSuscritos($idUsuario, $dataGrid, $num_rows = FALSE)
    {
        $rs = false;
        //$this->db->where("$this->_name.id_usuario", $idUsuario);
        
        if(is_string($dataGrid) && !empty($dataGrid)) {
            //$this->db->where('1=1'); 
            $this->db->where($dataGrid);            
        } elseif (is_array($dataGrid)) {
            
            if (isset($dataGrid['string']) && !empty($dataGrid)) {
               $this->db->where($dataGrid['string']);
               
            } else {                
                if (isset($dataGrid['oderby'])) {
                    $sidx = $dataGrid['oderby']['sidx'];
                    $sord = $dataGrid['oderby']['sord'];                
                    $this->db->order_by($sidx, $sord); 
                }            
                if (isset($dataGrid['limit'])) {
                    if (!empty($dataGrid['limit']) && !empty($dataGrid['start'])) {
                        $this->db->limit($dataGrid['limit'], $dataGrid['start']);
                    }else {
                        $this->db->limit($dataGrid['limit']);
                    }
                }   
            }
        }
        
        $this->db->select("$this->_name.*, ac_socios_suscriptores.id_empresa_producto, ac_socios_suscriptores.observacion");
        $this->db->from($this->_name);
        $this->db->join("ac_socios_suscriptores", "$this->_name.id = ac_socios_suscriptores.id_socio");
        $this->db->where('ac_socios_suscriptores.baja', 0);
        $query = $this->db->get();

        if ($num_rows === true) {
            //$rs = $query->num_fields();
            $rs = $query->num_rows();
        } else {
            $rs = $query->result_array();
        }
        
        return $rs;        
        
    }
    
}
