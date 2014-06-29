<?php

/**
 * Class Socio
 */
class socio extends my_controller {

    public function __construct()
    {
        parent::__construct();
        //$this->accessacl();

        $this->load->model('socio_model');
        $this->load->model('Socio_Suscriptor_model');
    }

    public function index()
    {
        $data['token'] = $this->auth->token();
        $this->load->view('index/index', $data);

    }

    public function listgrid()
    {
        //------
        $page = $this->input->get('page');
      	$limit = $this->input->get('rows'); //my_controlleradmin::limit;
        $sidx = $this->input->get('sidx');
        $sord = $this->input->get('sord');
        $datagrid = array();
        $responce = new stdclass();
        if (isset($_get['searchfield']) && ($_get['searchstring'] != null)) {
            $operadores["eq"] = "=";
            $operadores["ne"] = "<>";
            $operadores["lt"] = "<";
            $operadores["le"] = "<=";
            $operadores["gt"] = ">";
            $operadores["ge"] = ">=";
            $operadores["cn"] = "like";
            if ($_get['searchoper'] == "cn") {
                $datagrid['string'] = $_get['searchfield'] . " " . $operadores[$_get['searchoper']] . " '%" . $_get['searchstring'] . "%' ";
            } else {
                $datagrid['string'] = $_get['searchfield'] . " " . $operadores[$_get['searchoper']] . "'" . $_get['searchstring'] . "'";
            }
        }

        $count = $this->socio_model->jqlistsociossuscritos(1, $datagrid, true);
        if ($count > 0) {
            $total_pages = ceil($count/$limit);
        } else {
           $total_pages = 1;
        }
        if ($page > $total_pages) { $page = $total_pages; }// $page = 0
        if ($page < 1) { $page = 1; }

        $start = $limit * $page - $limit;

        $datagrid['oderby'] = array('sidx' => $sidx, 'sord' => $sord);
        $datagrid['limit'] = $limit;
        $datagrid['start'] = $start;
        $result = $this->socio_model->jqlistsociossuscritos(1, $datagrid);

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
                $row['observacion'],
                // socio suscrito
                $row['id_empresa_producto']);
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
        if (isAjax() == TRUE && $this->input->post()) {
            // session
            $usuario = $this->getUserSession();

            $datasocio['id_usuario'] = $usuario['id'];
            $datasocio['first_name'] = $this->input->post('addsocio_first_name');
            $datasocio['last_name'] = $this->input->post('addsocio_last_name');
            $datasocio['sexo'] = $this->input->post('addsocio_sexo');
            $datasocio['email'] = $this->input->post('addsocio_email');
            $datasocio['celular'] = $this->input->post('addsocio_celular');
            $datasocio['direccion'] = $this->input->post('addsocio_direccion');
            $datasocio['observacion'] = $this->input->post('addsocio_observacion');
            $datasocio['created_at'] = date("y-m-d h:i:s");
            $datasocio['additional']['empresa_id'] = $usuario['empresa_id'];


            $this->load->model('socio_model');
            $this->socio_model->add($datasocio);
            $this->cleancache();
            echo 1;
            //$this->output->set_content_type('application/json');
            //$this->output->set_output(json_encode($arrayjson));
        }
    }

    public function del()
    {
        $op = $this->input->post('oper');
        $id = (int) $this->input->post('id');
        if ($op == 'del' && $id > 0) {
                //$this->db->where('id', $id);
                //$this->db->delete('ac_socios_suscriptores', array('id' => $id), 1);
                $where = array('id' => $id);
                $this->db->update(
                    'ac_socios_suscriptores',
                    array('baja' => Socio_Suscriptor_model::BAJA_TRUE),
                    $where,
                    1);

        } else {
            echo "exit"; exit;
        }
    }
    
}
