<?php
Class social_model extends CI_Model
{

//addUserFacebook
	function addUserSocial($profilepic,$socialid,$logintype)
	{
	$message=array();
	$profilepic=str_replace('"','',$profilepic);
		//mandory fields
		if(!empty($socialid) && !empty($logintype))
		{
			//insert data
	
			// check validation
			$query1=$this->db->query("select * from tbl_users where socialid='$socialid'");
			$row1=$query1->row_array();
			if($query1->num_rows() > 0)	
			{
				$userid = $row1['userid'];
				$profile_status = $row1['profile_status'];
					if($profile_status == '1')
					{
						$message = array("message"=>"Incomplete profile","profilestatus"=>'1',"userid"=>$userid,"socialid"=>$row1['socialid']);
					}
					elseif($profile_status == '0')
					{
						// how many users you are following example A->b,c count for A is 2
						$querystring=$this->db->query("select followee from tbl_follow where follower = '$userid'");
						
						$followingcount = $querystring->num_rows();
						
						//follower count. Means how many users are following you
						
						$query4=$this->db->query("select follower from tbl_follow where followee = '$userid'");
						
						$followerscount = $query4->num_rows(); 
						// count for aacks
						$query5=$this->db->query("select * from tbl_aacks where userid = '$userid' and status = '1'");
						
						$aackscount = $query5->num_rows(); 
						
						$backuptime=$this->db->query("select lastbackup from tbl_backupmessages where userid='$userid'");
						$backup = $backuptime->row_array(); 
						$fullname = $row1['firstname']." ".$row1['lastname'];
						$fullname = rtrim($fullname," ");
						$message=array("message"=>"User with this email already exists",'userid'=>$row1['userid'],'username'=>$row1['username'],'email'=>$row1['email'],'profilepic'=>$row1['profile_pic'],
								'number'=>$row1['number']=($row1['number']==null)?"":$row1['number'],'socialid'=>$row1['socialid'],'socialtype'=>$row1['social_type'],'devicetoken'=>$row1['devicetoken']=($row1['devicetoken']==null)?"":$row1['devicetoken'],
								'fullname'=>$fullname,'followingcount'=>$followingcount,'followerscount'=>$followerscount,'aackscount'=>$aackscount,
								'profilestatus'=>'0','lastbackup'=>$backup['lastbackup']);
					}
			}
			else
			{
				$data = array('profile_pic'=>$profilepic,'socialid'=>$socialid,'social_type'=>$logintype,'profile_status'=>'1');

				
				//mysql insert query
				$sql = $this->db->insert('tbl_users',$data);
				
				if($sql)
				{
					$insert_id = $this->db->insert_id();
					$query=$this->db->query("select * from tbl_users where userid='$insert_id'");	
					$row=$query->row_array();
					$message=array("message"=>"Successfully Inserted",'userid'=>$row['userid'],'profilepic'=>$row['profile_pic'],
					'socialid'=>$row['socialid'],'socialtype'=>$row['social_type'],'profilestatus'=>$row['profile_status']);
				}
				else
				{
					//failed message
					$message=array("message"=>"Failed to Insert");
				}
			}
			

		}
		else
		{
			//message if mandatory fields not given
			$message=array("message"=>"provide values",'profilepic'=>$profilepic,'socialid'=>$socialid,'social_type'=>$logintype);
		}
		
		echo json_encode($message);
	}
	
	// update 
	
	function updateUser($username,$email,$number,$socialid,$logintype,$firstname,$lastname,$deviceid,$userid)
	{
		if(!empty($username) && !empty($email) && !empty($number) && !empty($socialid) && !empty($logintype) && !empty($firstname) && !empty($lastname))
		{
			$query=$this->db->query("select * from tbl_users where username='$username'"); //  and social_type='$logintype'
			$row=$query->row_array();
			

			$query5=$this->db->query("select * from tbl_users where email='$email' and userid !='$userid'"); //  and social_type='$logintype'
			$row5=$query5->row_array();

			
			
			if($query->num_rows() > 0)	
			{
				$message=array("message"=>"User with this Username already exists");
			}
			elseif($query5->num_rows() > 0)
			{
				$message=array("message"=>"User with this Email already exists");
			}
			else
			{
				if(!empty($deviceid))
				{
				// Database field is 'devicetoken'
				
							$updatequery = $this->db->query("UPDATE tbl_users SET firstname='$firstname',lastname='$lastname'
							,username='$username',email='$email',number='$number' ,profile_status='0' where devicetoken='$deviceid'");
							
							$query1=$this->db->query("select * from tbl_users where devicetoken='$deviceid'");
							$row1=$query1->row_array();
				}
				else
				{
							$updatequery = $this->db->query("UPDATE tbl_users SET firstname='$firstname',lastname='$lastname'
							,username='$username',email='$email',number='$number' ,profile_status='0' where socialid='$socialid' and socialid!='' ");
							
							$query1=$this->db->query("select * from tbl_users where socialid='$socialid'");
							$row1=$query1->row_array();
				}



				if($query1->num_rows() > 0)	
				{
					$userid = $row1['userid'];
					// how many users you are following example A->b,c count for A is 2
					$querystring=$this->db->query("select followee from tbl_follow where follower = '$userid'");

					$followingcount = $querystring->num_rows();

					//follower count. Means how many users are following you

					$query4=$this->db->query("select follower from tbl_follow where followee = '$userid'");

					$followerscount = $query4->num_rows(); 
					$fullname = $row1['firstname']." ".$row1['lastname'];
					$fullname = rtrim($fullname," ");
						$backuptime=$this->db->query("select lastbackup from tbl_backupmessages where userid='$userid'");
						$backup = $backuptime->row_array(); 
					$message=array("message"=>"update success",'userid'=>$row1['userid'],'username'=>$row1['username'],
					'number'=>$row1['number']=($row1['number']==null)?"":$row1['number'],'socialtype'=>$row1['social_type'],
					'followingcount'=>$followingcount,'followerscount'=>$followerscount,'firstname'=>$row1['firstname'],
					'lastname'=>$row1['lastname'],'fullname'=>$fullname,'lastbackup'=>$backup['lastbackup']);
				}
				else
				{
					$message=array("message"=>"update failed");
				}
			}

		}
		else
		{
			$message = array("message"=>"provide values");
		}
		echo json_encode($message);
	}

	
	// test
	
	function testUserSocial($profilepic,$socialid,$logintype,$deviceid)
	{
/* 	$message=array();
	$profilepic=str_replace('"','',$profilepic);
		//mandory fields
		if(!empty($socialid) && !empty($logintype) && !empty($deviceid))
		{
			//insert data
	
			// check validation 2,4,5,6
			if($logintype == '2') // facebook
			{
				$q1 = $this->db->query("select * from tbl_facebook where facebookid = '$socialid'");
			}

			if($logintype == '4') // twitter
			{
				$q1 = $this->db->query("select * from tbl_twitter where twitterid = '$socialid'");
			}
			if($logintype == '5') // instagram
			{
				$q1 = $this->db->query("select * from tbl_instagram where instagramid = '$socialid'");
			}
			
			$c1 = $q1->num_rows();
			$r1 = $q1->row_array();
			// ======= if social id already exists
			if($c1 > '0')
			{
				$q2 = $this->db->query("select * from tbl_social where id = $r1['social_feed_id']");
				$r2 = $q2->row_array();
				$q3 = $this->db->query("select * from tbl_users where userid = $r2['userid']");
				$r3 = $q3->row_array();
				
				if($q3->num_rows() > 0)	
				{
					$userid = $r3['userid'];
					$profile_status = $r3['profile_status'];
						if($profile_status == '1')
						{
							$message = array("message"=>"Incomplete profile","profilestatus"=>'1',"userid"=>$userid,"socialid"=>$r3['socialid']);
						}
						elseif($profile_status == '0')
						{
							// how many users you are following example A->b,c count for A is 2
							$querystring=$this->db->query("select followee from tbl_follow where follower = '$userid'");
							
							$followingcount = $querystring->num_rows();
							
							//follower count. Means how many users are following you
							
							$query4=$this->db->query("select follower from tbl_follow where followee = '$userid'");
							
							$followerscount = $query4->num_rows(); 
							// count for aacks
							$query5=$this->db->query("select * from tbl_aacks where userid = '$userid' and status = '1'");
							
							$aackscount = $query5->num_rows(); 
							$fullname = $r3['firstname']." ".$r3['lastname'];
							$fullname = rtrim($fullname," ");
							$message=array("message"=>"User with this email already exists",'userid'=>$r3['userid'],'username'=>$r3['username'],'email'=>$r3['email'],'profilepic'=>$r3['profile_pic'],
									'number'=>$r3['number']=($r3['number']==null)?"":$r3['number'],'socialid'=>$r3['socialid'],'socialtype'=>$r3['social_type'],'devicetoken'=>$r3['devicetoken']=($r3['devicetoken']==null)?"":$r3['devicetoken'],
									'fullname'=>$fullname,'followingcount'=>$followingcount,'followerscount'=>$followerscount,'aackscount'=>$aackscount,
									'profilestatus'=>'0');
						}
				}
			}
			else
			{
				$dataset1 = array('profile_pic'=>$profilepic,'socialid'=>$socialid,'social_type'=>$logintype,'profile_status'=>'1');
				$q4 = $this->db->insert('tbl_users',$dataset1);
				if($q4)
				{
					$insert_id1 = $this->db->insert_id();// user id is generated here
					$dataset2 = array('social_id'=>$socialid,'userid'=>$insert_id1,'socialtype'=>$logintype);
					$q5 = $this->db->insert('tbl_social',$dataset2);
					if($q5)
					{
						$insert_id2 = $this->db->insert_id(); // social id is generated here
						if($logintype == '2')
						{
							$dataset3 = array('facebook_id'=>$socialid,'social_feed_id'=>$insert_id2);
							$table_name = 'tbl_facebook';
						}
						if($logintype == '4')
						{
							$dataset3 = array('twitter_id'=>$socialid,'social_feed_id'=>$insert_id2);
							$table_name = 'tbl_twitter';
						}
						if($logintype == '5')
						{
							$dataset3 = array('instagram_id'=>$socialid,'social_feed_id'=>$insert_id2);
							$table_name = 'tbl_instagram';
						}
						$q6 = $this->db->insert('$table_name',$dataset3);
						if($q6)
						{
							$q7 = $this->db->query("selet * from tbl_users where userid = '$insert_id1'");
							$r7 = $q7->row_array();
							$message=array("message"=>"Successfully Inserted",'userid'=>$insert_id1,'profilepic'=>$r7['profile_pic'],
					'socialid'=>$r7['socialid'],'socialtype'=>$r7['social_type'],'profilestatus'=>$r7['profile_status']);
						}
						else
						{
							//failed message
							$message=array("message"=>"Failed to Insert");
						}
						
						
					}
					
				}
				
			}
		

		}
		else
		{
			//message if mandatory fields not given
			$message=array("message"=>"provide values",'profilepic'=>$profilepic,'socialid'=>$socialid,'social_type'=>$logintype,'deviceid'=>$deviceid);
		}
		
		echo json_encode($message); */
	}

}
?>
