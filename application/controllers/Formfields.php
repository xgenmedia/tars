<?php

class Formfields extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('formfields_model');
        $this->load->model('fieldoption_model');
    }

    public function index() {

        //Page parts
        $this->data['title'] = 'Fields Manage';
        $this->data['subview'] = 'formfields/index';
        
        //fetching the data
        $this->data['fields'] = $this->formfields_model->get_by(array('is_active'=>'Y')); 

        //Loading the view
        $this->load->view('__layout_main', $this->data);
    }

    public function createfield() {

//if(sizeof($_POST)>0){
//    echo '<pre>';
//    print_r($_POST);
//    die(__FILE__.' '.__LINE__);
//}
//Page parts
        $this->data['title'] = 'Create ';
        $this->data['subview'] = 'formfields/createfield';

        //Form Handling and Validation
        //Setting validation rules
        $rules = array(
            'name' => array(
                'field' => 'name',
                'label' => 'Field Name',
                'rules' => 'required|trim'
            ),
            'type' => array(
                'field' => 'type',
                'label' => 'Field Type',
                'rules' => 'required|trim',
                'errors' => array(
                    'mandatory' => 'Please select a field type',
                )
            ),
            'required' => array(
                'field' => 'required',
                'label' => 'Field Required',
                'rules' => 'required|trim',
                'errors' => array(
                    'mandatory' => 'Please select a value',
                )
            ),
        );

        //Tying the rules with the form
        $this->form_validation->set_rules($rules);

        //Running validation
        if ($this->form_validation->run()) {

            //Setting the data array for saving in the database table "form_field"
            $field_data = array(
                'name' => $this->input->post('name'),
                'type' => $this->input->post('type'),
                'required' => $this->input->post('required'),
            );

            //Savig the values to the db table "form_field"
            if ($id) {
                if ($this->formfields_model->save($field_data, $id)) {
                    $this->session->set_flashdata('success_message', 'Record edited successfully');
                } else {
                    $this->session->set_flashdata('error_message', 'Error found to edit record');
                }
            } else {
                if ($form_field_id = $this->formfields_model->save($field_data)) {
                    $this->session->set_flashdata('success_message', 'Record added successfully');
                } else {
                    $this->session->set_flashdata('error_message', 'Error found to add record');
                }
            }

            //Setting the data array for for saving in the table "form_field_option" if present
            //fetching the list of options value
            $options_array = $this->input->post('option');
            if (sizeof($options_array) > 0 && is_array($options_array)) {

                //making the options data array for saving in the database
                $option_data = array();
                foreach ($options_array as $option) {
                    $option_data = array(
                        'form_field_id' => $form_field_id,
                        'text' => $option,
                        'value' => $option,
                    );
//echo '<pre>';
//print_r($option_data); print '<br />';print '<br />';print '<br />';
                    //Saving values in the database table "form_field_option"
                    if ($id) {
                        if ($this->fieldoption_model->save($option_data, $id)) {
                            $this->session->set_flashdata('success_message', 'Record edited successfully');
                        } else {
                            $this->session->set_flashdata('error_message', 'Error found to edit record');
                        }
                    } else {
                        if ($this->fieldoption_model->save($option_data)) {
                            $this->session->set_flashdata('success_message', 'Record added successfully');
                        } else {
                            $this->session->set_flashdata('error_message', 'Error found to add record');
                        }
                    }
                }
                
            }
            
            //redirecting to manage page
            redirect(array('formfields/index/'));
        }


        //Loading the view
        $this->load->view('__layout_main', $this->data);
    }

}
