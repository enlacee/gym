<?php

class Usuario_model  extends CI_Model {
    
    protected $_name = 'ac_usuarios';
    const ESTADO_ACTIVO = 1;
    const ESTADO_INACTIVO = 0;
    
    public $id;
    public $nombre_completo;
    public $email;
    public $password;
    public $salt;
    public $fecha_registro;
    public $activo;    
    
    /**
     * Modelo del usuario
     * @param type $id
     * @return \Usuario_model|boolean
     */
    public function __construct($id = null)
    {
        parent::__construct();        
        if (isset($id) && !empty($id)) {
            $this->db->select()->from($this->_name)->where('id', $id);         
            $query = $this->db->get();
            $rs = $query->row_array();
            return $this->_setData($rs);          
        }
    }
    
    /**
     * Load data
     * @param Array $rs
     * @return \Usuario_model|boolean
     */
    private function _setData($rs)
    {
        if ($rs != false) {
            $this->id = $rs['id'];
            $this->nombre_completo = $rs['nombre_completo'];
            $this->email = $rs['email'];
            $this->password = $rs['password'];
            $this->salt = $rs['salt'];
            $this->activo = $rs['activo'];
            return $this;                
        } else {
            return false;
        }
    }    
    
    public function getId() {
        return $this->id;
    }

    public function getNombre_completo() {
        return $this->nombre_completo;
    }

    public function getEmail() {
        return $this->email;
    }

    public function getPassword() {
        return $this->password;
    }

    public function getSalt() {
        return $this->salt;
    }

    public function getFecha_registro() {
        return $this->fecha_registro;
    }

    public function getActivo() {
        return $this->activo;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setNombre_completo($nombre_completo) {
        $this->nombre_completo = $nombre_completo;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    public function setPassword($password) {
        $this->password = $password;
    }

    public function setSalt($salt) {
        $this->salt = $salt;
    }

    public function setFecha_registro($fecha_registro) {
        $this->fecha_registro = $fecha_registro;
    }

    public function setActivo($activo) {
        $this->activo = $activo;
    }

 // ::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
 // funciones adicionales   
    public function login($user, $password, $dataArray = true)
    {
        $this->db->select()->from($this->_name);
        $this->db->where('email', $user);
        $this->db->where('password', $password);
        $query = $this->db->get();
        $rs = $query->row_array();
        if ($dataArray) {
            return $rs;
        } else {
            return $this->_setData($rs);
        }
    }
    
    public function getByEmail($email)
    {
        $this->db->select()->from($this->_name)->where('email', $email);
        $query = $this->db->get();        
        $rs = $query->row_array();
        return $this->_setData($rs);        
    }
    
    public function getEmpresa($idUsuario)
    {
        $keyCache = __CLASS__ .'_'. __FUNCTION__ .'_'. $idUsuario;        
        if (($rs = $this->cache->file->get($keyCache)) == FALSE) {
            $stringSelect = "id AS empresa_id, "
                            . "nombre AS empresa_nombre, "
                            . "numDocumento AS empresa_numDocumento, "
                            . "tipo_documento AS empresa_tipo_documento, "
                            . "instalacion AS empresa_instalacion, "
                            . "status AS empresa_status, "
                            . "fecha_inicio_membresia AS empresa_fecha_inicio_membresia ";
            $this->db->select($stringSelect);
            $this->db->from('ac_empresas');
            $this->db->where('id_usuario', $idUsuario);
            $this->db->where('status', Usuario_model::ESTADO_ACTIVO);
            $query = $this->db->get();
            $rs = $query->result_array();            
            $this->cache->file->save($keyCache, $rs);
        }
        return $rs;
    }

    // install company
    /**
     * Select data by categoria GYM
     * @return type
     */
    public function getInstallBaseProductos()
    {
        $keyCache = __CLASS__ .'_'. __FUNCTION__;        
        if (($rs = $this->cache->file->get($keyCache)) == FALSE) {
            $this->db->select();
            $this->db->from('ac_base_productos');            
            $this->db->where('id_categoria', 1);
            $query = $this->db->get();
            $rs = $query->result_array();            
            $this->cache->file->save($keyCache, $rs);
        }
        return $rs;
    }

}
