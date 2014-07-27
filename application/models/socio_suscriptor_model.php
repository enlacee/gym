<?php

class Socio_Suscriptor_model  extends CI_Model {
    
    protected $_name = 'ac_socios_suscriptores';
    const BAJA_TRUE = 1;
    const BAJA_FALSE = 0;

    public function __construct() {
        parent::__construct();
    }    
    
    public function jqListar($dataGrid, $num_rows = false)
    {   
        $rs = false;
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
                    if ($dataGrid['limit'] && $dataGrid['start']) {
                        $this->db->limit($dataGrid['limit'], $dataGrid['start']);
                    }else {
                        $this->db->limit($dataGrid['limit']);
                    }
                }   
            }
        }
        
        $this->db->select('id_variable, nombre, tipo_variable, patron_a_validar,fecha_registro');
        $query = $this->db->get($this->_name); 
        //log_message('error', print_r($this->db->last_query(),true));
        if ($num_rows === true) {
            //$rs = $query->num_fields();
            $rs = $query->num_rows();
        } else {
            $rs = $query->result_array();
        }
        
        return $rs;
    }

    /**
     * Solo necesita idSocioSuscriptor para actualizar (ac_socios_suscriptores.id)
     * @param array $data data of table with ID
     * @return boolean true or false if success
     */
    public function update($data)
    {
        $rs = FALSE;
        $id = $data['id'];
        $id_empresa = !empty($data['id_empresa']) ? $data['id_empresa'] : FALSE;
        unset($data['id']);
        unset($data['id_empresa']);
        if(!empty($id) && $id > 0) {
            $arrayWhere = array ('id' => $id, 'id_empresa' => $id_empresa);
            $dataUpdate = $data;
            $this->db->where($arrayWhere);
            $this->db->update( $this->_name, $dataUpdate);
            $rs = TRUE;
        }

        return $rs;
    }
}
