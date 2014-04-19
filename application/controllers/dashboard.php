<?php

class Dashboard extends MY_Controller {

    public function __construct()
    {
        parent::__construct();
    }    
    
    public function index()
    {
        $this->layout->view('dashboard/index');
        //$this->load->view('dashboard/index');
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
