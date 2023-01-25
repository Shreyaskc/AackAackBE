<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class socialSignin extends CI_Controller {


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
		

		$this->load->model('social_model');

		$results = $this->social_model->addUserSocial($profilepic,$socialid,$logintype);
	
	}
	// test
	function sampleSignup()
	{

		$profilepic = $_REQUEST['profilepic'];

		$socialid = $_REQUEST['socialid'];
		$logintype = $_REQUEST['logintype'];// 2= facebook, 3 is general login, 4 is twitter,5 is instagram
		$deviceid = $_REQUEST['deviceid'];

		$this->load->model('social_model');

		$results = $this->social_model->testUserSocial($profilepic,$socialid,$logintype,$deviceid);
	
	}
	
	// update profile
		function updateProfile()
		{
			$userid = $_REQUEST['userid'];
			$firstname = $_REQUEST['firstname'];
			$firstname = str_replace("%20"," ",$firstname);
			
			$lastname = $_REQUEST['lastname'];
			$lastname = str_replace("%20"," ",$lastname);
			$username = $_REQUEST['username'];
			$username = str_replace("%20"," ",$username);
			
			$email = $_REQUEST['email'];
			
			$number = $_REQUEST['number'];
			$number = str_replace(" ","",$number);
			$number  = substr($number,-10);
			$socialid = $_REQUEST['socialid'];
			$logintype = $_REQUEST['logintype'];
			$deviceid = $_REQUEST['deviceid'];

			

			$this->load->model('social_model');


			$results = $this->social_model->updateUser($username,$email,$number,$socialid,$logintype,$firstname,$lastname,$deviceid,$userid);

			if($logintype == null)//facebook
			{
			$results = array('message'=>"provide values");
			echo json_encode($results); 
			}
		

				
		}
} 
 ?>
	


