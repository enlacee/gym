<?php

/**
 * Class Socio
 */
class Socio extends my_controller {

    const ESTADO_ACTIVO = 1;
    const ESTADO_AL_COBRO = 2;
    const ESTADO_EN_MORA = 3;
    const ESTADO_INACTIVO = 0;

    public function __construct()
    {
        parent::__construct();
        //$this->accessacl();

        $this->load->model('socio_model');
        $this->load->model('Socio_Suscriptor_model');
        $this->load->model('Empresa_producto_model');
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

        $datagrid['oderby'] = array('sidx' => $sidx, 'sord' => $sord);
        $datagrid['limit'] = $limit;
        $count = $this->socio_model->jqlistsociossuscritos(1, $datagrid, true);

        if ($count > 0) {
            $total_pages = ceil($count/$limit);
        } else {
           $total_pages = 1;
        }
        if ($page > $total_pages) { $page = $total_pages; }// $page = 0
        if ($page < 1) { $page = 1; }

        $start = $limit * $page - $limit;
        $datagrid['start'] = $start;
        $result = $this->socio_model->jqlistsociossuscritos(1, $datagrid);

        $responce->page = $page;
        $responce->total = $total_pages;
        $responce->records = $count;
        $i = 0;
        while (list($clave, $row) = each($result)) {
            $responce->rows[$i]['id'] = $row['id_socio_suscriptor'];
            $responce->rows[$i]['cell'] = array(
                $row['id_socio_suscriptor'],
                $row['first_name'],
                $row['last_name'],
                $row['sexo'],
                $row['celular'],
                $row['email'],
                $row['direccion'],
                $row['observacion'],
                // socio suscrito
                getDateTimeFormat($row['fecha_registro'], 'Y-m-d'),
                $row['id_empresa_producto'],
                $row['id_socio'],
                getDateTimeFormat($row['fecha_inicio'], 'Y-m-d H:i:s'),
                getDateTimeFormat($row['fecha_fin'], 'Y-m-d H:i:s')
            );
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
            $datasocio['first_name'] = $this->input->post('addSocio_first_name');
            $datasocio['last_name'] = $this->input->post('addSocio_last_name');
            $datasocio['sexo'] = $this->input->post('addSocio_sexo');
            $datasocio['email'] = $this->input->post('addSocio_email');
            $datasocio['celular'] = str_replace('-', '', $this->input->post('addSocio_celular'));
            $datasocio['direccion'] = $this->input->post('addSocio_direccion');

            $datasocio['created_at'] = date("y-m-d h:i:s");
            $datasocio['additional']['empresa_id'] = $usuario['empresa_id'];
            $datasocio['additional']['observacion'] = $this->input->post('addSocio_observacion');

            $this->load->model('socio_model');
            $this->socio_model->add($datasocio);
            $this->cleancache();
            echo 1;
            //$this->output->set_content_type('application/json');
            //$this->output->set_output(json_encode($arrayjson));
        }
    }

    /**
     * Update socio with field correspont in the respect tables
     */
    public function update()
    {
        if ($this->input->post()) {
            // socio
            $dataSocio['id'] = $this->input->post('id_socio');
            $dataSocio['first_name'] = stripHTMLtags($this->input->post('first_name', TRUE));
            $dataSocio['last_name'] = stripHTMLtags($this->input->post('last_name', TRUE));
            $dataSocio['sexo'] = stripHTMLtags($this->input->post('sexo', TRUE));
            $dataSocio['email'] = stripHTMLtags($this->input->post('email', TRUE));
            $dataSocio['celular'] = stripHTMLtags(str_replace('-', '', $this->input->post('celular', TRUE)));
            $dataSocio['direccion'] = stripHTMLtags($this->input->post('direccion', TRUE));
            if ($dataSocio['id'] > 0) {
                $this->socio_model->update($dataSocio);
            }

            // socio suscrito
            $dataSocioSuscrito['id'] = $this->input->post('ac_socios_suscriptores_id'); // OJO [.=_] ac_socios_suscriptores.id
            $dataSocioSuscrito['id_empresa'] = $this->userId;
            $dataSocioSuscrito['observacion'] = stripHTMLtags($this->input->post('observacion', TRUE));
            if (!empty($dataSocioSuscrito['observacion'])) {
                $a = $this->Socio_Suscriptor_model->update($dataSocioSuscrito);
            }

            redirect('/dashboard');
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
            echo "#404 exit"; exit;
        }
    }

    /**
     * Function for subscribe user a one period (day.week, month, year)
     */
    public function suscripcion()
    {
        $return = FALSE;
        $inputIdEmpresaProducto = $this->input->post('id_empresa_producto');
        if (isAjax() == TRUE && $this->input->post() && empty($inputIdEmpresaProducto)) {
            $fechaInicio = $this->input->post('suscrip_fecha_inicio');
            $fechaInicio = getformatDateEsToEn($fechaInicio);
            $idEmpresaProducto = $this->input->post('suscrip_idEmpresaProducto');
            $idSocioSubcrito = $this->input->post('suscrip_idSocio');

            if ($idEmpresaProducto > 0 && $idSocioSubcrito > 0 && $fechaInicio != FALSE) {
                $dataEmpresa = $this->_getEmpresaProducto($idEmpresaProducto);

                if (!empty($dataEmpresa['nro_dia'])) {
                    $diasSuscripcion = $dataEmpresa['nro_dia'];
                    $dias = new DateInterval("P{$diasSuscripcion}D");// dias $horas = new DateInterval("PT1H"); // horas
                    //$fechaInicioDT = new DateTime($fechaInicio);
                    $fechaInicioDTBase = getDateTime($fechaInicio);
                    $fechaInicioDT = getDateTime($fechaInicio);
                    $fechaFinDT = date_add($fechaInicioDT, $dias);

                    $dataUpdate = array(
                        'id' => $idSocioSubcrito,// id que se encuentra en el jqgrid (ID) $idSocio
                        //'id_socio' => $idSocio,
                        'id_empresa' => $this->userId,
                        'id_empresa_producto' => $idEmpresaProducto,
                        'empresa_producto_precio' => $dataEmpresa['precio'],
                        'pago' => 0,
                        'adeuda' => 0,
                        'fecha_inicio_base' => $fechaInicioDTBase->format('Y-m-d H:i:s'),
                        'fecha_inicio' => $fechaInicioDTBase->format('Y-m-d H:i:s'),
                        'fecha_fin' => $fechaFinDT->format('Y-m-d H:i:s'),
                        'estado' => self::ESTADO_ACTIVO,
                        'fecha_registro' => date('Y-m-d H:i:s')
                    );
                    $return = $this->Socio_Suscriptor_model->update($dataUpdate);
                }
            }
        }
        echo $return;
    }

    /***
     * obtiner data o carateristicas del producto por id (empresa join empresa_producto)
     * @param int id
     * @retun data of product
     */
    private function _getEmpresaProducto($idEmpresaProducto)
    {
        $data = $this->Empresa_producto_model->selectByEmpresa($this->userId, $idEmpresaProducto);
        return empty($data[0]) ? FALSE : $data[0];
    }
    
}
