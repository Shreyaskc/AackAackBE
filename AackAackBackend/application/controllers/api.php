<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class api extends CI_Controller {


	//default function
	function __construct()
	{
		parent::__construct();
		$this->load->helper(array('form', 'url'));
		 $this->load->library('curl');
		 $this->load->library('email');
	}
	
	function insertaack()
	{
		//$this->load->model('api_model');
		$this->load->view('addaack');
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
	
	// log out Users
	function logOut()
	{
		$userid = $_REQUEST['userid'];
		$this->load->model('api_model');

		$results = $this->api_model->logOut($userid);

	
	}
	
	// search user
	function searchUsers()
	{
		$search = $_REQUEST['search'];
		$userid = $_REQUEST['userid'];
		$start = $_REQUEST['start'];
		$devicedatetime = $_REQUEST['devicedatetime'];
 		$this->load->model('api_model');
		$results = $this->api_model->searchUsers($search,$userid,$start,$devicedatetime);
		
	}
	
	// add followers data
	
	function addFollow()
	{
		$followerid = $_REQUEST['userid'];// the follower id is always userid. from his account he will follow another user example A
		$followee_id = $_REQUEST['followuserid'];// the user(B) who is being followed by userid(A) example A is following B
		$this->load->model('api_model');
		$results = $this->api_model->addFollow($followerid,$followee_id);
	}

	// Un follow users  data
	
	function unFollow()
	{
		$followerid = $_REQUEST['userid'];// the follower id is always userid. from his account he will follow another user example A
		$followee_id = $_REQUEST['followuserid'];// the user(B) who is being followed by userid(A) example A is following B
		$this->load->model('api_model');
		$results = $this->api_model->unFollow($followerid,$followee_id);
	}
	
	// add sms threads
	function addMessage()
	{
		$fromuser = $_REQUEST['userid'];// logged in user id
		$touser   = $_REQUEST['touserid'];// to user
		$messagebody = $_REQUEST['messagebody']; // content
		
		$this->load->model('api_model');
		$results = $this->api_model->addMessage($fromuser,$touser,$messagebody);
				
	}
	
	// get messages of all user you follow
	function getMessageufollow()
	{
		$userid = $_REQUEST['userid'];// logged in user id
		$devicedatetime = $_REQUEST['devicedatetime'];
		$start = $_REQUEST['start'];
		$this->load->model('api_model');
		$results = $this->api_model->getMessageufollow($userid,$devicedatetime,$start);
				
	}
	
	function del_reshare()
	{
		$userid = $_REQUEST['userid'];// logged in user id
		$aackid = $_REQUEST['aackid'];
		$this->load->model('api_model');
		$results = $this->api_model->del_reshare($userid,$aackid);
	}
	
	//backup
	
	function backUp()
	{
		$data = $_REQUEST['data'];
		$userid = $_REQUEST['userid'];
		// if type is 1 it is inbox, if type is 2 it is sent message
		$this->load->model('api_model');
		$results = $this->api_model->backUp($data,$userid);
	}
	
	function testbackUp()
	{
		$data = $_REQUEST['data'];
		$userid = $_REQUEST['userid'];
		// if type is 1 it is inbox, if type is 2 it is sent message
		$this->load->model('api_model');
		$results = $this->api_model->testbackUp($data,$userid);
	}
	
		
	function getMessages()
	{
		$userid = $_REQUEST['userid'];
		$devicedatetime = $_REQUEST['devicedatetime'];
		$start = $_REQUEST['start'];
		// if type is 1 it is inbox, if type is 2 it is sent message
		$this->load->model('api_model');
		$results = $this->api_model->getMessages($userid,$devicedatetime,$start);
	}
	//test
	function testgetMessages()
	{
		$userid = $_REQUEST['userid'];
		$devicedatetime = $_REQUEST['devicedatetime'];
		// if type is 1 it is inbox, if type is 2 it is sent message
		$this->load->model('api_model');
		$results = $this->api_model->testgetMessages($userid,$devicedatetime);
	}

	function testGetAllMessages()
	{
		//$userid = $_REQUEST['userid'];
		//$devicedatetime = $_REQUEST['devicedatetime'];
		// if type is 1 it is inbox, if type is 2 it is sent message
		$this->load->model('api_model');
		$results = $this->api_model->testgetAllMsgs();
	}
	
	function getMessageBody()
	{
		$userid = $_REQUEST['userid'];
		$number = $_REQUEST['number'];
		
		// if type is 1 it is inbox, if type is 2 it is sent message
		$this->load->model('api_model');
		$results = $this->api_model->getMessageBody($userid,$number);
	}
	
	//==================
		// REGISTRATION
	//=========
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
					$this->load->model('api_model');				
					$results = $this->api_model->testaddUserSample($username,$password,$number,$logintype,$firstname,$lastname,$logo,$email,$devicetoken);
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
	
	// adding aacks
	/*
		Brief explanation of concept
		-----------------------------------
		Stage 1 :
		
		In the message body screen , User will create an image and send it to addAack() service. Here we will insert the aack image and 
		user_id in tbl_aacks table. So at this stage an Aack_id will be generated and given to developers with success response.
		
		Stage 2 :
		
		At this stage, User will be able to share the generated aack by adding the content like "Caption, Conversation from, Screen look, share option".
		API used is shareAack() so here with given data we will update the aack_id with the content.
		
		
		
	
	*/
	function addAack()
	{
		$userid=$_REQUEST['userid'];
		$devicedatetime=$_REQUEST['devicedatetime'];
		$number = $_REQUEST['number'];
		$lastmessage = $_REQUEST['lastmessage'];
		$thumb = $_FILES['thumb']['name'];
		$aack=$_FILES['logo']['name'];
		
		if(!empty($aack) && !empty($thumb))
		{
			
			//echo 'Here here';
			//----------------------------------------------------	Original Image
				//getting image path info
				$imagepath = pathinfo($aack);
				//renaming image name with current server date and image path extension
				$pic=date('YmdHis').'.'.$imagepath['extension'];	
				$config['upload_path'] = './aacks/';
				$config['allowed_types'] = 'gif|jpg|jpeg|png';
				$config['max_size']	= '0';
				$config['max_width']  = '0';
				$config['max_height']  = '0';
				$config['file_name'] = $pic; 
				$this->load->library('upload', $config);
				$this->upload->do_upload('logo');
				$upload_data = $this->upload->data();
				$aackimage=$upload_data['file_name'];
				
			//----------------------------------------------------	Thumb Image
				//getting thumb image path info  saved to "aack_thumbs" Folder
				$thumbpath = pathinfo($thumb);
				//renaming image name with current server date and image path extension
				$pic1=date('YmdHis').'.'.$thumbpath['extension'];	
				$config1['upload_path'] = './aack_thumbs/';
				$config1['allowed_types'] = 'gif|jpg|jpeg|png';
				$config1['max_size']	= '0';
				$config1['max_width']  = '0';
				$config1['max_height']  = '0';
				$config1['file_name'] = $pic1; 
				//$this->load->library('upload', $config);
				$this->upload->initialize($config1); 
				$this->upload->do_upload('thumb');
				$upload_data1 = $this->upload->data();
				$aackthumb=$upload_data1['file_name'];//thumb
				

					
					//original
					
					
					$this->load->model('api_model');	
					
					$results = $this->api_model->addAack($userid,$aackimage,$devicedatetime,$number,$lastmessage,$aackthumb);
				
		}
		else
		{
			$message = array('message'=>"provide values","image"=>"Image not given");
			echo json_encode($message);
		}
		
	}
	
	// share aack image concept is updating the aack records
	function shareAack()
	{
		$userid = $_REQUEST['userid'];
		$aackid = $_REQUEST['aackid'];
		$caption = $_REQUEST['caption'];
		$caption = str_replace("/n"," ",$caption);
		$conversation = $_REQUEST['conversation'];// conversation with
		$screenlook = $_REQUEST['screentype'];// screen type {"1"=>"iPhone Classic"}, {"2"=>"iPhone ios7"}, {"3"=>"Android"}
		$sharedto = $_REQUEST['sharedto'];
		
		$this->load->model('api_model');
		$results = $this->api_model->shareAack($userid,$aackid,$caption,$conversation,$screenlook,$sharedto);
	
	}
	
	//Reshare Aack
	function reshareAack()
	{
		$userid = $_REQUEST['userid'];
		$aackid = $_REQUEST['aackid'];
		$sharedto = $_REQUEST['sharedto'];
		$date = $_REQUEST['date'];
		
		$this->load->model('api_model');
		$results = $this->api_model->reshareAack($userid,$aackid,$sharedto,$date);
		
	}
	
	// get Profile details
	function profile()
	{
		error_reporting(E_ALL); ini_set('display_errors', '1');
		error_reporting(E_ERROR | E_PARSE);
		//userid=profile being viewed 
		//userid2=logged in user
		$userid = $_REQUEST['userid'];
		$userid2 = $_REQUEST['userid2'];
		$devicedatetime = $_REQUEST['devicedatetime'];
		$start = $_REQUEST['start'];
	
		
		$this->load->model('api_model');
		$results = $this->api_model->profile($userid,$devicedatetime,$start,$userid2);
	
	}
	//	function detailProfile($userid,$devicedatetime,$start,$userid1)
	
	function detailProfile()
	{
		$userid = $_REQUEST['userid'];
		$userid1 = $_REQUEST['userid1'];
		$devicedatetime = $_REQUEST['devicedatetime'];
		$start = $_REQUEST['start'];
	
		
		$this->load->model('api_model');
		$results = $this->api_model->detailProfile($userid,$devicedatetime,$start,$userid1);
	
	}
	
	// FAVS page 6 screen
	// Description
	/*
	Display the aacks that belongs to the users whom you are following 
	*/
	function getAacks()
	{
		$userid = $_REQUEST['userid'];
		$start = $_REQUEST['start'];
		$this->load->model('api_model');
		
		$results = $this->api_model->getAacks($userid,$start);
	}
	// favs test -> getFavAacks
	function getFavAacks()
	{
		$userid = $_REQUEST['userid'];
		$start = $_REQUEST['start'];
		$this->load->model('api_model');
		
		$results = $this->api_model->getFavAacks($userid,$start);
	}
	
		
	/*
		FAVS 2 display aacks
		Here user will pass his user_id(A) and user_id(B) of the aack which he made as FAV and we will display B's aacks 
 	*/
	function getUseraacks()
	{
		$userid = $_REQUEST['userid'];// logged in user id A
		$aackuserid = $_REQUEST['aackuserid'];// aack userid is nothing but number. if A chated with 90000900009 then to get all fav aacks of A and that number we must need to send the number
		$devicedatetime = $_REQUEST['devicedatetime'];// userid of the aacks you want to see B
		$start = $_REQUEST['start'];
		if($start == '')
		{
			$start = '0';
		}
		else
		{
			$start = $start;
		}
		$this->load->model('api_model');
		
		$results = $this->api_model->getUseraacks($userid,$aackuserid,$devicedatetime,$start);
		
	}
	// following
	function getFollowList()
	{
		$userid = $_REQUEST['userid'];
		$start = $_REQUEST['start'];
		$this->load->model('api_model');
		
		$results = $this->api_model->getFollowList($userid,$start);
	}
	// followers
	function getFolloweeList()
	{
		$userid = $_REQUEST['userid'];
		$start = $_REQUEST['start'];
		$this->load->model('api_model');
		
		$results = $this->api_model->getFolloweeList($userid,$start);
	}
	
	//getfollowstatus
	function getFollowStatus()
	{
		$followerid = $_REQUEST['userid'];// the follower id is always userid. from his account he will follow another user example A
		$followee_id = $_REQUEST['followuserid'];// the user(B) who is being followed by userid(A) example A is following B
		$this->load->model('api_model');
		$results = $this->api_model->getFollowStatus($followerid,$followee_id);
	}
	
	function searchmsgs()
	{
	   $userid=$_REQUEST['userid'];
	   $search=$_REQUEST['search'];
	   $devicedate = $_REQUEST['devicedate'];
	   $start=!empty($_REQUEST['start'])?$_REQUEST['start']:0;
	   if(!empty($userid) && !empty($search))
	   {
	   $this->load->model('api_model');
	   $msg = $this->api_model->searchmsgs($userid,$search,$start,$devicedate);
	   }
	   else
	   {
	   $msg=array("message"=>"Required fields");
	   }
	   
	   echo json_encode($msg);
	}
	
	function formaddUser()
	{
		$this->load->view('addUser');
	}
} 
 ?>
	


