<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Formbuilder extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('formbuilder_model');
    }

    public function index() {

        //Page parts
        $this->data['title'] = 'Form Description';
        $this->data['subview'] = 'formbuilder/index';

        //Form Handling and validation

        $rules = array(
            'name' => array(
                'field' => 'formName',
                'label' => 'formName',
                'rules' => 'required'
            ),
            'url' => array(
                'field' => 'url',
                'label' => 'page url',
                'rules' => 'required',
            ),
            'nof' => array(
                'field' => 'nof',
                'label' => 'Number of Fields',
                'rules' => 'required|numeric',
                'errors' => array(
                    'numeric' => 'Use numbers in No of field  number',
                )
            ),
        );
        //tying the rules with the form
        $this->form_validation->set_rules($rules);

        //Running validation
        if ($this->form_validation->run()) {
            $data = array(
                'name' => $this->input->post('formName'),
                'page_url' => $this->input->post('url'),
                'no_of_fields' => $this->input->post('nof'),
            );
            if ($id) {
                if ($this->formbuilder_model->save($data, $id)) {
                    $this->session->set_flashdata('success_message', 'Record edited successfully');
                } else {
                    $this->session->set_flashdata('error_message', 'Error found to edit record');
                }
            } else {
                if ($this->formbuilder_model->save($data)) {
                    $this->session->set_flashdata('success_message', 'Record added successfully');
                } else {
                    $this->session->set_flashdata('error_message', 'Error found to add record');
                }
            }
            redirect(array('formbuilder/createform/'.$data['no_of_fields']));
        }
        // loading the  view
        $this->load->view('__layout_main', $this->data);
    }
    
    public function createform($nof){
        print $nof; print '<br />';
        
        //Page parts
        $this->data['title'] = 'Form Fields creation';
        $this->data['subview'] = 'formbuilder/createform';
        $this->data['nof'] = $nof; 
        
        
        //Form Handling and validation
        // loading the  view
        $this->load->view('__layout_main', $this->data);
        //die(__FILE__.' '.__LINE__);
    }

}
