<?php
/**
* 
*/
class Task extends MY_Controller
{
	
	function __construct()
	{
		parent::__construct();
		// Load Model
		 $this->load->model('user_manage_model');
	}


	public function index()
	{
			$this->db->where(array('is_deleted'=>'N'));
			$this->data['tasks'] = $this->user_manage_model->get('cfw_task');
		// Load View
		   $this->data['subview']='task/index';
		   $this->load->view('__layout_main',$this->data);
	}


	public function edit($id = NULL)
	{
		   if($id!=NULL):
				    $this->data['values'] = $this->user_manage_model->get_by('cfw_task', $id);
		   endif;
		   //setting rules
			$rules=array(
			        'code' => array(
			            'field' => 'code',
			            'label' => "Code",
			            'rules' => 'trim|required'),
			        'title' => array(
			            'field' => 'title',
			            'label' =>"Title",
			            'rules' => 'trim|required')
			 );
			 $this->form_validation->set_rules($rules);
			 if ($this->form_validation->run() == TRUE) {
				 	// Recive POST Value
					$values = array(
				                    'code' => $this->input->post('code'),
				                    'title' => $this->input->post('title'),
				                    'description' => $this->input->post('description')
				    ); 	

				    if ($id == NULL):
			            if($this->user_manage_model->insert('cfw_task', $values)):
			            	$this->session->set_flashdata('success_message','Successfully Inserted');
			            else:
			            	$this->session->set_flashdata('error_message','Error in inserting data');	
			            endif;
		     	    else:
			             if($this->user_manage_model->update('cfw_task', $id, $values)):
			                $this->session->set_flashdata('success_message', 'Successfully Updated');
			             else:
			            	$this->session->set_flashdata('error_message','Error in updating');	
			             endif;
		     	    endif;
		     	    
		     	    redirect(array('task'));
			 }

		 // Load View
		   $this->data['subview']='task/edit';
		   $this->load->view('__layout_main',$this->data);	
	}
}