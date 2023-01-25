<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class userprofile extends CI_Controller {


	//default function
	function __construct()
	{
		parent::__construct();
		$this->load->helper(array('form', 'url'));
		 $this->load->library('curl');
		 $this->load->library('email');
	}
	
	
	//backup
	
	function view()
	{
		
		$userid = $_REQUEST['userid'];
		// if type is 1 it is inbox, if type is 2 it is sent message
		$this->load->model('userprofile_model');
		$results = $this->userprofile_model->view($userid);
	}
	
	function update()
	{
			error_reporting(E_ALL); ini_set('display_errors', '1');
			error_reporting(E_ERROR | E_PARSE);
		
		$userid = $_REQUEST['userid'];
		$firstname = $_REQUEST['firstname'];
		$firstname = str_replace("%20"," ",$firstname);
		
		$lastname = $_REQUEST['lastname'];
		$lastname = str_replace("%20"," ",$lastname);
		$username = $_REQUEST['username'];
		$username = str_replace("%20"," ",$username);
		$password = $_REQUEST['password'];
		$email = $_REQUEST['email'];
		$number = $_REQUEST['number'];
		$number = str_replace(" ","",$number);
		$image=$_FILES['logo']['name'];	
		$flag = $_REQUEST['flag'];
		$picture = $_REQUEST['picture'];
		if($flag == 'yes')
		{
			if(!empty($image))
			{
				//getting image path info
				$imagepath = pathinfo($image);
				//renaming image name with current server date and image path extension
				$pic=date('YmdHis').'.'.$imagepath['extension'];	
				$config['upload_path'] = './images/';
				$config['allowed_types'] = 'gif|jpg|jpeg|png';
				$config['max_size']	= '0';
				$config['max_width']  = '0';
				$config['max_height']  = '0';
				$config['file_name'] = $pic; 
				$this->load->library('upload', $config);
				
				if ($this->upload->do_upload('logo'))
				{
					$upload_data = $this->upload->data();
					$logo=$upload_data['file_name'];
					//sending http post data to addrestaurant model
					$this->load->model('userprofile_model');				
					$results = $this->userprofile_model->update($userid,$username,$password,$number,$firstname,$lastname,$logo,$email,$flag);
				}
			}
			else
			{
				$message = array('message'=>"image not given");
				echo json_encode($message);
			}
		}
		else if($flag == 'no')
		{
			
			$this->load->model('userprofile_model');				
			$results = $this->userprofile_model->update($userid,$username,$password,$number,$firstname,$lastname,$picture,$email,$flag);
		}

	}
	
	function testupdate()
	{
		$this->load->view('addUser');
	}

	
} 
 ?>
	


