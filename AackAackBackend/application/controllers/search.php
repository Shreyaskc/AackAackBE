<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class search extends CI_Controller {


	//default function
	function __construct()
	{
		parent::__construct();
		$this->load->helper(array('form', 'url'));
		$this->load->library('curl');
		$this->load->library('email');
	}
	
	// For User search with Full Name
	function Users()
	{
	//echo "234234";
 		$user = $_REQUEST['user'];
		$user = str_replace("%20"," ",$user);
		$userid = $_REQUEST['userid'];
		$start = $_REQUEST['start'];
		if(empty($start))
		{
			$start = '0';
		}
		$this->load->model('search_model');
		$results = $this->search_model->Usersearch($user,$userid,$start); 
		
	}
	
	// For hashtag's search
	function hashtags()
	{
		$string = $_REQUEST['string'];
		$userid = $_REQUEST['userid'];
		$start = $_REQUEST['start'];
			if(empty($start))
			$start = '0';
		
		$this->load->model('search_model');
		$results = $this->search_model->hashtags($string,$userid,$start);
	}
	
	// for message search
/* 	function message()
	{
		$string = $_REQUEST['string'];
		$userid = $_REQUEST['userid'];
		$this->load->model('search_model');
		$results = $this->load->search_model->hashtags($string,$userid);
	} */
	
	

	
} 
 ?>
	


