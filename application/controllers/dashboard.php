<?php

class Dashboard extends MY_Controller {

    public function __construct()
    {
        parent::__construct();
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

        $this->loadStatic(array('js' => '/js/application/dashboard/index.js'));
        
        
        //$data = array();
        $this->layout->view('dashboard/index');
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