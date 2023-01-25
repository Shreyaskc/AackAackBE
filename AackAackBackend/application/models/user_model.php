<?php
class user_model extends CI_Model
{
// General login test
	function testaddUserSample($username,$password,$number,$logintype,$firstname,$lastname,$logo,$email,$devicetoken)
	{
		//echo "asdsad";
		//mandory fields
		if(!empty($username) && !empty($password) && !empty($firstname)  && !empty($logintype) && !empty($email) && !empty($logo) && !empty($number))
		{
			// check validation
/* 			$devicecheck = $this->db->query("select * from tbl_users where devicetoken = '$devicetoken'");
			$countdevices = $devicecheck->num_rows();
			if($countdevices > '0')
			{
				$message = array("message"=>"device already registered");
			} */
			//else
			//{
				$query1=$this->db->query("select * from tbl_users where (email='$email' or username='$username') and social_type='$logintype'");
				$row1=$query1->row_array();
				if($query1->num_rows() > 0)	
				{
					$userid = $row1['userid'];
					// how many users you are following example A->b,c count for A is 2
					$querystring=$this->db->query("select followee from tbl_follow where follower = '$userid'");
					
					$followingcount = $querystring->num_rows();
					
					//follower count. Means how many users are following you
					
					$query4=$this->db->query("select follower from tbl_follow where followee = '$userid'");
					
					$followerscount = $query4->num_rows(); 
					// get datetime of when a user made his messages backup
					$backuptime=$this->db->query("select lastbackup from tbl_backupmessages where userid='$userid'");
					$backup = $backuptime->row_array(); 
					
					$fullname = $row1['firstname']." ".$row1['lastname'];
					$fullname = rtrim($fullname," ");
					$message=array("message"=>"User with this Email or Username already exists",'userid'=>$row1['userid'],'username'=>$row1['username'],
							'number'=>$row1['number']=($row1['number']==null)?"":$row1['number'],'socialtype'=>$row1['social_type'],
							'followingcount'=>$followingcount,'followerscount'=>$followerscount,'firstname'=>$row1['firstname'],
							'lastname'=>$row1['lastname'],'logo'=>$logo,'name'=>$fullname,'lastbackup'=>$backup['lastbackup']);
				}
				else
				{
					$data = array('username'=>$username,'password'=>$password,'number'=>$number,
							'social_type'=>$logintype,'firstname'=>$firstname,'lastname'=>$lastname,'profile_pic'=>$logo,'email'=>$email,'devicetoken'=>$devicetoken);
					//mysql insert query
					$sql = $this->db->insert('tbl_users',$data);
					
					if($sql)
					{
						$insert_id = $this->db->insert_id();
						// count for aacks
						$query5=$this->db->query("select * from tbl_aacks where userid = '$insert_id' and status = '1'");
						$aackscount = $query5->num_rows(); 
						$query=$this->db->query("select * from tbl_users where userid='$insert_id'");	
						$row=$query->row_array();
						//success message
						$fullname = $row['firstname']." ".$row['lastname'];
						$fullname = rtrim($fullname," ");
						$pic = base_url('images').'/'.$row['profile_pic'];
						
						// how many users you are following example A->b,c count for A is 2
						$querystring=$this->db->query("select followee from tbl_follow where follower = '$insert_id'");
						$followingcount = $querystring->num_rows();

						//follower count. Means how many users are following you
						$query4=$this->db->query("select follower from tbl_follow where followee = '$insert_id'");
						$followerscount = $query4->num_rows(); 
                        // get datetime of when a user made his messages backup
						$backuptime=$this->db->query("select lastbackup from tbl_backupmessages where userid='$userid'");
						$backup = $backuptime->row_array();
						/* $message=array("message"=>"Successfully Inserted",'userid'=>$row['userid'],'username'=>$row['username'],
						'number'=>$row['number']=($row['number']==null)?"":$row['number'],'followingcount'=>'0','followerscount'=>'0',
						'firstname'=>$row['firstname'],'lastname'=>$row['lastname'],'logo'=>$logo,'name'=>$fullname); */
						
						
						$message=array("message"=>"Successfully Inserted",'userid'=>$row['userid'],'username'=>$row['username'],'fullname'=>$fullname,
						'number'=>$row['number']=($row['number']==null)?"":$row['number'],'socialtype'=>$row['social_type'],
						'followingcount'=>$followingcount,'followerscount'=>$followerscount,'aackscount'=>$aackscount,
						'profilepic'=>$pic=($pic==null)?"":$pic,'email'=>$row1['email'],'lastbackup'=>$backup['lastbackup']);
					}
					else
					{
						//failed message
						$message=array("message"=>"Failed to Insert");
					}
				
				}
			//}
		}
		else
		{
			//message if mandatory fields not given
			$message=array("message"=>"provide values",'username'=>$username,'number'=>$number,'social_type'=>$logintype,'password'=>$password,
			'firstname'=>$fristname,'lastname'=>$lastname,'email'=>$email,'logo'=>$logo);
			
			
			
			 
		}
		echo json_encode($message); 
	}
	
	// login users

	function loginUser($username,$password,$logintype,$devicetoken)
	{
		//mandory fields
		if(!empty($username) && !empty($password) && !empty($logintype))
		{
		
			 // check validation
			$query1=$this->db->query("select * from tbl_users where username='$username' and password='$password' and social_type = '$logintype'");
			$row1=$query1->row_array();
			if($query1->num_rows() > 0)	
			{
				$userid = $row1['userid'];
				// how many users you are following example A->b,c count for A is 2
 				$querystring=$this->db->query("select followee from tbl_follow where follower = '$userid'");
				
				$followingcount = $querystring->num_rows();
				
				//follower count. Means how many users are following you
				
				$query4=$this->db->query("select follower from tbl_follow where followee = '$userid'");
				
				$followerscount = $query4->num_rows(); 
				
				// count for aacks
				$query5=$this->db->query("select * from tbl_aacks where userid = '$userid' and status = '1'");
				
				$aackscount = $query5->num_rows(); 
				// picture
				$pic = base_url('images').'/'.$row1['profile_pic'];
				$fullname = $row1['firstname']." ".$row1['lastname'];
				// remove if any spaces at the end of the word
				$fullname = rtrim($fullname," ");
				// update online_status to 1
				
				$updating = array('online_status' => '1');

				$this->db->where('userid', $userid);
				$this->db->update('tbl_users', $updating);
						$backuptime=$this->db->query("select lastbackup from tbl_backupmessages where userid='$userid'");
						$backup = $backuptime->row_array(); 
				
				$message=array("message"=>"success",'userid'=>$row1['userid'],'username'=>$row1['username'],'fullname'=>$fullname,
						'number'=>$row1['number']=($row1['number']==null)?"":$row1['number'],'socialtype'=>$row1['social_type'],
						'followingcount'=>$followingcount,'followerscount'=>$followerscount,'aackscount'=>$aackscount,
						'profilepic'=>$pic=($pic==null)?"":$pic,'email'=>$row1['email'],'lastbackup'=>$backup['lastbackup']);
			}
			else
			{

					//failed message
					$message=array("message"=>"login failed");

			
			} 
		}
		else
		{
			//message if mandatory fields not given
			$message=array("message"=>"provide values",'username'=>$username,'password'=>$password,'logintype'=>$logintype);
		}
		echo json_encode($message);
	}
	

}

?>