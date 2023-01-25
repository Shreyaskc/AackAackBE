<?php
class admin extends CI_Controller
{
 function __construct()
   {
   parent::__construct();
   header("Access-Control-Allow-Origin: *");
   header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS');
   header('content-type: application/json;charset=utf-8');
   include(APPPATH.'libraries/S3.php');
   }
    
	
	function angularlogin($username,$password)
	{

	$this->load->model('admin_model');
	$msg=$this->admin_model->angularlogin($username,$password);
	echo json_encode($msg);

	}
	
	function getreports()
	{
	$this->load->model('admin_model');
	$msg=$this->admin_model->getreports();
	echo json_encode($msg);
	}
	
	function truncAllTables()
	{
	
	$this->load->model('admin_model');
	$msg=$this->admin_model->truncAllTables();
	echo json_encode($msg);
	
	}
	
	function deleteS3Data()
	{
	
	$this->load->model('admin_model');
	$msg=$this->admin_model->deleteS3Data();
	echo json_encode($msg);
	
	}
	
	function nggetaacks($userid)
	{
	
	$this->load->model('admin_model');
	$msg=$this->admin_model->nggetaacks($userid);
	echo json_encode($msg);

	}	
	
	function aackemail($userid,$aackid)
	{
	
	$this->load->model('admin_model');
	$msg=$this->admin_model->aackemail($userid, $aackid);
	echo json_encode($msg);
	
	}
	
	function sendemail($userid,$aackid,$email)
	{
	
	$this->load->model('admin_model');
	$msg=$this->admin_model->sendemail($userid,$aackid,$email);
	//$msg=array("message"=>"success");
	echo json_encode($msg);

	}
	
	function login()
	{
		$username = $_REQUEST['username'];
		$password = $_REQUEST['password'];

		if(!empty($username) && !empty($password) )// general login
		{
		$this->load->model('admin_model');
		$results = $this->admin_model->login($username,$password);
		//var_dump ($results);
        if($results[message]== "success")
		  {
		   //getting images
		   $this->load->model('admin_model');
		   $start = empty($_REQUEST['start'])?0:$_REQUEST['start'];
		   $results1['data'] = $this->admin_model->getAacks($results['userid'],$start);
		   //var_dump ($results1);
		   $this->load->view('aackgallery',$results1);
		  }
		  else
		  {
		  $this->load->view('index');
		  }
		}
		else
		{
		$results = array('message'=>"invalid login"); 
		}
	}
	
    function getAacks()
	{
		$userid = $_REQUEST['userid'];
		$start = empty($_REQUEST['start'])?0:$_REQUEST['start'];
		$this->load->model('admin_model');
		
		$results = $this->admin_model->getAacks($userid,$start);
		//var_dump ($results);
		$this->load->view('aackgallery',$results);
	}
	
	function weblogin()
	{
	 $this->load->helper("url");
	 $this->load->view('index');
	}
}
?>