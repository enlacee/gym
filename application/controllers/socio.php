<?php

class Socio extends MY_Controller {

    public function __construct()
    {
        parent::__construct();
        //$this->accessAcl();
        
        $this->load->model('Socio_model');
    }    
    
    public function index()
    {
        $data['token'] = $this->auth->token();
        $this->load->view('index/index', $data);        
        
    }
    
    public function listGrid()
    {   
        //------
        $page = $this->input->get('page');
      	$limit = $this->input->get('rows'); //MY_ControllerAdmin::LIMIT;
        $sidx = $this->input->get('sidx');
        $sord = $this->input->get('sord');
        $dataGrid = array();
        $responce = new stdClass();
        if (isset($_GET['searchField']) && ($_GET['searchString'] != null)) {
            $operadores["eq"] = "=";
            $operadores["ne"] = "<>";
            $operadores["lt"] = "<";
            $operadores["le"] = "<=";
            $operadores["gt"] = ">";
            $operadores["ge"] = ">=";
            $operadores["cn"] = "LIKE";
            if ($_GET['searchOper'] == "cn") {
                $dataGrid['string'] = $_GET['searchField'] . " " . $operadores[$_GET['searchOper']] . " '%" . $_GET['searchString'] . "%' ";
            } else {
                $dataGrid['string'] = $_GET['searchField'] . " " . $operadores[$_GET['searchOper']] . "'" . $_GET['searchString'] . "'";
            }                
        }      
        
        $count = $this->Socio_model->jqListSociosSuscritos(1, $dataGrid, TRUE);
        if ($count > 0) {
            $total_pages = ceil($count/$limit);
        } else {
           $total_pages = 1; 
        }
        if ($page > $total_pages) { $page = $total_pages; }// $page = 0
        if ($page < 1) { $page = 1; }
        
        $start = $limit * $page - $limit;
        
        $dataGrid['oderby'] = array('sidx' => $sidx, 'sord' => $sord);
        $dataGrid['limit'] = $limit;
        $dataGrid['start'] = $start;       
        $result = $this->Socio_model->jqListSociosSuscritos(1, $dataGrid);
        
        $responce->page = $page;
        $responce->total = $total_pages;
        $responce->records = $count;
        $i = 0;
        while (list($clave, $row) = each($result)) {
            $responce->rows[$i]['id'] = $row['id'];
            $responce->rows[$i]['cell'] = array(
                $row['id'],
                $row['first_name'],
                $row['last_name'],
                $row['sexo'],
                $row['celular'],
                $row['email'],
                $row['direccion'],
                $row['observacion']);
            $i++;        
        }
        
        $this->output->set_content_type('application/json');
        $this->output->set_output(json_encode($responce));          
        
        
        
        
        
        /*
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
        $this->output->set_output(json_encode($array));*/      
    }
    
    public function add()
    {
        if ($this->input->post()) {
            //if ($this->input->post('token') == $this->session->userdata('token')) { }
            // session
            $usuario = $this->session->userdata('user');
            
            $dataSocio['id_usuario'] = $usuario['id'];
            $dataSocio['first_name'] = $this->input->post('addSocio_first_name');
            $dataSocio['last_name'] = $this->input->post('addSocio_last_name');
            $dataSocio['sexo'] = $this->input->post('addSocio_sexo');
            $dataSocio['email'] = $this->input->post('addSocio_email');
            $dataSocio['celular'] = $this->input->post('addSocio_celular');
            $dataSocio['direccion'] = $this->input->post('addSocio_direccion');
            $dataSocio['observacion'] = $this->input->post('addSocio_observacion');
            $dataSocio['created_at'] = date("Y-m-d h:i:s");            
            $dataSocio['additional']['empresa_id'] = $usuario['empresa_id'];
            
                    
            $this->load->model('Socio_model');
            $this->Socio_model->add($dataSocio);
            $this->cleanCache();
            echo 1;
            //$this->output->set_content_type('application/json');
            //$this->output->set_output(json_encode($arrayJson));            
        }         
    }
    
}
