<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class delete extends CI_Controller {


	//default function
	function __construct()
	{
		parent::__construct();
		$this->load->helper(array('form', 'url'));
		 $this->load->library('curl');
		 $this->load->library('email');
	}
	
	
	//backup
	
	function user()
	{
		
		$userid = $_REQUEST['userid'];
		// if type is 1 it is inbox, if type is 2 it is sent message
		$this->load->model('delete_model');
		$results = $this->delete_model->user($userid);
	}
	
	function aack()
	{
 		$userid=$_REQUEST['userid'];
		$aackid=$_REQUEST['aackid'];
		
		$this->load->model('delete_model');
		$results = $this->delete_model->aack($userid,$aackid); 
		
	}
			
} 
 ?>
	


