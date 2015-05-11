<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
* 
*/
class User extends MY_Controller
{
	
	function __construct()
	{
		parent::__construct();

		// Load Model
		$this->load->model("user_model");
		$this->load->model("group_model");
		
	}

	public function index()
	{
		
		$this->data['users'] = $this->user_model->get_by(array('is_delete'=>'N'));
		
		// Load view
		$this->data['subview'] = 'user/index';
		$this->load->view("__layout_main",$this->data);
	}


	public function edit($id = NULL)
	{
		 $rules = array(
						'email' => array(
									    'field' => 'email',
						                'label' => 'Email',
						                'rules' => 'required|valid_email|callback_emailunique_check'
									   ),
						'name' => array(
										'field' => 'name',
						                'label' => 'Name',
						                'rules' => 'required'
									   ),
						'phone'=> array(
										'field' => 'phone',
						                'label' => 'Phone',
						                'rules' => 'required|numeric|exact_length[10]',
						                'errors'=>array(
						                			'exact_length'=>'Phone number 10 digit',
						                			'numeric'=>'Use numbers in Phone number'
						                			)
									   ),
						'address'=>array(
										 'field' => 'address',
						                 'label' => 'Address',
						                 'rules' => 'required'
										),
					  );
		if(!$id || $this->input->post('password')!='' ) {
				$rules = array_merge($rules,array(
											'pass'=>array(
														'field' => 'password',
										                'label' => 'Password',
										                'rules' => 'required|matches[confpass]',
										                'errors' =>array(
										                		'matches'=>'Password not match with Confirm Password'
										                	)
														 )
											));
		}

		//  
		$this->form_validation->set_rules($rules);
		if($this->form_validation->run() == TRUE){
				$data = array(
						 'group_id'=>$this->input->post('group'),
						 'username'=>$this->input->post('email'),
						 'email'=>$this->input->post('email'),
						 'phone'=>$this->input->post('phone'),
						 'name'=>$this->input->post('name'),
						 'address'=>$this->input->post('address'),
						 );
			   if($this->input->post('password')!=''){
			   	 $data = array_merge($data,array('password'=>$this->user_model->hash($this->input->post('password'))));
			   }	
				
			   if($id) {
					if($this->user_model->save($data,$id)) {
						 $this->session->set_flashdata('success_message', 'Record edited successfully');
					} else {
						$this->session->set_flashdata('error_message', 'Error found to edit record');
					}
			   } else {
					if($this->user_model->save($data)){
						 $this->session->set_flashdata('success_message', 'Record added successfully');
					} else {
						$this->session->set_flashdata('error_message', 'Error found to add record');
					}
			   }
			   //
			   redirect(array('user'));	 
		}
		//
		if($id) {
			$user = $this->user_model->get($id,TRUE);  	
		} else {
		  	$user = new stdClass;
		  	$user->username="";
		  	$user->group_id="";
		  	$user->name="";
		  	$user->email="";
		  	$user->phone="";
		  	$user->address="";
		}	

		$groups = $this->group_model->get_by(array('is_deleted'=>'N'));
		$this->data['groups'] = array();
		foreach ($groups as $gk => $group) {
			$this->data['groups'][$group->id] = $group->title;
		}
		
		$this->data['user'] = $user;
		// Load view
		$this->data['subview'] = 'user/edit';
		$this->load->view("__layout_main",$this->data);
	}

	public function emailunique_check($str) {
		$id = $this->uri->segment(3);
		!$id || $this->db->where('id !=',$id);
		$found = $this->user_model->get_by(array('email'=>$str));
        if(count($found)>0){
            $this->form_validation->set_message('emailunique_check', $str .' already exits use diffrent email');
            return FALSE;
        } else {
            return true;
        }
	}


	public function rights($id)
	{
			$this->load->model('user_manage_model');
			// Checking is ID present 
				if($id):
					$userDetails = $this->user_model->get($id,TRUE);
					$this->data['userDetails'] = $userDetails; 
				    $this->data['id']=$userDetails->id;
				    $this->data['group_id']=$userDetails->group_id;
				 else:
				     redirect('user');
				endif;
			// Search details of user , group etc	
				$this->data['values'] = $this->user_manage_model->get_user_rights($this->data['group_id'],$this->data['id']);
			// After POST	
				if($_POST && sizeof($_POST)>0):
				   $this->user_manage_model->upd_user_rights($this->data['group_id'],$this->data['id']);
				   $this->session->set_flashdata('success_message', 'Successfully Updated');
				   redirect('user/rights/'.$this->data['id']);
				endif;
			// Load View	
				$this->data['subview']='user/rights';
				$this->load->view('__layout_main',$this->data);
	}


}