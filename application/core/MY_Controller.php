<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
* 
*/
class MY_Controller extends CI_Controller
{
	public $data =array();

	function __construct()
	{
		parent::__construct();

		$this->data['site_name'] ="Massive Display";
	}
}