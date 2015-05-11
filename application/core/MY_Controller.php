<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
* 
*/
class MY_Controller extends CI_Controller
{
	public $data =array();

	function __construct()
	{
		parent::__construct();
        // Load model
            $this->load->model('user_model');   
        // load library
            $this->load->library('form_validation');
        //  
            $this->data['site_name'] ="TARS";
            $this->data['title'] ="TARS";
        // Dynamic Load file
            $this->data['css'] = array();
            $this->data['js'] = array();
            $this->data['style'] = array();
            $this->data['script'] = array();
            
        //====== Login Check =================      
                     $exception_uri =array(
                                'login',
                                'login/logout',
                     );
                 // if uri is not present in this array 
                    if(in_array(uri_string(),$exception_uri) == FALSE) { 
                             // if user is not loged in
                             if($this->user_model->loggedin()==FALSE) {
                                // rediredt to login page
                                $this->session->set_flashdata('loginErr',"Session expired.");
                                redirect('login','refresh');
                             }
                              
                             // User Permission Checking
                             if(!has_rights(get_uri())){ 
                                //redirect('user/login','refresh');
                                die('Access Denied'); 
                            }
                    }        
	}
}