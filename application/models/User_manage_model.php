<?php

class User_manage_model extends CI_Model {
    
   public function __construct() {
        parent::__construct();
    }
    
    public function insert($table_name = NULL,$values = array())
    {
        if($this->db->insert($table_name,$values))
            return 1;
        else
            return 0;
    }
    public function update($table_name = NULL,$id = NULL,$values=array())
    {
       $this->db->where('id',$id); 
       if($this->db->update($table_name,$values))
            return 1;
       else
           return 0;
       
    }
    public function delete($table_name = NULL,$id = NULL)
    {
       $this->db->where('id',$id); 
       $this->db->delete($table_name);
        
    }
    
    
     public function get($table_name = NULL,$no_of_records=NULL,$row_index=NULL)
    {
        
        if($no_of_records!==NULL && $row_index!==NULL):
            $this->db->limit($no_of_records,$row_index);
            
        endif; 
        $query=$this->db->get($table_name);
        return $query->result();
        
    }
     public function get_by($table_name = NULL,$id = NULL)
    {
        $this->db->where('id',$id);
        $query=$this->db->get($table_name);
        return $query->result();
    }
    
    
     public function get_group_rights($id = NULL)
    {
       // $this->db->where('id',$id);
        //$query=$this->db->get($table_name);
         $query=$this->db->query(
                 'SELECT cfw_task.*,group_rights.task_id as group_task_id,group_rights.group_id '
                 .'FROM '
                .'cfw_task '
                .'LEFT JOIN '
                .'(SELECT * FROM '
                .'cfw_group_rights '
                .'WHERE group_id = '.$id.') group_rights '
                .'ON '
                .'cfw_task.id = group_rights.task_id '
                 . 'WHERE cfw_task.is_deleted = "N" AND cfw_task.is_active= "Y"');      
        // $query=$this->db->query(" select tid,title,description,g.id,g.group_name,g.active from (select t.id as tid, t.title,t.description,gr.grp_id as gid from et_task as t left join et_group_rights as gr on t.id=gr.task_id and gr.grp_id=".$id.") as alias left join et_group as g on g.id=alias.gid and g.id=".$id.";");
         return $query->result();
    }
    public function get_user_rights($group_id,$user_id)
{
     $query=$this->db->query(
             "SELECT task_list.*,user_rights.user_id,user_rights.task_id as user_task_id,user_rights.is_active as user_rights_active "
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
            .'cfw_user_rights.user_id='.$user_id.' AND cfw_user_rights.is_deleted= "N") user_rights '
            .'ON '
            .'user_rights.task_id = task_list.id');
     return $query->result();
}
    
    
    public function upd_group_rights($id = NULL){
         
        
        $old_rights= $this->user_manage_model->get_group_rights($id);
        $old_rights_array=array();
        $new_rights_array=array();
        $task_id=  $this->input->post('task_id');
        
        $k=0;
        
        //creating old_rights_array which stores old task ids
        if($old_rights):
            for($i=0;$i<sizeof($old_rights);$i++):            
                if(isset($old_rights[$i]->group_id)):
                    $old_rights_array[$k++]=$old_rights[$i]->group_task_id;
                endif;
            endfor;
        endif;
              
        //creating new rights array fetched from form
        if($task_id && is_array($task_id)):
            $new_rights_array=$task_id;
        endif;
        
        
        //Operations
        
        if(!empty($new_rights_array) && !empty($old_rights_array)):
            
            //Insert
            foreach($new_rights_array as $new_right):
                if(!in_array($new_right, $old_rights_array)):
                    $values=array(
                      'task_id' => $new_right,
                      'group_id' => $id
                    );
                    $this->insert('cfw_group_rights',$values);
                endif;
            endforeach;
            
            //Delete
            foreach($old_rights_array as $old_right):
                 if(!in_array($old_right, $new_rights_array)):
                    $values=array(
                      'task_id' => $old_right,
                      'group_id' => $id
                    );
                    $this->delete_rights('cfw_group_rights',$values);
                endif;
            endforeach;
                
            
            
            
            //DELETE if all rights are unassigned
            elseif(empty($new_rights_array) && !empty($old_rights_array)):
                
                foreach($old_rights_array as $old_right):
                 $values=array(
                      'task_id' => $old_right,
                      'group_id' => $id
                    );
                    $this->delete_rights('cfw_group_rights',$values); 
                endforeach;
                
            //If newly assigning  rights
            elseif(!empty($new_rights_array) && empty($old_rights_array)):
                foreach($new_rights_array as $new_right):
                     $values=array(
                      'task_id' => $new_right,
                      'group_id' => $id
                    );
                    $this->insert('cfw_group_rights',$values); 
                endforeach;
            
        endif;
        
        
        
        
        /*
        if($task_id && $old_rights):
            for($i=0;$i<sizeof($task_id);$i++):
                for($j=0;$j<sizeof($old_rights);$j++):
                    
                    if($task_id[$i] == $old_rights[$j]->)
                endfor;
            endfor;
        endif;
        
    }*/
    
}


 
    public function upd_user_rights($group_id = NULL,$user_id= NULL){
         
        
        $old_rights= $this->user_manage_model->get_user_rights($group_id,$user_id);
        $old_rights_array=array(); //stores old rights permission
        $new_rights_array=array(); //stores new rights permission
        $task_id=  $this->input->post('task_id'); //fetches all the task
        $assign= $this->input->post('assign'); //fetches new permission with respect to each task
        $size=0;
        $k=0;
        
        //creating old_rights_array which stores old permissions 
        if($old_rights):
            for($i=0;$i<sizeof($old_rights);$i++):            
                $old_rights_array[$i]=NULL;
                if(isset($old_rights[$i]->group_id)):
                 $old_rights_array[$i]="inherited";     
                endif;
                 if(isset($old_rights[$i]->user_rights_active)):
                    $old_rights_array[$i]=$old_rights[$i]->user_rights_active;                                            
                 endif;  
            endfor;
        endif;
      
        //creating new rights array fetched from form
        if($task_id && is_array($task_id) && $assign && is_array($assign)):
            $size=  sizeof($task_id);
            $new_rights_array=$assign;
        endif;
      
        $rights_table='cfw_user_rights';
        
        /*
        Example:       
        
Task Id Array:
Array ( [0] => 2 [1] => 3 [2] => 4 [3] => 6 [4] => 7 ) 
Old Rights Array:
Array ( [0] => inherited [1] => inherited [2] => inherited [3] => inherited [4] => N ) 
New Rights Array:
Array ( [0] => N [1] => inherited [2] => inherited [3] => inherited [4] => N )
         * 
         */
        
        
        
        
        if(!empty($new_rights_array) && !empty($old_rights_array)):
            
           
            for($i=0;$i<$size;$i++):              
                $values=array(
                      'task_id' => $task_id[$i],
                      'user_id' => $user_id
                    );
            
            //Checking whether new rights is not equal to old rights for a particular task
              if(!($new_rights_array[$i] == $old_rights_array[$i])):
                  
                  //using switch case to determine an operations for particular conflict
                  
                    switch ($new_rights_array[$i])
                {
                    case 'Y':
                        //checking whether old right for the particular task is null or 'N' or 'inherited'
                        if($old_rights_array[$i] == NULL):  
                             $this->insert($rights_table,$values);  //if null then new entry in user_rights table and is_active='Y' by default 
                        
                        elseif($old_rights_array[$i] == 'N'):  //if 'N' then update entry in user_rights table by making is_active='Y' 
                             $this->update_rights($rights_table,$values,array('is_active' => 'Y'));
                                
                         elseif($old_rights_array[$i] == 'inherited'):  //if 'inherited from group' then insert new entry in user_rights table by making is_active='Y' 
                             $this->insert($rights_table,$values);
                        endif;
                     break;
                    
                    case 'N':
                        if($old_rights_array[$i] == NULL): //if null then new entry in user_rights table and making is_active='N' by default
                             $values['is_active']='N'; 
                            $this->insert($rights_table,$values);
                             
                        elseif($old_rights_array[$i] == 'Y'): //if 'Y' then update entry in user_rights table by making is_active='N' 
                             $this->update_rights($rights_table,$values,array('is_active' => 'N'));
                        print($i." Update");
        print("<br>");
        
        elseif($old_rights_array[$i] == 'inherited'):
                             $values['is_active']='N';
                             $this->insert($rights_table,$values); //if 'inherited from group' then insert new entry in user_rights table by making is_active='N' 
                        print($i." Inserted");
        print("<br>");
                        endif;
                        
                        
                        
                        break;
                    
                    case 'inherited':                         
                    $this->delete_rights($rights_table,$values); 
                         print($i." Deleted");
        print("<br>");
                    break;
                
                    case NULL:
                         if($old_rights_array[$i] == 'Y' || $old_rights_array[$i] == 'N'): //if null then new entry in user_rights table and making is_active='N' by default
                            
                          $this->delete_rights($rights_table,$values);                            
                        endif;
                        break;
                
                }
              endif;
            endfor;
              endif;
            
           
    
    
}


public function delete_rights($table_name,$id_array){  
    if($table_name == 'cfw_group_rights'):
    $this->db->where('task_id',$id_array['task_id']);
    $this->db->where('group_id',$id_array['group_id']);
    
    elseif($table_name == 'cfw_user_rights'):
        $this->db->where('task_id',$id_array['task_id']);
    $this->db->where('user_id',$id_array['user_id']);
    endif;
    
     $this->db->delete($table_name);
}
public function update_rights($table_name,$id_array,$values){  
    if($table_name == 'user_rights'):
    $this->db->where('task_id',$id_array['task_id']);
    $this->db->where('user_id',$id_array['user_id']);
    
    endif;
    
     $this->db->update($table_name,$values);
}

}

?>