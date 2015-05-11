<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
* 
*/
class User_model extends MY_Model
{
	
	protected $_table_name='user';
	function __construct()
	{
		parent::__construct();
	}

	public function login() {
		$user = $this->get_by(
				array(
					'email'=>$this->input->post('email'),
					'password'=>$this->hash($this->input->post('password')),
					'is_delete'=>'N'
					),TRUE);
		if(count($user)){
			// create session array
				$data_session = array(
					 'id'=>$user->id,
					 'name'=>$user->name,
					 'email'=>$user->email,
					 'phone'=>$user->phone,
					 'group_id'=>$user->group_id,
					 'loggedin'=>TRUE
				);
			// set session veriable
				$this->session->set_userdata($data_session);
				$this->fetch_rights($user->id, $user->group_id);
		}
	}

	public function logout() {
		$this->session->sess_destroy(); 
	}

	public function loggedin(){
		return (bool) $this->session->userdata('loggedin');
	}

	public function hash($string) {
		return hash('sha512',$string.config_item('encryption_key'));
	}

	public function fetch_rights($user_id = NULL, $group_id = NULL) {
        $task_id = array();
        $user_rights = array();
        $grp_rights = array();
        //$task_id_qry = "select task_id from cfw_task where code='".$code."'";
        $user_rights_qry = "";
        $grp_rights_qry = "";

       $values= $this->db->query(
                 'SELECT task_list.*,user_rights.user_id,user_rights.task_id as user_task_id,user_rights.is_active as user_rights_active '
                  .'FROM '
                .'(SELECT cfw_task.*,group_rights.task_id as group_task_id,group_rights.group_id '
                .'FROM ' 
                .'cfw_task '
                .'LEFT JOIN '
                .'(SELECT * FROM '
                .'cfw_group_rights '
                .'WHERE group_id = '.$group_id.') group_rights '
                .'ON '
                .'cfw_task.id = group_rights.task_id '
                .'WHERE cfw_task.is_deleted = "N" AND cfw_task.is_active= "Y") task_list '
                .'LEFT JOIN '
                .'(SELECT * '
                .'FROM '
                .'cfw_user_rights '
                .'WHERE '
                .'cfw_user_rights.user_id= '.$user_id.' AND cfw_user_rights.is_deleted= "N") user_rights '
                .'ON '
                .'user_rights.task_id = task_list.id '
                .'WHERE ((task_list.group_id IS NOT NULL OR user_rights.user_id IS NOT NULL) '
                .'AND '
                .'(user_rights.is_active = "Y" OR user_rights.is_active IS NULL))');
     $vals=$values->result();
     
     $rights=array();
     
     foreach($vals as $val):
         $rights[$val->code]=TRUE;
     endforeach;
     $this->session->set_userdata('rights',$rights);
    }
}