<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class getfollowerslist extends CI_Controller {


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
	function getFollowList()
	{
	
		$userid = $_REQUEST['userid'];
		$start = $_REQUEST['start'];
		$devicedatetime = $_REQUEST['devicedatetime'];
		$this->load->model('getfollowerslist_model');
		
		$results = $this->getfollowerslist_model->getFollowList($userid,$devicedatetime,$start); 
	}
	
} 
 ?>
	


