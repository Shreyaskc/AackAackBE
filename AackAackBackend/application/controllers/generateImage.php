<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class generateImage extends CI_Controller {


	//default function
	function __construct()
	{
		parent::__construct();
		$this->load->helper(array('form', 'url'));
		 $this->load->library('curl');
		 $this->load->library('email');
	}
	
	function image()
	{
		$json = $_REQUEST['json'];
		
		$data['results'] = $json;
		
		$this->load->view('image',$data);
	}
	
	
} 
 ?>
	


