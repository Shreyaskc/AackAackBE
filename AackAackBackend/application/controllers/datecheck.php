<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class datecheck extends CI_Controller {


	//default function
	function __construct()
	{
		parent::__construct();
		$this->load->helper(array('form', 'url'));
	}

	function dates()
	{
		$date1 = $_REQUEST['date1'];
		$date2 = $_REQUEST['date2'];
		$this->load->model('date_model');
		$result = $this->date_model->dates($date1,$date2);
	}
	
	function getDatetime()
	{
		echo  date('Y-m-d H:i:s');
	}
	
	
}
?>
