<?php
/*
 * Class Dashboard
 */
class Dashboard extends MY_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->accessAcl();
    }    
    
    public function index()
    {   
        $this->breadcrumb->add('Home', '#');
        $this->breadcrumb->add('Principal', '#');
        //$this->breadcrumb->add('Tutorials', base_url().'tutorials');                        
        $this->loadStatic(array('css' => '/css/jquery-ui.min.css'));
        $this->loadStatic(array('css' => '/css/datepicker.css'));
        $this->loadStatic(array('css' => '/css/ui.jqgrid.css'));
                
        $this->loadStatic(array('js' => '/js/date-time/bootstrap-datepicker.min.js'));
        $this->loadStatic(array('js' => '/js/jqGrid/jquery.jqGrid.min.js'));
        $this->loadStatic(array('js' => '/js/jqGrid/i18n/grid.locale-en.js'));        
        $this->loadStatic(array('js' => '/js/jqGrid/jqgridCustom.js'));
        
        // validate
        $this->loadStatic(array('js' => '/js/jquery.validate.min.js'));
        // mask
        $this->loadStatic(array('js' => '/js/jquery.maskedinput.min.js'));
        // bootbox
        $this->loadStatic(array('js' => '/js/bootbox.min.js'));
        // jquery -ui (calendar) (estos (2)plugin pueden ser cambiado solo existe 1 utilidad en modal suscripcion)
        $this->loadStatic(array('js' => '/js/jquery-ui-1.10.3.full.min.js'));
        $this->loadStatic(array('js' => '/js/jquery.ui.touch-punch.min.js'));
        // timer
        $this->loadStatic(array('js' => '/js/application/plugin/countdown/jquery.countdown.js'));

        $this->loadStatic(array('js' => '/js/application/dashboard/index.js'));

        $this->load->model('Empresa_producto_model');
        $usuario = $this->getUserSession();
        $idEmpresa = $usuario['empresa_id'];

        $data = array('empresa_producto' => $this->Empresa_producto_model->selectByEmpresa($idEmpresa));

        $this->layout->view('dashboard/index',$data);
    }

    public function grid()
    {
        $this->breadcrumb->add('Home', '#');
        $this->breadcrumb->add('Principal', '#');

        $this->loadStatic(array('css' => '/css/jquery-ui.min.css'));
        $this->loadStatic(array('css' => '/css/datepicker.css'));
        $this->loadStatic(array('css' => '/css/ui.jqgrid.css'));                
        $this->loadStatic(array('js' => '/js/date-time/bootstrap-datepicker.min.js'));
        $this->loadStatic(array('js' => '/js/jqGrid/jquery.jqGrid.min.js'));        
        $this->loadStatic(array('js' => '/js/jqGrid/i18n/grid.locale-en.js'));        
        
        $this->loadStatic(array('js' => '/js/application/dashboard/grid.js'));        
        
        
        $this->layout->view('dashboard/grid');
    }    

}