<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class like_aack extends CI_Controller {


	//default function
	function __construct()
	{
		parent::__construct();
		$this->load->helper(array('form', 'url'));
		 $this->load->library('curl');
		 $this->load->library('email');
	}
	
	function likeAack()
	{
		$aackid = $_REQUEST['aackid'];
		$userid = $_REQUEST['userid'];
		$this->load->model('like_aack_model');
		$results = $this->like_aack_model->likeAack($aackid,$userid);
	}
	
	function likedUsers()
	{
		$aackid = $_REQUEST['aackid'];
		$start = $_REQUEST['start'];
		$start = (empty($start))?"0":$start;
		
		$this->load->model('like_aack_model');
		$results = $this->like_aack_model->likedUsers($aackid,$start);
	}
	
	function aackCount()
	{
		$aackid = $_REQUEST['aackid'];
		$userid = $_REQUEST['userid'];
		
		$this->load->model('like_aack_model');
		$results = $this->like_aack_model->aackCount($aackid,$userid);
	}
	
	
} 
 ?>
	


