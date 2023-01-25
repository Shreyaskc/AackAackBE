<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class sample extends CI_Controller {


	//default function
	function __construct()
	{
		parent::__construct();
		$this->load->helper(array('form', 'url'));
	}

	function test()
	{
		$this->load->view('sample');
	}
	
	function testaack()
	{
		$this->load->view('testaack');
	}

	function addImage()
	{
		$thumb = $_FILES['thumb']['name'];
		$aack=$_FILES['logo']['name'];
		if(!empty($aack) && !empty($thumb))
		{
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
			if($this->upload->do_upload('logo'))
			{
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
				if($this->upload->do_upload('thumb'))
				{
					$upload_data1 = $this->upload->data();
					$aackthumb=$upload_data1['file_name'];//thumb
					$message=array("image"=>base_url('aacks').'/'.$aackimage,"thumb"=>base_url('aack_thumbs').'/'.$aackthumb);				
				}
			}
		}
		else
		{
			$message = array('message'=>"provide values","image"=>"Image not given");			
		}
		echo json_encode($message);
		
	}
}
?>
