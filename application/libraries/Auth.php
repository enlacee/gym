<?php
/**
 * 
 */
class Auth 
{
    public $ci;
    
    public function Auth()
    { 
        $this->ci =& get_instance();
    }  
    
    public function token()	
    { 
        $token = md5(uniqid(rand(),true));
        $this->ci->session->set_userdata('token',$token);
        return $token;
    }
}  
/* End of file /application/libraries/Auth.php */