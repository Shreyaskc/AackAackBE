<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class comments extends CI_Controller {


	//default function
	function __construct()
	{
		parent::__construct();
		$this->load->helper(array('form', 'url'));
		 $this->load->library('curl');
		 $this->load->library('email');
	}
	
	function addComment()
	{
		$aackid = $_REQUEST['aackid'];
		$userid = $_REQUEST['userid'];
		$devicedatetime = $_REQUEST['devicedatetime'];
		$comment = str_replace("%20"," ",$_REQUEST['comment']);
		
		$this->load->model('comments_model');
		$results = $this->comments_model->addComment($aackid,$userid,$comment,$devicedatetime);
	}
	
	function getComments()
	{
		$aackid = $_REQUEST['aackid'];
		$start = $_REQUEST['start'];
		$devicedatetime = $_REQUEST['devicedatetime'];
		$start = (empty($start))?"0":$start;
		$this->load->model('comments_model');
		$results = $this->comments_model->getComments($aackid,$start,$devicedatetime);
		
	}
	
} 
 ?>
	


