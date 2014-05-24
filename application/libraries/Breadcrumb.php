<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * @source http://www.technicalkeeda.com/details/how-to-create-bread-crumb-using-php-codeigniter
 * 
 */
class Breadcrumb {
    public $CI;
    private $breadcrumbs = array();
    private $separator = '';
    private $start = '<ul class="breadcrumb">';
    private $end = '</ul>';

    public function __construct($params = array())
    {
        $this->CI =& get_instance();
        if (count($params) > 0) {
            $this->initialize($params);
        }
    }

    private function initialize($params = array()) 
    {
        if (count($params) > 0) {
            foreach ($params as $key => $val) {
                if (isset($this->{'_' . $key})) {
                    $this->{'_' . $key} = $val;
                }
            }
        }
    }

    /**
     * Initialize variable $breadcrumb in (view)
     * @param type $title
     * @param type $href
     * @return type
     */
    function add($title, $href)
    {
        if (!$title OR !$href) {
            return;
        }            
        $this->breadcrumbs[] = array('title' => $title, 'href' => $href);        
        // add CI
        $this->CI->load->vars(array('breadcrumb' => $this->output()));
    }

    function output()
    {

        if ($this->breadcrumbs) {

            $output = $this->start;

            foreach ($this->breadcrumbs as $key => $crumb) {
                if ($key) {
                    $output .= $this->separator;
                }
                
                if($key == 0) {
                     $output .= '<i class="icon-home home-icon"></i>';
                }

                if (end(array_keys($this->breadcrumbs)) == $key) {                    
                    $output .= '<li class="active">' . $crumb['title'] . '</li>';
                    
                } else {
                    $output .= '<li><a href="' . $crumb['href'] . '">' . $crumb['title'] . '</a></li>';                    
                }
            }

            return $output . $this->end . PHP_EOL;
        }

        return '';
    }
    
}
