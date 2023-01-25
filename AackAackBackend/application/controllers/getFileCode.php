<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class getFileCode extends CI_Controller {


	//default function
	function __construct()
	{
		parent::__construct();
		$this->load->helper(array('form', 'url'));
		 $this->load->library('curl');
		 $this->load->library('email');
	}
	
	function getFileName()
	{
		$userid = $_REQUEST['userid'];
		if(!empty($userid))
		{
			$get = $this->db->query("SELECT messages FROM `tbl_backupmessages` where messagetype='mms' and userid='$userid' order by message_datetime desc  LIMIT 0,1");
			$res = $get->row_array();
				$amazon_file_name = basename($res['messages']);
				//echo $amazon_file_name;
				$a = explode('_',$amazon_file_name);
				
	
			//echo $a[1];
			$message = array("userid"=>$userid,"serial"=>($a[1] == null)?"":$a[1]);
		}
		else
		{
			$message = array("message"=>"provide userid");
		}
		echo json_encode($message);
		
	}
	
}