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
        $this->load->model('createform_model');
        $this->load->model('formfieldmap_model');
        $this->load->model('testform_model');
    }
   
    public function index(){
        //Page parts
        $this->data['title'] = 'Manage Form';
        $this->data['subview'] = 'formbuilder/index';
     
        $this->data['forms']=$this->createform_model->get();

        //loading the view
        $this->load->view('__layout_main', $this->data);
    }
    
    
    public function createform(){

        //Page parts
        $this->data['title'] = 'Create Form';
        $this->data['subview'] = 'formbuilder/createform';
        

        //Setting the validation rules 

        $rules = array(
            'name'=>array(
                    'field'=>'name',
                    'label'=>'Form name',
                    'rules'=>'required|trim',
                    'errors' => array(
                        'mandatory' => 'The Name field is mandatory',
                    )
                )
            );
        //tying the rules with the form validation
        $this->form_validation->set_rules($rules);

        //running validation

        if($this->form_validation->run()){
            //catching the submiotted and preparing the datat array for saving to db
            $data = array(
                    'name'=>$this->input->post('name'),
                );
            //saving the values to the database
            if ($id) {
                if ($this->createform_model->save($data, $id)) {
                    $this->session->set_flashdata('success_message', 'Record edited successfully');
                } else {
                    $this->session->set_flashdata('error_message', 'Error found to edit record');
                }
            } else {
                if ($form_id = $this->createform_model->save($data)) {
                    $this->session->set_flashdata('success_message', 'Record added successfully');
                } else {
                    $this->session->set_flashdata('error_message', 'Error found to add record');
                }
            }

            //redirecting to fileds assign page
            redirect(array('formbuilder/assignfields/'.$form_id.'/'.$data['name']));
        }

        //loading the view
        $this->load->view('__layout_main', $this->data);

    }

    public function assignfields($form_id,$form_name){
        
        //page parts
        $this->data['title'] = 'Assign Fields';
        $this->data['subview'] = 'formbuilder/assignfields';

        //fetching the fomr name
        $this->data['form_name'] = $form_name;

        //adding the form id to session to fetch after submit
        $this->session->set_userdata(array('form_id'=>$form_id)); 
        
        //fetchin the form fields
        $this->data['fields'] = $this->formbuilder_fields_model->get();
        
        
        //From handling
        
        //Setting validation rules

        $rules = array(
            'fieldlist'=>array(
                    'field' =>'fieldList',
                    'label' =>'List of Fields',
                    'rules' =>'required',
                    )
            );
       

        //tying the validation with the form
        $this->form_validation->set_rules($rules);

        //running validation
        if($this->input->post()){

            //Fetching the form id from session 
            $form_id = $this->session->userdata('form_id');
            $postVals = $this->input->post('fieldList');    
            
            foreach ($postVals as $key => $value) {
                //setting the data array for saving to the database
                $data = array(
                    'form_id'=> $form_id,
                    'field_id' =>$value,   
                    );
         echo '<pre>';
         print_r($data); print '<br />';print '<br />';
                //saving the values to the database
            if ($id) {
                if ($this->formfieldmap_model->save($data, $id)) {
                    $this->session->set_flashdata('success_message', 'Record edited successfully');
                } else {
                    $this->session->set_flashdata('error_message', 'Error found to edit record');
                }
            } else {
                if ($this->formfieldmap_model->save($data)) {
                    $this->session->set_flashdata('success_message', 'Record added successfully');
                } else {
                    $this->session->set_flashdata('error_message', 'Error found to add record');
                }
            }

            }
            
            //redirectring
            redirect(array('formbuilder/index'));
        }
        
        // echo '<pre>';
        // print_r($postVals); 
        

        $this->data['form_id']= $form_id;
        $this->load->view('__layout_main', $this->data);

    }
    
    public function testform($form_id){
        //page parts
        $this->data['title'] = 'Test Field';
        $this->data['subview'] = 'formbuilder/testform';
        $this->data['form_id']= $form_id;
        
        
        //Fetching the form details
        $this->db->select('field_id');
        $this->db->where('form_id', $form_id); 
        $field_list = $this->db->get('form_field_rel')->result();
        
        $id_array = array();
        
        foreach($field_list as $field){
            $id_array[] = $field->field_id;
        }
        
        $id_string = implode(',', $id_array);
        
//        $query = "SELECT ff.*,ffo.text,ffo.value FROM form_field ff
//                  INNER JOIN form_field_option ffo
//                   ON ff.id=ffo.form_field_id WHERE ff.id IN({$id_string})";
        
        $result = $this->testform_model->getFields($id_string);
        echo '<pre>';
        print_r($result);
        die(__FILE__.' '.__LINE__);
        $this->load->view('__layout_main', $this->data);
    }
        
}