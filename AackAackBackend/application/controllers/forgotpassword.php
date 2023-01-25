<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class forgotpassword extends CI_Controller {


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
		
		$email = $_REQUEST['email'];
		// email or username is given from the form
		// if type is 1 it is inbox, if type is 2 it is sent message
		$this->load->model('forgotpassword_model');
		$results = $this->forgotpassword_model->user($email);
	}
	
} 
 ?>
	


