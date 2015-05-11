<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
* 
*/
class Group extends MY_Controller
{
	
	function __construct()
	{
		parent::__construct();

		// Load Model
		$this->load->model('group_model');
	}

	public function index()
	{
		$this->data['groups'] = $this->group_model->get_by(array('is_deleted'=>'N'));
		// Load view
		$this->data['subview'] = 'group/index';
		$this->load->view("__layout_main",$this->data);
	}


	public function edit($id = NULL)
	{
		$rules = array('name' => array(
										'field' => 'name',
						                'label' => 'Name',
						                'rules' => 'required'
									   ));
		$this->form_validation->set_rules($rules);
		if($this->form_validation->run() == TRUE){
				$data = array(
						  'title'=>$this->input->post('name'),
						  'parent_id'=>$this->input->post('parent_id'),
						  'is_active'=>$this->input->post('is_active')
						  );
				if($id) {
					if($this->group_model->save($data,$id)) {
						 $this->session->set_flashdata('success_message', 'Record edited successfully');
					} else {
						$this->session->set_flashdata('error_message', 'Error found to edit record');
					}
				} else {
					if($this->group_model->save($data)) {
						$this->session->set_flashdata('success_message', 'Record added successfully');
					} else {
						$this->session->set_flashdata('error_message', 'Error found to add record');
					}
				}
				// reditect
				redirect(array("group"));
		}
		

		if($id){
			$this->data['group'] = $this->group_model->get($id,TRUE);
		} else {
			$this->data['group'] = new stdClass;
			$this->data['group']->title='';
			$this->data['group']->parent_id=0;
			$this->data['group']->is_active ='Y';
		}

		// Parent Group search
			 $this->data['pGroups'][0] = 'None';
			 $pGroups = $this->group_model->get_by(array('is_deleted'=>'N'));
			 foreach ($pGroups as $key => $group) {
			 	$this->data['pGroups'][$group->id] = $group->title;
			 }
		// Load view
		$this->data['subview'] = 'group/edit';
		$this->load->view("__layout_main",$this->data);	
	}


	public function rights($id)
	{
			$this->load->model("user_manage_model");
			// Check ID is empty or not
				if($id):
				    // Do something
				 else:
				     redirect('group');
				endif;
			// Search permission Record 
				$this->data['values'] = $this->user_manage_model->get_group_rights($id);
				$this->data['group_details'] = $this->user_manage_model->get_by('cfw_group', $id);
			// IF Chenges	
				if($_POST && sizeof($_POST)>0):
				   $this->user_manage_model->upd_group_rights($id);
				   $this->session->set_flashdata('success_message', 'Successfully Updated');
				   redirect(array('group/rights/'.$id));
				endif;
			// Load View
				$this->data['subview']='group/rights';
				$this->load->view('__layout_main',$this->data);
	}
}