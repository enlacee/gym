<?php

class Index extends MY_Controller {
    
    public function __construct()
    {
        parent::__construct();        
    }
    
    private function accesoUsuario()
    {
        $usuario = $this->getUserSession();
        if ($usuario['status'] == '1') {
            //redirect('/dashboard');
        } else { // necsita pagar membresia.            
            $this->session->sess_destroy();
            redirect('/index/usuarioInstatus'); 
        }
    } 
    
    /**
     * home principal login
     */
    public function index()
    {
        //$this->accesoUsuario();
        $data['token'] = $this->auth->token();
        $this->load->view('index/index', $data);
    }
    
    /**
     * init session with validations CSRF
     */
    public function login()
    {
        $this->load->model('Usuario_model');
        if ($this->input->post()) {
            if ($this->input->post('token') == $this->session->userdata('token')) {
                $dataUsuario = $this->Usuario_model->login($this->input->post('email'), $this->input->post('password'));
                
                if (is_array($dataUsuario) && count($dataUsuario) > 0) {
                    //$dataObjetivo = $this->Objetivo_model->getObjetivos();
                    if($dataUsuario['status'] == 0) {
                        redirect('index/usuarioInstatus');
                    }                    
                    $data = array (
                       'user' => $dataUsuario,
                    );
                    // para enviar mensaje de respuesta xq no se concreto.
                    $this->guardarSession($data);
                    redirect('/dashboard');                    
                } else {
                  $this->session->set_flashdata('flashMessage', 'Datos ingresados no son correctos.');  
                }
            } else {                
                redirect('/index'); //echo "token incorrecto";  
            }          
        }
        redirect('/index');
    }
    
    /**
     * Guardar la session
     */
    private function guardarSession($data) 
    {   
        $flag = false;
        if (count($data) > 0) {             
            $this->session->set_userdata($data);
            $this->vincularEmpresa();
            //
            $this->instalacionEmpresa();
            $flag = true;
        }        
        return $flag;
    }

    /**
     * JOIN usuario with empresa,
     * for save data in session and re-use
     */
    private function vincularEmpresa()
    {
        $this->load->model('Usuario_model');
        $usuario = $this->getUserSession();        
        $idUsuario = $usuario['id'];        

        //var_dump(get_class_methods($this->Usuario_model->getEmpresa($idUsuario)));Exit;
        $data = $this->Usuario_model->getEmpresa($idUsuario);
        if ($data != FALSE && is_array($data) && count($data) == 1) {
            $array = array_merge($usuario, $data[0]);            
            $this->session->set_userdata(array('user' => $array));
            
        } else {
            $mLog = "usuario no tiene empresa vinculada"; insert_log($mLog); echo $mLog; exit;
        }
    }

    /**
     * Create config base for Company,
     * setting type of products.
     */
    private function instalacionEmpresa()
    {
        $this->load->model('Usuario_model');
        $this->load->model('Empresa_producto_model');
        $this->load->model('Empresa_model');
        $user = $this->getUserSession();
        
        if (isset($user['empresa_instalacion']) 
                && $user['empresa_instalacion'] == 0 )
        {
            $base_productos = $this->Usuario_model->getInstallBaseProductos();
            $array_productos = array();
            if (is_array($base_productos) && count($base_productos) > 0) {                
                foreach ($base_productos as $key => $value) {
                    $array_productos[$key]['id_empresa'] = $user['empresa_id'];
                    $array_productos[$key]['nombre'] = $base_productos[$key]['nombre'];
                    $array_productos[$key]['id_categoria'] = $base_productos[$key]['id_categoria'];
                    $array_productos[$key]['id_periodo'] = $base_productos[$key]['id_periodo'];
                    $array_productos[$key]['precio'] = $base_productos[$key]['precio'];
                }                
                //echo "<pre>";print_R($array_productos); exit;
                $this->Empresa_producto_model->addByArray($array_productos);
                
                $this->Empresa_model->update(array('id' => $user['empresa_id'], 'instalacion' => Empresa_model::INSTALACION_TRUE));
                
                insert_log("Empresa Instalado: ac_empresas [id_empresa] = " . $user['empresa_id']);
            } else {
                $mLog = "base_productos = NULL"; insert_log($mLog); echo $mLog; exit;
            }
            
        }
    }
    
    
    
    /**
     * Cerrar session y limpiar datos en cache.
     */
    public function logout()
    {   
        $this->load->driver('cache');    
        $this->session->sess_destroy();
        $this->cache->file->clean();
        redirect('/');
    }    

    
    /**
     * view for usuaruario inactive.
     */
    public function usuarioInstatus()
    {
        //$this->layout->view('index/usuario-instatus');
        $this->load->view('index/usuario-instatus');
    }
}
