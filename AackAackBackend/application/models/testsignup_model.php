<?php
Class testsignup_model extends CI_Model
{

	// test
	
	function addUserSocial($profilepic,$socialid,$logintype,$deviceid)
	{
	
 	$message=array();
	$profilepic=str_replace('"','',$profilepic);
		//mandory fields
		if(!empty($socialid) && !empty($logintype) && !empty($deviceid))
		{
				// check validation 2,4,5,6
				if($logintype == '2') // facebook
				{
					$q1 = $this->db->query("select * from tbl_facebook where facebook_id = '$socialid'");
				}

				if($logintype == '4') // twitter
				{
					$q1 = $this->db->query("select * from tbl_twitter where twitter_id = '$socialid'");
				}
				if($logintype == '5') // instagram
				{
					$q1 = $this->db->query("select * from tbl_instagram where instagram_id = '$socialid'");
				}
				
				$c1 = $q1->num_rows();
				$r1 = $q1->row_array();
				//echo $c1;
				//echo $r1['social_feed_id'];
				// ======= if social id already exists
				if($c1 > '0')
				{

					$socialfeed = $r1['social_feed_id'];
				
					$q2 = $this->db->query("SELECT * FROM `tbl_social` WHERE `social_id`=$socialfeed");
					$r2 = $q2->row_array();
					$user = $r2['userid'];
					//echo $user."<br/>";
					$q3 = $this->db->query("select * from tbl_users where `userid` = '$user' and devicetoken='$deviceid'");
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
								// Update profile pic
								//**********************************************************************
								//$updatesql=$this->db->query("UPDATE tbl_users SET profile_pic='$profilepic' where userid='$userid'");
								//**********************************************************************
								$fullname = $r3['firstname']." ".$r3['lastname'];
								$fullname = rtrim($fullname," ");
								$message=array("message"=>"User with this email already exists",'userid'=>$r3['userid'],'username'=>$r3['username'],'email'=>$r3['email'],'profilepic'=>$r3['profile_pic'],
										'number'=>$r3['number']=($r3['number']==null)?"":$r3['number'],'socialid'=>$r3['socialid'],'socialtype'=>$r3['social_type'],'devicetoken'=>$r3['devicetoken']=($r3['devicetoken']==null)?"":$r3['devicetoken'],
										'fullname'=>$fullname,'followingcount'=>$followingcount,'followerscount'=>$followerscount,'aackscount'=>$aackscount,
										'profilestatus'=>'0');
							}
					} 
					else
					{
							$message = array("message"=>"This User is already registered in another device",'userid'=>" ",'username'=>" ",'fullname'=>" ",
									'number'=>" ",'socialtype'=>" ",'followingcount'=>" ",'followerscount'=>" ",'aackscount'=>" ",
									'profilepic'=>" ",'email'=>" ",'socialid'=>" ",
									'lastbackup'=>" ",'profilestatus'=>" ");
						/* $query1=$this->db->query("select * from tbl_users where devicetoken='$deviceid'");
							$row1=$query1->row_array();
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
							
							$message=array("message"=>"User with this email already exists",'userid'=>$row1['userid'],'username'=>$row1['username'],'fullname'=>$fullname,
									'number'=>$row1['number']=($row1['number']==null)?"":$row1['number'],'socialtype'=>$row1['social_type'],
									'followingcount'=>$followingcount,'followerscount'=>$followerscount,'aackscount'=>$aackscount,
									'profilepic'=>$pic=($pic==null)?"":$pic,'email'=>$row1['email'],'socialid'=>$r3['socialid'],
									'lastbackup'=>$backup['lastbackup']=($backup['lastbackup'] == null)?"":$backup['lastbackup'],'profilestatus'=>$row1['profile_status']);  */
					}
				}
				else
				{
					$q9 = $this->db->query("select * from tbl_users where devicetoken='$deviceid'");
					$r9 = $q9->row_array();
					$count9 = $q9->num_rows();
					$userid3 = $r9['userid'];
					//echo $count9;
					if($count9 > '0')
					{
						
						if($r9['social_type'] == '3')
						{
							
							$query1=$this->db->query("select * from tbl_users where social_type = '3' and userid='$userid3'");
							$row1=$query1->row_array();
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
									'profilepic'=>$pic=($pic==null)?"":$pic,'email'=>$row1['email'],
									'lastbackup'=>$backup['lastbackup']=($backup['lastbackup'] == null)?"":$backup['lastbackup'],'profilestatus'=>$row1['profile_status']); 
						}
						elseif($r9['social_type'] == '2' || $r9['social_type'] == '4' || $r9['social_type'] == '5')
						{
							
															// Update profile pic
							//**********************************************************************
							//$updatesql=$this->db->query("UPDATE tbl_users SET profile_pic='$profilepic' where userid='$userid3'");
							//**********************************************************************
								$dataset2 = array('social_Network_id'=>$socialid,'userid'=>$r9['userid'],'socialtype'=>$logintype);
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
									$q6 = $this->db->insert($table_name,$dataset3);
									if($q6)
									{
										$q7 = $this->db->query("select * from tbl_users where userid = $userid3");
										$r7 = $q7->row_array();
										$message=array("message"=>"Successfully Inserted",'userid'=>$r9['userid'],'profilepic'=>$r7['profile_pic'],
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
					else
					{
						//echo "asdasd";
						  $dataset1 = array('profile_pic'=>$profilepic,'socialid'=>$socialid,'social_type'=>$logintype,'profile_status'=>'1','devicetoken'=>$deviceid);
						$q4 = $this->db->insert('tbl_users',$dataset1);
						if($q4)
						{
							$insert_id1 = $this->db->insert_id();// user id is generated here
							$dataset2 = array('social_Network_id'=>$socialid,'userid'=>$insert_id1,'socialtype'=>$logintype);
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
								$q6 = $this->db->insert($table_name,$dataset3);
								if($q6)
								{
									$q7 = $this->db->query("select * from tbl_users where userid = '$insert_id1'");
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
			

			

		}
		else
		{
			//message if mandatory fields not given
			$message=array("message"=>"provide values",'profilepic'=>$profilepic,'socialid'=>$socialid,'social_type'=>$logintype,'deviceid'=>$deviceid);
		}
		
		echo json_encode($message);
	}

}
?>
