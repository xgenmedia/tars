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

        
        $this->data['subview'] = 'login/index';

        if ($this->form_validation->run()) {

            $data = array(
                'username' => $this->input->post('email'),
                'email' => $this->input->post('email'),
                'phone' => $this->input->post('phone'),
                'name' => $this->input->post('name'),
            );
            if ($this->input->post('password') != '') {
                $data = array_merge($data, array('password' => $this->input->post('password')));
            }

            if ($id) {
                if ($this->user_model->save($data, $id)) {
                    $this->session->set_flashdata('success_message', 'Record edited successfully');
                } else {
                    $this->session->set_flashdata('error_message', 'Error found to edit record');
                }
            } else {
                if ($this->user_model->save($data)) {
                    $this->session->set_flashdata('success_message', 'Record added successfully');
                } else {
                    $this->session->set_flashdata('error_message', 'Error found to add record');
                }
            }
            //
            redirect(array('user'));
        }

        // load view
        $this->load->view('__layout_login', $this->data);
    }

    public function logout() {
        redirect(array('login'));
    }

}
