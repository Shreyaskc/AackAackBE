<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class samplebackupapi extends CI_Controller {


	//default function
	function __construct()
	{
		parent::__construct();
		$this->load->helper(array('form', 'url'));
		 $this->load->library('curl');
		 $this->load->library('email');
	}
	
	
	//backup
	
	function backUp()
	{
		$data = $_REQUEST['data'];
		$userid = $_REQUEST['userid'];
		$username = $_REQUEST['username'];

		// if type is 1 it is inbox, if type is 2 it is sent message
		$this->load->model('samplebackupmodel');
		$results = $this->samplebackupmodel->backUp($data,$userid,$username);
		
	}
			
} 
 ?>
	


