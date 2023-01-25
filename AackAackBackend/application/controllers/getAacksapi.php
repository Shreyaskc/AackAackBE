<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class getAacksapi extends CI_Controller {


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
	Display the aacks that belongs to the users whom you are following 
	*/
	function getAacks()
	{
		$userid = $_REQUEST['userid'];
		$start = $_REQUEST['start'];
		$this->load->model('getAacksmodel');
		
		$results = $this->getAacksmodel->getAacks($userid,$start);
	}
	
} 
 ?>
	


