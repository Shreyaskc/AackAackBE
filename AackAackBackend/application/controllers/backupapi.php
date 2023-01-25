<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class backupapi extends CI_Controller {


	//default function
	function __construct()
	{
		parent::__construct();
		$this->load->helper(array('form', 'url'));
		 $this->load->library('curl');
		 $this->load->library('email');
	}
	
	
	//backup
	
	function backUp()
	{
		$data = $_REQUEST['data'];
		$userid = $_REQUEST['userid'];
		/* $lastbackup = $_REQUEST['lastbackup'];
		if(empty($lastbackup))
		{
			$lastbackup = " ";
		} */
		// if type is 1 it is inbox, if type is 2 it is sent message
		$this->load->model('backupmodel');
		$results = $this->backupmodel->backUp($data,$userid);
		//$results = $this->backupmodel->backUp($data,$userid,$lastbackup);
	}
	
	function backUpMedia()
	{
		
		$userid = $_REQUEST['userid'];
		$number = $_REQUEST['number'];
		$type   = $_REQUEST['type'];
		$date   = $_REQUEST['date'];
		$lastbackup   = $_REQUEST['lastbackup'];
		$image=$_FILES['media']['name'];	

				//getting image path info
				$imagepath = pathinfo($image);
				//renaming image name with current server date and image path extension
				$pic=time().'.'.$imagepath['extension'];	
				$config['upload_path'] = './multimedia/';
				$config['allowed_types'] = 'gif|jpg|jpeg|png';
				$config['max_size']	= '0';
				$config['max_width']  = '0';
				$config['max_height']  = '0';
				$config['file_name'] = $pic; 
				$this->load->library('upload', $config);
				
				if ($this->upload->do_upload('media'))
				{
					$upload_data = $this->upload->data();
					$media=$upload_data['file_name'];


				}
														//sending http post data to addrestaurant model
					$this->load->model('backupmodel');				
					$results = $this->backupmodel->backUpMedia($userid,$number,$type,$date,$media,$lastbackup);
			
	}
	
	function testupload()
	{
		$this->load->view('testaack.php');
	}
			
} 
 ?>
	


