<?php  
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Layout
{    
    var $CI;
    var $layout;
    
    function Layout($layout = "layout/layout") {   
        $this->CI =& get_instance();
        $this->layout = $layout;
    }

    function setLayout($layout)
    {
      $this->layout = $layout;
    }
    
    function view($view, $data=null, $return=false)
    {   
        $loadedData = array();
        $loadedData = array_merge($loadedData, (array) $this->CI->session->all_userdata());
        $data = $this->_formatTitle($data);
        $loadedData['content_for_layout'] = $this->CI->load->view($view, $data, true);   
        if ($return) {
            $output = $this->CI->load->view($this->layout, $loadedData, true);
            return $output;
        } else {
            $this->CI->load->view($this->layout, $loadedData, false);
        }
    }
    
    /**
     * Titulo de la pagina para las vistas configuradas
     * @param Array $data
     * @return Array
     */
    private function _formatTitle($data)
    {        
        $pageTitle = (defined('TITLE')) ? TITLE : 'Defautl';
        
        if (isset($data['title'])) {
            $data['title'] = $data['title'] . ' | '. $pageTitle;
        } else {
            $data['title'] = 'default' . ' | '. $pageTitle; 
        }
        return $data;
    }
}
 