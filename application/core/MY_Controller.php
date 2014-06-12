<?php
/**
 * @author Anibal Copitan <acopitan@gmail.com>
 * @category Libreria
 * 
 * Encapsulamiento de funciones que se cargan al iniciar el controlador
 * base CI_Controller ejm : auth, cron, check, etc..
 */

class MY_Controller extends CI_Controller {
    
    public $ACL = FALSE;
    public $userId; 
    public $dataView = array();       
    private $flagGrid = false;

    public function __construct()
    {
        parent::__construct();
        $this->dependencias();
        $this->validarUsuario();
        //$this->validACL();
    }
    
    /**
     * validacion  de acceso a la applicacion
     * - administrador 
     * - usuario 
     */    
    public function validarUsuario()
    {   
        $user = $this->session->userdata('user'); //var_dump($user); exit;
        /*$this->session->set_userdata('user','');
        $user = $this->session->userdata('user'); var_dump($user);*/                    
        if (!empty($user) && isset($user['id'])) {
            $this->userId = $user['id'];            
            $this->ACL = TRUE;
        }
    }
    
    /**
     * Use only in class hija
     */
    protected function accessAcl()
    {
        if ( FALSE == $this->ACL) { // TERMINO SESSION ()
            if ($this->isAjax()) {
                echo "Acces denied ajax login (ACL)"; EXIT;
            } else {
               redirect("/"); 
            }
        } else { 
            // existen datos y validara si este usuario (rol=usuario) tiene acceso
            // ac_usuarios = rol 2 (envio rol por input FORM)
            $statusACL = $this->validACL();            
            if (FALSE == $statusACL) {
                if ($this->isAjax()) {
                    echo "Acces denied ajax (ACL)"; EXIT;
                } else {
                    echo "Acces denied (ACL)"; EXIT;
                }                
            } 
        }      
    }

    /*
     * list only rol 2 = usuario (default)
     */
    private function validACL()
    {
        $uri = uri_string(); //current_url()()
        $flag = FALSE;        
        $this->load->model('ACL_model');
        $dataResources = $this->ACL_model->getResources(2);
        if (is_array($dataResources) && count($dataResources) > 0 ) {
            foreach ($dataResources as $array) {
                if ($array['name'] == $uri) {
                    $flag = TRUE;
                    break;
                }
            }
        }        
        return $flag;        
    }
    
    private function isAjax() {
        return !empty($_SERVER['HTTP_X_REQUESTED_WITH']) &&
        strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest';
    }
    
    private function dependencias()
    {
        $this->load->library(array('layout', 'auth','breadcrumb'));        
        $this->load->helper(array('ayuda_helper', 'url', 'form'));
        //$this->output->enable_profiler(TRUE);
        $this->load->driver('cache');

        // message flash
        if ($this->session->flashdata('flashMessage') != '') {            
            $flashMessage['flashMessage'] = $this->session->flashdata('flashMessage');
            $this->load->vars($flashMessage); // $this->load->get_var('flashMessage');
        }
    }
    
    /**
     * Carga la libreria jqgrid util para la VISTA     
     *  $data['css'] = array ('file.css');
     *  $data['js'] = array ('file.js');
     */
    protected function loadJqgrid()
    {   
        if ($this->flagGrid == false) {           
            $this->dataView['css'][] = "jqgrid/css/cupertino/jquery-ui-1.10.4.custom.min.css";
            $this->dataView['css'][] = "jqgrid/css/ui.jqgrid.css";                  
            $this->dataView['js'][] = "jqgrid/i18n/grid.locale-es.js";
            $this->dataView['js'][] = "jqgrid/jquery.jqGrid.min.js";
            $this->dataView['js'][] = "jqgrid/fixGridSize.js";
            $this->flagGrid = true;
        }        
        $this->load->vars($this->dataView);
        return $this->dataView;       
    }
    
    protected function loadStatic(array $data = array()) {
      
        foreach ($data as $key => $value) {
            if ($key === 'css') {
                if (is_string($data[$key])) {
                    $this->dataView['css'][] = $value;
                } elseif (count($data[$key] > 0)) {
                    foreach ($data['css'] as $llave => $valor) {
                        $this->dataView['css'][] = $valor;
                    }                        
                }
            } elseif ($key === 'js') {
                if (is_string($data[$key])) {
                    $this->dataView['js'][] = $value;
                } elseif (count($data[$key] > 0)) {
                    foreach ($data['js'] as $llave => $valor) {
                        $this->dataView['js'][] = $valor;
                    }                        
                }                
            } elseif ($key === 'jstring') {
                if (is_string($data[$key])) {
                    $this->dataView['jstring'][] = $value;
                }
            }   
        }          
        //$this->load->get_var($key)
        $this->load->vars($this->dataView);
        return $this->dataView;
    }    
}
