<?php

class Index extends MY_Controller {
    
    public function __construct()
    {
        parent::__construct();
    }
    
    private function accesoUsuario()
    {   //var_dump($this->auth);
        if ($this->userSession) {
            $usuario = $this->session->userdata('user'); //var_dump($usuario);Exit;
            if ($usuario['activo'] == '1') {
                redirect('/dashboard');
            } else { // necsita pagar membresia.
                $this->userSession = false;
                $this->session->sess_destroy();
                redirect('/index/usuarioInactivo'); 
            }
        }
    }    
    
    /**
     * home principal login
     */
    public function index()
    {
        $this->accesoUsuario();
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
                    $data = array (
                       'user' => $dataUsuario,
                    );
                    // para enviar mensaje de respuesta xq no se concreto.
                    $this->guardarSession($data);
                    redirect('/dashboard');                    
                } else {
                  $this->session->set_flashdata('flashMessage', 'Datos no son correctos, Intente nuevamente.');  
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
            $flag = true;
        }        
        return $flag;
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
    public function usuarioInactivo()
    {
        $this->load->view('index/usuario-inactivo');
    }
}