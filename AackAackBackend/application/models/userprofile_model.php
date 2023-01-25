<?php
Class userprofile_model extends CI_Model
{

	function view($userid)
	{
		if(!empty($userid))
		{
				// send password to email
				$details = $this->db->query("select * from tbl_users where userid='$userid'");
				$row = $details->row_array(); 
					if(($row['social_type'] == '2' || $row['social_type'] == '4' || $row['social_type'] == '5' || $row['social_type'] == '6'))
					{
								if (strpos($row['profile_pic'],'http:') !== false || strpos($row['profile_pic'],'https:') !== false)
								{
									$pic =$row['profile_pic'];
								}
								else
								{
									$pic = base_url('images').'/'.$row['profile_pic'];	
								}
						//$pic = $row['profile_pic'];
						
					}
					else if($row['social_type'] == '3')// general login so provide path to image
					{
						$pic = base_url('images').'/'.$row['profile_pic'];
						
					}
					$followstatus=false;
					$query=$this->db->query("select followee from tbl_follow where follower='$userid'");
					if($query->num_rows()>0)
					{
					
					$followstatus=true;
					}
					
				//$pic = base_url('images').'/'.$row['profile_pic'];
				$message = array("firstname"=>$row['firstname'],"lastname"=>$row['lastname'],"username"=>$row['username'],"email"=>$row['email'],
				"profilepic"=>$pic,"password"=>$row['password'],"logintype"=>$row['social_type'],"followstatus"=>$followstatus,
				"number"=>$row['number']);
					

		}
		else
		{
			$message = array("message"=>"provide userid");
		}
		echo json_encode($message); 
	}
	
	function update($userid,$username,$password,$number,$firstname,$lastname,$logo,$email,$flag)
	{
		//if(!empty($userid) && !empty($username) && !empty($password) && !empty($number)&& !empty($firstname)&& !empty($lastname)&& !empty($logo)&& !empty($email))
		if(!empty($userid) &&  !empty($number) && !empty($firstname)  && !empty($logo) && !empty($email) && !empty($flag))
		{
				$query112=$this->db->query("select * from tbl_users where email='$email' and userid != '$userid'");
				$row112=$query112->row_array();
				
				$query113=$this->db->query("select * from tbl_users where username='$username' and userid != '$userid'");
				$row113=$query113->row_array();
				
				$followstatus=false;
				$query=$this->db->query("select followee from tbl_follow where follower='$userid'");
				if($query->num_rows()>0)
				{
				
				$followstatus=true;
				}
				
				if($query112->num_rows() > 0)
				{
					$message = array("message"=>"User with this Email already exists");
				}
				elseif($query113->num_rows() > 0)				
				{
					$message = array("message"=>"User with this UserName already exists");
				}
				else
				{
					if($flag == 'yes')
					{
						$updatequery = $this->db->query("UPDATE tbl_users SET username='$username',password='$password',number='$number',
						firstname='$firstname',lastname='$lastname',profile_pic='$logo',email='$email' 
						where userid='$userid'");
						$message = array("message"=>"Success","profilepic"=>$logo,"followstatus"=>$followstatus);
					}
					elseif($flag == 'no')
					{
						$updatequery = $this->db->query("UPDATE tbl_users SET username='$username',password='$password',number='$number',
						firstname='$firstname',lastname='$lastname',email='$email' 
						where userid='$userid'");
						$message = array("message"=>"Success","profilepic"=>$logo,"followstatus"=>$followstatus);
					}

					
				}

		}
		else
		{
			$message = array("message"=>"provide values");
		}
		echo json_encode($message);
	}
	

}
?>
