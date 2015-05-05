<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
* 
*/
class Login extends Admin_Controller
{
	
	function __construct()
	{
		
		parent::__construct();
	}

	public function index()
	{
		$this->data['subview'] = 'login/index';	
		// load view
		$this->load->view('__layout_login',$this->data);
	}


	public function logout()
	{
		redirect(array('login'));
	}
        
}