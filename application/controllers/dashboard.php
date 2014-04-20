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
        
        
        //$data = array();
        $this->layout->view('dashboard/index');
    }
    
    public function blanco()
    {
        $this->layout->view('dashboard/blanco');
    }
    
    public function grid()
    {
        $this->load->view('dashboard/grid');
    }
}
