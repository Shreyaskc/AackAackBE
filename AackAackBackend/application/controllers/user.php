<?php
class user extends CI_Controller
{

	function hello()
	{
		echo "hello";
	}
		// add Users
	
	function addUser()
	{
		$firstname = $_REQUEST['firstname'];
		$firstname = str_replace("%20"," ",$firstname);
		
		$lastname = $_REQUEST['lastname'];
		$lastname = str_replace("%20"," ",$lastname);
		$username = $_REQUEST['username'];
		$username = str_replace("%20"," ",$username);
		$password = $_REQUEST['password'];
		$email = $_REQUEST['email'];
		$profilepic = $_REQUEST['profilepic'];
		$number = $_REQUEST['number'];
		$number = str_replace(" ","",$number);
		$number  = substr($number,-10);
		$socialid = $_REQUEST['socialid'];
		$logintype = $_REQUEST['logintype'];
		
		$devicetoken = $_REQUEST['devicetoken'];
		$devicetype = $_REQUEST['devicetype'];
		$image=$_FILES['logo']['name'];	
		

		$this->load->model('api_model');
		if($logintype == '3')// general login
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
					$this->load->model('user_model');				
					$results = $this->user_model->testaddUserSample($username,$password,$number,$logintype,$firstname,$lastname,$logo,$email,$devicetoken);
				}
			}
			else
			{
				$message = array('message'=>"image not given");
				echo json_encode($message);
			}
		
		}
		elseif($logintype == '2')//facebook
		{
		$results = $this->api_model->addUserFacebook($username,$email,$profilepic,$number,$socialid,$logintype,$devicetoken,$devicetype,$firstname,$lastname);
		}
		if($logintype == null)//facebook
		{
		$results = array('message'=>"provide values");
		echo json_encode($results); 
		}
	
	}
	
		// login Users
	function loginUser()
	{
		$username = $_REQUEST['username'];
		$password = $_REQUEST['password'];
		$devicetoken = $_REQUEST['deviceid'];
		$logintype = $_REQUEST['logintype'];
		if(empty($devicetoken))
		{
			$devicetoken='0';
		}

		$this->load->model('api_model');
		if($logintype == '3')// general login
		{
		$results = $this->api_model->loginUser($username,$password,$logintype,$devicetoken);
		}
		if($logintype == null)//facebook
		{
		$results = array('message'=>"provide values");
		echo json_encode($results); 
		}
	
	}
	
		function updateloginUser()
	{
		$username = $_REQUEST['username'];
		$password = $_REQUEST['password'];
		$devicetoken = $_REQUEST['deviceid'];
		$logintype = $_REQUEST['logintype'];
		if(empty($devicetoken))
		{
			$devicetoken='0';
		}

		$this->load->model('api_model');
		if($logintype == '3')// general login
		{
		$results = $this->api_model->updateloginUser($username,$password,$logintype,$devicetoken);
		}
		if($logintype == null)//facebook
		{
		$results = array('message'=>"provide values");
		echo json_encode($results); 
		}
	
	}
}

?>