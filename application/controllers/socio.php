<?php

class Socio extends MY_Controller {

    public function __construct()
    {
        parent::__construct();
    }    
    
    public function index()
    {
        $data['token'] = $this->auth->token();
        $this->load->view('index/index', $data);        
        
    }
    
    public function listGrid()
    {
        $array[] = array(
            'id' => 1,
            'first_name' => 'pepe reina',
            'last_name' => 'rosario',
            'sexo' => '1',
            'email'=>'correo@mail.com',
            'celular' => '995845745');
        $array[] = array('id' => 2, 'first_name' => 'maria lopez', 'last_name' => 'lopez', 'sexo' => '1', 'email'=>'correo@mail.com');
        $array[] = array('id' => 3, 'first_name' => 'martin borge', 'last_name'=> 'ruiz', 'sexo' => '2', 'email'=>'correo@mail.com');
        $array[] = array('id' => 4, 'first_name' => 'juan reniro', 'last_name' => 'lirio', 'sexo' => '1', 'email'=>'correo@mail.com');
        
        $array[] = array('id' => 5, 'first_name' => 'maribel rojas', 'last_name' => 'gimenez', 'sexo' => '1');
        $array[] = array('id' => 6, 'first_name' => 'stefany maride', 'last_name' => 'garza', 'sexo' => '1');
        $array[] = array('id' => 7, 'first_name' => 'robert linio', 'last_name' => 'roblez', 'sexo' => '1');
        $array[] = array('id' => 8, 'first_name' => 'ricardo games', 'last_name' => 'castillo', 'sexo' => '1');        
        
        $this->output->set_content_type('application/json');
        $this->output->set_output(json_encode($array));      
    }
    
    public function add()
    {
        if ($this->input->post()) {
            //if ($this->input->post('token') == $this->session->userdata('token')) { }            
            
            // session
            $usuario = $this->session->all_userdata();
            //$usuario = $this->session->_userdata('user'); 

            // get data con model pero validar ACL
            
            echo "<pre>";            
            print_r($usuario);
            
            /*
            $imgTmp = (isset($dataSession['img_tmp']) && is_array($dataSession['img_tmp'])) ? $dataSession['img_tmp'] : '';
            if (!empty($imgTmp)) {                                
                $targetFile = $this->load->get_var('latestNewsPath') . $imgTmp['name'];
                if (!copy($imgTmp['path'], $targetFile)) { log_message("error", "failed to copy"); }
                $dataPost['url_image'] = $imgTmp['name'];
                $this->session->set_userdata('post',''); // LIMPIAR IMAGEN
            }
            
            

            $dataPost ['title'] = $this->input->post('nombre');
            $dataPost ['content'] = $this->input->post('editor');
            $dataPost ['status'] = Post_model::STATUS_TRUE;
            $dataPost ['post_type'] = Post_model::TIPO_POST;            
            $dataPost ['created_at'] = date('Y-m-d H:i:s');
            $this->Post_model->add($dataPost);            
            $this->cleanCache();
            $this->session->set_flashdata('flashMessage', "Added  correctly Last News.");
            redirect('admin_post/post');*/
        }         
    }
    
}
