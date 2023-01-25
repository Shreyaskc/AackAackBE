<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class getmessagelasttime extends CI_Controller {


	//default function
	function __construct()
	{
		parent::__construct();
		$this->load->helper(array('form', 'url'));
		 $this->load->library('curl');
		 $this->load->library('email');
	}
	
	function gettime()
	{
		$userid = $_REQUEST['userid'];
		$this->load->model('getmessagelasttime_model');
	
		$results = $this->getmessagelasttime_model->gettime($userid); 
	}	

}
?>