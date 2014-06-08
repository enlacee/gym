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
        $array[] = array('id' => 1, 'name' => 'pepe reina', 'otro'=> '15');
        $array[] = array('id' => 2, 'name' => 'maria lopez', 'otro'=> '25');
        $array[] = array('id' => 3, 'name' => 'martin borge', 'otro'=> '22');
        $array[] = array('id' => 4, 'name' => 'juan reniro', 'otro'=> '11');
        
        $array[] = array('id' => 5, 'name' => 'maribel rojas', 'otro'=> '15');
        $array[] = array('id' => 6, 'name' => 'stefany maride', 'otro'=> '25');
        $array[] = array('id' => 7, 'name' => 'robert linio', 'otro'=> '22');
        $array[] = array('id' => 8, 'name' => 'ricardo games', 'otro'=> '11');        
        
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
