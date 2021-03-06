<?php
/**
 * Class Socio_model
 */
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
     * @param Array $data
     * @return boolean
     */
    public function update($data = array())
    {
        $rs = FALSE;
        $id = !empty($data['id']) ? $data['id'] : FALSE;
        unset($data['id']);

        $arrayWhere = array('id' => $id);
        if(is_array($data) && count($data) > 0 ) {
            $this->db->where($arrayWhere);
            $this->db->update($this->_name, $data);
            $rs = TRUE;
        }

        return $rs;
    }
    
    /**
     * List of socios by IDUSUARIO
     * @param array $dataGrid data for query
     * @param int $idUsuario type user in session
     * @param boolean $num_rows value for return count or data
     */
    public function jqListSociosSuscritos($idUsuario, $dataGrid, $num_rows = FALSE)
    {
        $rs = false;
        //$this->db->where("$this->_name.id_usuario", $idUsuario);
        
        if (!empty($dataGrid) && is_string($dataGrid)) {
            $this->db->where($dataGrid); //$this->db->where('1=1');
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

        $tb1 = 'ac_socios_suscriptores';
        $stringSql = "$this->_name.id AS id_socio, "
            . "$this->_name.first_name, $this->_name.last_name, $this->_name.sexo, $this->_name.celular, "
            . "$this->_name.email, $this->_name.direccion, $tb1.observacion, $tb1.fecha_registro, "
            . "$tb1.id_empresa_producto, $tb1.id AS id_socio_suscriptor, "
            . "$tb1.fecha_inicio, $tb1.fecha_fin ";

        $this->db->select($stringSql);
        $this->db->from($this->_name);
        $this->db->join("ac_socios_suscriptores", "$this->_name.id = ac_socios_suscriptores.id_socio");
        $this->db->where('ac_socios_suscriptores.baja', 0);
        $query = $this->db->get();

        if ($num_rows === true) {
            $rs = $query->num_rows(); //$rs = $query->num_fields();
        } else {
            $rs = $query->result_array();
        }
        
        return $rs;
    }
    
}
