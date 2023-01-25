<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class testControll extends CI_Controller {


	//default function
	function __construct()
	{
		parent::__construct();
		$this->load->helper(array('form', 'url'));
		 $this->load->library('curl');
		 $this->load->library('email');
	}
	
//==================
		// REGISTRATION

	// first time signin
	function signup()
	{

		$profilepic = $_REQUEST['profilepic'];

		$socialid = $_REQUEST['socialid'];
		$logintype = $_REQUEST['logintype'];// 2= facebook, 3 is general login, 4 is twitter,5 is instagram
		$deviceid = $_REQUEST['deviceid'];
		

		$this->load->model('testsignup_model');

		$results = $this->testsignup_model->addUserSocial($profilepic,$socialid,$logintype,$deviceid);
	
	}

	
} 
 ?>
	


