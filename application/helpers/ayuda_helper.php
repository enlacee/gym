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
        return PUBLIC_URL; 
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

//end application/helpers/ayuda_helper.php