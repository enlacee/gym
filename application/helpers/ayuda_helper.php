<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
//si no existe la función invierte_date_time la creamos
if(!function_exists('getMediaUrl'))
{
    //formateamos la fecha y la hora, función de cesarcancino.com
    function getMediaUrl()
    {
        return MEDIA_URL;
 
    }
}

if(!function_exists('getPublicUrl'))
{
    //formateamos la fecha y la hora, función de cesarcancino.com
    function getPublicUrl()
    {
        return base_url(PUBLIC_URL); 
    }
}


// lista - menu
/*if(!function_exists('get_users'))
{
    function get_users()
    {
        //asignamos a $ci el super objeto de codeigniter
        //$ci será como $this
        $ci =& get_instance();
        $query = $ci->db->get('usuarios');
        return $query->result();
 
    }
}*/

/**
 * Is Resquest ajax (true or false)
 */
if(!function_exists('isAjax'))
{
    function isAjax() {
        return !empty($_SERVER['HTTP_X_REQUESTED_WITH']) &&
        strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest';
    }
}

/**
 * Registro en tabla ac_logs : error in process
 */
if(!function_exists('insert_log')) {
    function insert_log($message)
    {   
        $CI =& get_instance();
        $CI->load->model('Log_model'); 
        $data = array ('message'=> $message, 'date' => date("Y-m-d H:i:s"));
        $response = $CI->Log_model->add($data);
        return $response;
    }
}