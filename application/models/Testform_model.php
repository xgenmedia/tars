<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
* 
*/
class Testform_model extends MY_Model
{
	
	//protected $_table_name='form_field';
	function __construct()
	{
		parent::__construct();
	}
        public function getFields($id_string){
//            $this->db->select('form_field.*');
//            $this->db->select('form_field_option.text','form_field_option.value');
//            $this->db->from('form_field');
//            $this->db->join('form_field_option', 'form_field.id=form_field_option.form_field_id', 'left');
//            $this->db->where_in('form_field.id', $id_string);
//            $result = $this->db->get()->result();
//          //  $this->db->_compile_select();
            $query = "SELECT ff.*,ffo.text,ffo.value FROM form_field ff
                  LEFT JOIN form_field_option ffo
                   ON ff.id=ffo.form_field_id WHERE ff.id IN({$id_string})";
            $result = $this->db->query($query)->result();       
            return $result;
        }
}