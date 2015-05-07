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
        $this->load->model('formbuilder_fields_model');
    }
   
    public function index(){
        $this->data['title'] = 'Form Manage';
        $this->data['subview'] = 'formbuilder/manageform';
        $this->load->view('__layout_main', $this->data);
    }
    public function testcreatedforms(){
        
    }
    
        public function formdescription() {

        //Page parts
        $this->data['title'] = 'Form Description';
        $this->data['subview'] = 'formbuilder/formdescription';

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
                if ($id = $this->formbuilder_model->save($data)) {
                    $this->session->set_userdata(array('form_id' => $id));
                    $this->session->set_flashdata('success_message', 'Record added successfully');
                } else {
                    $this->session->set_flashdata('error_message', 'Error found to add record');
                }
            }
            redirect(array('formbuilder/createform/' . $data['no_of_fields']));
        }
        // loading the  view
        $this->load->view('__layout_main', $this->data);
    }

    public function createform($nof) {

        //Page parts
        $this->data['title'] = 'Form Fields creation';
        $this->data['subview'] = 'formbuilder/createform';
        $this->data['nof'] = $nof;


        //Form Handling and validation
        $n = 0;
        for ($n = 1; $n <= $nof; $n++) {
            $fieldName1 = "name-" . $n;
            $fieldName2 = "type-" . $n;
            $fieldName3 = "required-" . $n;
            $this->form_validation->set_rules($fieldName1, 'Field Name', 'required');
            $this->form_validation->set_rules($fieldName2, 'Field Type', 'required');
            $this->form_validation->set_rules($fieldName3, 'Mandatory', 'required');
        }


        if ($this->form_validation->run()) {
            $submittedValues = $this->input->post(NULL, TRUE);
            $row_num = 1;

            $form_fields = array();
            foreach ($submittedValues as $key => $value) {
                $key_parts = explode('-', $key);
                $form_fields[$key_parts[1]][$key_parts[0]] = $value;
            }
            
               foreach ($form_fields as $details){
                    $data = array('form_details_id' => $this->session->userdata('form_id'));
                    foreach ($details as $key => $value) {
                        $data[$key] = $value;
                    }
                 echo '<pre>';   
                 print_r($data); print '<br/>';print '<br/>';
                //Saving data to database via model
                    if ($id) {
                        if ($this->formbuilder_fields_model->save($data, $id)) {
                            $this->session->set_flashdata('success_message', 'Record edited successfully');
                        }else{
                            $this->session->set_flashdata('error_message', 'Error found to edit record');
                        }
                    }else{
                        if($this->formbuilder_fields_model->save($data)) {
                            $this->session->set_flashdata('success_message', 'Record added successfully');
                        }else{
                            $this->session->set_flashdata('error_message', 'Error found to add record');
                        }
                     }
                }
            redirect(array('formbuilder/manageform/'));
        }
        // loading the  view
        $this->load->view('__layout_main', $this->data);
        //die(__FILE__.' '.__LINE__);
    }

}
