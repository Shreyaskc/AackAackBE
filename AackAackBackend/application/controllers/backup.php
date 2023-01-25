<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class backup extends CI_Controller {


	//default function
	function __construct()
	{
		parent::__construct();
		$this->load->helper(array('form', 'url'));
		 $this->load->library('curl');
		 $this->load->library('email');
	}
	
	
	//backup
	
	function backingup()
	{
				error_reporting(E_ALL); ini_set('display_errors', '1');
		error_reporting(E_ERROR | E_PARSE);
		$data = $_REQUEST['data'];
		$userid = $_REQUEST['userid'];
		//print_r($data);
		// if type is 1 it is inbox, if type is 2 it is sent message
 		$this->load->model('backupmodel');
		$results = $this->backupmodel->backUp($data,$userid);
		
	}
	
	function test()
	{
		error_reporting(E_ALL); ini_set('display_errors', '1');
		error_reporting(E_ERROR | E_PARSE);
		$result = json_decode(trim(file_get_contents('php://input')),true);
		//print_r($result);
		$userid = $result['userid'];
		$dataset = $result['data'];
		//print_r($dataset);

		if($this->db->insert_batch('tbl_backupmessages',$dataset))
		{
			echo "yes";
		}
		else
		{
			echo "no";
		} 
		

	}
			
} 
 ?>
	


