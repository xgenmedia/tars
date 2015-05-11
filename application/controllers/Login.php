<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * 
 */
class Login extends MY_Controller {

    function __construct() {

        parent::__construct();
    }

    public function index() {
        $rules = array('email' => array(
                                        'field' => 'email',
                                        'label' => 'Email',
                                        'rules' => 'required|valid_email'
                                       ),
                        'password' => array(
                                        'field' => 'password',
                                        'label' => 'Password',
                                        'rules' => 'required'
                                       )
                      );
        $this->form_validation->set_rules($rules);
        if($this->form_validation->run() == TRUE){
            $this->user_model->login();
            if($this->user_model->loggedin()) {
                redirect(array("dashboard"));
            } else {
                $this->session->set_flashdata('loginErr',"Sorry, the member email and password you entered do not match.");
                redirect(array("login"));
            }
        }
        // load view
        $this->data['subview'] = 'login/index'; 
        $this->load->view('__layout_login',$this->data);
        
    }

    public function logout() {
        $this->user_model->logout();
        redirect(array('login'));
    }

}
