<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class getfolloweelist extends CI_Controller {


	//default function
	function __construct()
	{
		parent::__construct();
		$this->load->helper(array('form', 'url'));
		 $this->load->library('curl');
		 $this->load->library('email');
	}
	
	
	// FAVS page 6 screen
	// Description
	/*
	Display the users whom you are following 
	*/
	function getFolloweeList()
	{
	
		$userid = $_REQUEST['userid'];
		$start = $_REQUEST['start'];
		$devicedatetime = $_REQUEST['devicedatetime'];
		$this->load->model('getfolloweelist_model');
		
		$results = $this->getfolloweelist_model->getFolloweeList($userid,$devicedatetime,$start); 
	}
	
} 
 ?>
	


