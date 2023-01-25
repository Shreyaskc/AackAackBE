<?php
Class api_model extends CI_Model
{

	
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
			if($row1['devicetoken'] == $devicetoken)
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
				$message=array("message"=>"you have login with new device");
				}
				
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
	
	
	
		// updatelogin users

	function updateloginUser($username,$password,$logintype,$devicetoken)
	{
		//mandory fields
		if(!empty($username) && !empty($password) && !empty($logintype))
		{
		
			 // check validation
			$query1=$this->db->query("select * from tbl_users where username='$username' and password='$password' and social_type = '$logintype'");
			$row1=$query1->row_array();
			if($query1->num_rows() > 0)	
			{
					//echo $devicetoken;
					$userid = $row1['userid'];
					$querystring=$this->db->query("UPDATE `tbl_users` SET  `devicetoken` =  '$devicetoken' WHERE  `userid` ='$userid'");
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
	
	//addUserFacebook
	function addUserFacebook($username,$email,$profilepic,$number,$socialid,$logintype,$devicetoken,$devicetype,$firstname,$lastname)
	{
	$message=array();
	$profilepic=str_replace('"','',$profilepic);
		//mandory fields
		if(!empty($email) && !empty($socialid) && !empty($logintype))
		{
			//insert data
	
			// check validation
			$query1=$this->db->query("select * from tbl_users where email='$email'");
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
				$fullname = $row1['firstname']." ".$row1['lastname'];
				$fullname = rtrim($fullname," ");
				$message=array("message"=>"User with this email already exists",'userid'=>$row1['userid'],'username'=>$row1['username'],'email'=>$row1['email'],'profilepic'=>$row1['profile_pic'],
						'number'=>$row1['number']=($row1['number']==null)?"":$row1['number'],'socialid'=>$row1['socialid'],'socialtype'=>$row1['social_type'],'devicetoken'=>$row1['devicetoken']=($row1['devicetoken']==null)?"":$row1['devicetoken'],
						'name'=>$fullname,'followingcount'=>$followingcount,'followerscount'=>$followerscount,'aackscount'=>$aackscount);
						
			}
			else
			{
				$data = array('username'=>$username,'email'=>$email,'profile_pic'=>$profilepic,'number'=>$number,'socialid'=>$socialid,
					'social_type'=>$logintype,'devicetoken'=>$devicetoken,'device_type'=>$devicetype,'firstname'=>$firstname,'lastname'=>$lastname);

				
				//mysql insert query
				$sql = $this->db->insert('tbl_users',$data);
				
				if($sql)
				{
					$insert_id = $this->db->insert_id();
					$query=$this->db->query("select * from tbl_users where userid='$insert_id'");	
					$row=$query->row_array();
					$fullname = $row['firstname']." ".$row['lastname'];
					$fullname = rtrim($fullname," ");
					//success message
					$message=array("message"=>"Successfully Inserted",'userid'=>$row['userid'],'username'=>$row['username'],'email'=>$row['email'],'profilepic'=>$row['profile_pic'],
					'number'=>$row['number']=($row['number']==null)?"":$row['number'],'socialid'=>$row['socialid'],'socialtype'=>$row['social_type'],
					'devicetoken'=>$row['devicetoken']=($row['devicetoken']==null)?"":$row['devicetoken'],'name'=>$fullname,
					'followingcount'=>'0','followerscount'=>'0','aackscount'=>'0');
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
			$message=array("message"=>"provide values",'username'=>$username,'email'=>$email,'profilepic'=>$profilepic,'socialid'=>$socialid,'social_type'=>$logintype);
		}
		
		echo json_encode($message);
	}
	
	// search users
		// Search
	function searchUsers($search,$userid,$start,$devicedatetime)
	{
		
		$message = array();
		$message1 = array();
		if(!empty($userid) && !empty($devicedatetime))
		{
			if(empty($start))
			{
				$start = '0';
			}
			else
			{
				$start = $start;
			}
			// if search is sent give matched records else display all records
			if(empty($search))
			{
/* 			$query = $this->db->query("select * from tbl_users where userid!='$userid' and profile_status='0' 
			and (username != '' or username != NULL) and userid IN (select userid from tbl_aacks where userid!='$userid') limit $start,5"); */
				$query = $this->db->query("SELECT A.* from tbl_users A
				INNER JOIN
				(select aack_id,userid from tbl_aacks where Status='1'  and userid !='$userid' and sharedto != '6' order by aack_id desc ) as B
				ON A.userid=B.userid
				where A.userid !='$userid' and A.profile_status='0'  GROUP BY B.userid order by B.aack_id desc limit $start,5");
			}
			else
			{
/* 			$query = $this->db->query("select * from tbl_users where username like '%$search%' and userid!='$userid' 
			and profile_status='0' and (username != '' or username != NULL) and userid IN (select userid from tbl_aacks where userid!='$userid') limit $start,5"); */
				$query = $this->db->query("SELECT A.* from tbl_users A
				INNER JOIN
				(select aack_id,userid from tbl_aacks where Status='1' and userid !='$userid' and sharedto != '6' order by aack_id desc ) as B
				ON A.userid=B.userid
				where A.username like '%$search%' and A.userid !='$userid' and A.profile_status='0' GROUP BY B.userid order by B.aack_id desc limit $start,5");
			}
			// count
			$querystring=$this->db->query("select followee from tbl_follow where follower = '$userid'");
			$followingcount = $querystring->num_rows();
			
			if($query->num_rows() > 0)
			{
				foreach($query->result() as $value)
				{
				//Adding new code as per new requirement 04-Nov-2013
				//**********************************************************************
				//$aacks_sql = $this->db->query("select * from tbl_aacks where userid = '$value->userid' and status='1' and sharedto !='6'  order by aack_id desc limit 0,1");
				$aacks_sql = $this->db->query("(select *,case when (select count(tr.AackId) from tbl_reshares tr where tr.AackId=ta.aack_id) > 0 then 'reshare' else 'myshare' end as sharetype from tbl_aacks ta where ta.userid = '$value->userid' and ta.status='1' and ta.sharedto !='6')
UNION ALL
(select ta.aack_id,ta.userid,ta.conversation_with,ta.lastmessage,ta.aack_content,ta.thumbnail,ta.aack_caption,ta.conversation_from,ta.screen_look,tr.SharedTo as sharedto,ta.status,tr.devicedatetime as devicedatetime,tr.CreatedDate as created_date,'reshare' as sharetype from tbl_reshares tr inner join tbl_aacks ta  on ta.aack_id=tr.AackId where ta.userid = '$value->userid' and ta.status='1' and ta.sharedto !='6')
order by created_date desc limit 0,1");
				
				$aacksdata = $aacks_sql->row_array();
		
				$q23 =  $this->db->query("select ReshareId from tbl_reshares where UserId='$userid' and AackId='$aacksdata[aack_id]'");
				$reshareStatus = ($q23->num_rows()>0)?true:false;
				
				//to check the login user following other users or not
				$followquery=$this->db->query("select * from tbl_follow where follower = '$userid' and followee='$value->userid'");
				$followcount=$followquery->num_rows();
				if($followcount>0)
				{
					$followstatus="follow";
				}
				else
				{
					$followstatus="unfollow";
				}
				
								
				//**********************************************************************
						if($value->social_type == '2' || $value->social_type == '5' || $value->social_type == '4' || $value->social_type == '6')
						{
								if (strpos($value->profile_pic,'http:') !== false || strpos($value->profile_pic,'https:') !== false)
								{
									$pic =$value->profile_pic;
								}
								else
								{
									$pic = base_url('images').'/'.$value->profile_pic;	
								}
							//$pic = $value->profile_pic;
							
						}
						else if($value->social_type == '3')// general login so provide path to image
						{
							$pic = base_url('images').'/'.$value->profile_pic;
							
						}
						$fullname = $value->firstname." ".$value->lastname;
						$fullname = rtrim($fullname," ");
						
						// interval calculation 
						$date1 = $aacksdata['created_date'];
						$date2  = date('Y-m-d H:i:s');						
						$resultdate = $this->datedifference($date1,$date2);
						if($aacksdata['thumbnail'])
						{
						$aackthumb = base_url('aack_thumbs').'/'.$aacksdata['thumbnail'];
						$aackurl = base_url('aacks').'/'.$aacksdata['aack_content'];
						}
						else
						{
							$aackthumb = "";
							$aackurl ="";
						}


							$message1[] = array("userid"=>$value->userid,"followstatus"=>$followstatus,"username"=>$value->username,"email"=>$value->email,"profilepic"=>$pic,
							"nickname"=>$fullname,"number"=>$value->number,"onlinestatus"=>$value->online_status,"createddate"=>$value->created_date,"reshareStatus" => $reshareStatus,
							"aackid"=>$aacksdata['aack_id']=($aacksdata['aack_id'] == null)?"":$aacksdata['aack_id'],"conversationfrom"=>$aacksdata['conversation_from']=($aacksdata['conversation_from']==null)?"":$aacksdata['conversation_from'],"caption"=>$aacksdata['aack_caption']=($aacksdata['aack_caption'] == null)?"":$aacksdata['aack_caption'],
							"aackthumb"=>$aackthumb,"aackimage"=>$aackurl,"datetime"=>$resultdate,"sharetype"=>$aacksdata['sharetype']);

				}
				
			}
				$message = array("followingcount"=>$followingcount,"users"=>$message1);
		}
		else
		{
			$message = array("message"=>"provide values","devicedatetime"=>$devicedatetime);
		}
		echo json_encode($message);
	}
	
	//getfollowstatus
	function  getFollowStatus($followerid,$followee_id)
	{
		if(!empty($followerid) && !empty($followee_id))
		{
			$query=$this->db->query("select * from tbl_follow where follower='$followerid' and followee='$followee_id'");
			if($query->num_rows()>0)
			{
				$followstatus="follow";
			}
			else
			{
				$followstatus="unfollow";
			}
			$message=array("followstatus"=>$followstatus);
		}
		else
		{
			$message=array("message"=>"provide values");
		}
		echo json_encode($message);
		
	}
	
	// add followers data insert query
	function addFollow($followerid,$followee_id)
	{
		if(!empty($followerid) && !empty($followee_id))
		{
			$query3 = $this->db->query("select * from tbl_users where userid='$followee_id'");
			$row3 = $query3->row_array();
			$name = $row3['username'];
			$query1=$this->db->query("select * from tbl_follow where follower='$followerid' and followee='$followee_id'");
			if($query1->num_rows() > 0)
			{

				$message=array("message"=>"You are already following "."@"."$name");
			}
			else
			{
			$data = array('follower'=>$followerid,'followee'=>$followee_id);
			$sql = $this->db->insert('tbl_follow',$data);
			if($sql)
			{
			 	$querystring=$this->db->query("select follower from tbl_follow where followee = '$followee_id'");
				//$last=$this->db->last_query();
				$followercount = $querystring->num_rows();
				
			$message=array("message"=>"You are now following "."@"."$name","followercount"=>$followercount);
			}
			else
			{
			$message=array("message"=>"failed to add");
			}
			}
 
		}
		else
		{
			$message=array("message"=>"provide values");
		}
		echo json_encode($message);
	}
	
	// unFollow users
 	function unFollow($followerid,$followee_id)
	{
		if(!empty($followerid) && !empty($followee_id))
		{
		$query1 = $this->db->delete('tbl_follow', array('follower' => $followerid,'followee'=>$followee_id)); 
				$querystring=$this->db->query("select follower from tbl_follow where followee = '$followee_id'");
				//$last=$this->db->last_query();
				$followercount = $querystring->num_rows();
				// here we are giving count of followeeid as developers are on followeeid's profile screen
				
			
			$message=array("message"=>"successfully removed","followercount"=>strval($followercount));
		}
		else
		{
			$message=array("message"=>"provide values");
		}
		echo json_encode($message);
	} 
	
	// add Messages
	function addMessage($fromuser,$touser,$messagebody)
	{
		if(!empty($fromuser) && !empty($touser) && !empty($messagebody))
		{
			$data =array('from_id'=>$fromuser,'to_id'=>$touser,'message_body'=>$messagebody);
			
			$sql=$this->db->insert('tbl_messages',$data);
			if($sql)
			{
				$message=array("message"=>"inserted successfully");
			}
			else
			{
				$message=array("message"=>"insertion failed");
			}
		}
		else
		{
			$message = array("message"=>"provide values");
		}
		echo json_encode($message);
	}
	
	// get messages of all users you follow
/* 	function getMessageufollow($userid,$devicedatetime,$start)
	{
		$message=array();
		$message1=array();
		if(!empty($userid))
		{
		if($start == '')
		{
			$start = '0';
		}
		else
		{
			$start = $start;
		}
		
			$qq1=$this->db->query("select followee from tbl_follow where follower = '$userid'");// one who logged in will be follower
			$followingcount = $qq1->num_rows();// how many users you are following example A->b,c count for A is 2
		// SELECT * FROM `tbl_aacks` having max(aack_id)
		
		$query1 = $this->db->query("select A.* from tbl_aacks A 
									join(
									select max(aack_id) as aack_id,userid from tbl_aacks where status='1'
									and 
									userid IN (select followee from tbl_follow where follower = '$userid')
									group by userid
									)
									B on A.userid = B.userid and A.aack_id = B.aack_id and A.status='1' order by A.aack_id desc limit $start,10");*/
		/*
		select * from tbl_aacks where status='1' and userid IN(select followee from tbl_follow where follower = '$userid')
		order by aack_id desc limit $start,10"
		   

		*/

		/*$row1 = $query1->result();
		

			if($query1->num_rows() > 0)
			{
				foreach($row1 as $value)
				{
					$query5 = $this->db->query("select * from tbl_aacks where aack_id = '$value->aack_id'");
					$res5   = $query5->row_array();
					//echo "select * from tbl_aacks where aack_id = $value->aack_id"."<br/>";
					$user = $res5['userid']."<br/>";
					//echo "select * from tbl_users where userid=$user";
					
						$query3 = $this->db->query("select * from tbl_users where userid='$user'");
						$row3 = $query3->row_array();
						// pics
						if($row3['social_type'] == '2' || $row3['social_type'] == '4' || $row3['social_type'] == '5' || $row3['social_type'] == '6')
						{
							$pic = $row3['profile_pic'];
							
						}
						else if($row3['social_type'] == '3')// general login so provide path to image
						{
							$pic = base_url('images').'/'.$row3['profile_pic'];
							
						}
						// interval calculation 
						$date1 = $res5['devicedatetime'];
						$date2  = str_replace("%20"," ",$devicedatetime);
						$resultdate = $this->datedifference($date1,$date2);
						$aackimageurl = base_url('aacks').'/'.$res5['aack_content'];
						$fullname = $row3['firstname']." ".$row3['lastname'];
						$fullname = rtrim($fullname," "); 
						$message1[]=array('aackid'=>$res5['aack_id'],'userid'=>$res5['userid'],'userpic'=>$pic,'username'=>$row3['username']
						,'nickname'=>$fullname,'caption'=>$res5['aack_caption'],'aackdate'=>$resultdate=($resultdate==null)?"":$resultdate,
						"aackcontent"=>$aackimageurl); 
						
					
					
				}
				
			}
			$message=array('followingcount'=>$followingcount,'useraacks'=>$message1);
		}
		else
		{
			$message=array("message"=>"provide values");
		}
		echo json_encode($message);
	
	} */
	//********************************************************************
		// get messages of all users you follow
	function getMessageufollow($userid,$devicedatetime,$start)
	{   
		$message=array();
		$message1=array();
		if(!empty($userid))
		{
		if($start == '')
		{
			$start = '0';
		}
		else
		{
			$start = $start;
		}
		   
			$qq1=$this->db->query("select followee from tbl_follow where follower = '$userid'");// one who logged in will be follower
			$followingcount = $qq1->num_rows();// how many users you are following example A->b,c count for A is 2
		// SELECT * FROM `tbl_aacks` having max(aack_id)
		
		$query1 = $this->db->query("(select ta.*,case when (select count(tr.AackId) from tbl_reshares tr where tr.AackId=ta.aack_id) > 0 then 'reshare' else 'myshare' end as sharetype from tbl_aacks ta where ta.status='1' and ta.sharedto!='6' 
and (userid IN(select followee from tbl_follow where follower = '$userid') or userid = '$userid'))
UNION ALL
(select ta.aack_id,ta.userid,ta.conversation_with,ta.lastmessage,ta.aack_content,ta.thumbnail,ta.aack_caption,ta.conversation_from,ta.screen_look,tr.SharedTo as sharedto,ta.status,tr.devicedatetime as devicedatetime,tr.CreatedDate as created_date,'reshare' as sharetype from tbl_reshares tr inner join tbl_aacks ta  on ta.aack_id=tr.AackId where tr.UserId='$userid' and ta.Status='1' and tr.SharedTo NOT IN (0,6))
ORDER BY devicedatetime desc LIMIT $start,10");
		/*
		Client told to show all aacks instead of lates aacks 2013-11-19 So commented query is
				$query1 = $this->db->query("select A.* from tbl_aacks A 
									join(
									select max(aack_id) as aack_id,userid from tbl_aacks where status='1'
									and 
									userid IN (select followee from tbl_follow where follower = '$userid')
									group by userid
									)
									B on A.userid = B.userid and A.aack_id = B.aack_id and A.status='1' order by A.aack_id desc limit $start,10");
		
		*/
		/*
		select * from tbl_aacks where status='1' and userid IN(select followee from tbl_follow where follower = '$userid')
		order by aack_id desc limit $start,10"
		   

		*/

		$row1 = $query1->result();
		

			if($query1->num_rows() > 0)
			{
				foreach($row1 as $value)
				{ 
					$q23 =  $this->db->query("select ReshareId from tbl_reshares where UserId='$userid' and AackId='$value->aack_id'");
					$reshareStatus = ($q23->num_rows()>0)?true:false;
					//echo "select * from tbl_aacks where aack_id = $value->aack_id"."<br/>";
					$user =  $value->userid;
					//echo "select * from tbl_users where userid=$user";
					
						$query3 = $this->db->query("select * from tbl_users where userid='$user'");
						$row3 = $query3->row_array();
						// pics
						if($row3['social_type'] == '2' || $row3['social_type'] == '4' || $row3['social_type'] == '5' || $row3['social_type'] == '6')
						{
								if (strpos($row3['profile_pic'],'http:') !== false || strpos($row3['profile_pic'],'https:') !== false)
								{
									$pic =$row3['profile_pic'];
								}
								else
								{
									$pic = base_url('images').'/'.$row3['profile_pic'];	
								}
							//$pic = $row3['profile_pic'];
							
						}
						else if($row3['social_type'] == '3')// general login so provide path to image
						{
							$pic = base_url('images').'/'.$row3['profile_pic'];
							
						}
						// interval calculation 
						$date1 = $value->created_date;
						//$date2  = str_replace("%20"," ",$devicedatetime);
						$date2  = date('Y-m-d H:i:s');
						$resultdate = $this->datedifference($date1,$date2);
						$aackimageurl = base_url('aacks').'/'.$value->aack_content;
						$aackthumburl = base_url('aack_thumbs').'/'.$value->thumbnail;
						$fullname = $row3['firstname']." ".$row3['lastname'];
						$fullname = rtrim($fullname," "); 
						//*********
						// like status
						//********
						$aackid = $value->aack_id;
						$likestats = $this->db->query("select * from tbl_likes where aack_id=$aackid and userid='$userid'");
						$reslikes = $likestats->num_rows();
						if($reslikes > '0')
						{
							$likestatus = '1';
						}
						else
						{
							$likestatus = '0';
						}
						$message1[]=array('aackid'=>$value->aack_id,'userid'=>$value->userid,'userpic'=>$pic,'username'=>$row3['username'],"sharetype"=>$value->sharetype,
						'nickname'=>$fullname,'caption'=>$value->aack_caption,'aackdate'=>$resultdate=($resultdate==null)?"":$resultdate,"reshareStatus" => $reshareStatus,
						"aackcontent"=>$aackimageurl,"aackthumb"=>$aackthumburl,"conversation"=>$value->conversation_from,"likestatus"=>$likestatus); 
						
					
					
				}
				
			}
			$message=array('followingcount'=>$followingcount,'useraacks'=>$message1);
		}
		else
		{
			$message=array("message"=>"provide values");
		}
		echo json_encode($message);
	
	}
	
	function del_reshare($userid,$aackid)
	{
		if(!empty($userid) && !empty($aackid))
		{
			$this->db->query("delete from tbl_reshares where UserId='$userid' and AackId='$aackid'");
			$message=array('message'=>'Deleted Successfully');
		}
		else
			$message=array("message"=>"provide values");
		
		echo json_encode($message);
	}
	
	//********************************************************************
		// get messages of all users you follow
 	/*function getMessageufollow($userid,$devicedatetime,$start)
	{
		$message=array();
		$message1=array();
		if(!empty($userid))
		{
		if($start == '')
		{
			$start = '0';
		}
		else
		{
			$start = $start;
		}
		
			$qq1=$this->db->query("select followee from tbl_follow where follower = '$userid'");// one who logged in will be follower
			$followingcount = $qq1->num_rows();// how many users you are following example A->b,c count for A is 2
		// SELECT * FROM `tbl_aacks` having max(aack_id)
		
		$query1 = $this->db->query("select * from tbl_users where userid in (select followee from tbl_follow where follower='$userid')
									and profile_status='0' limit $start,10");


		$row1 = $query1->result();
		

			if($query1->num_rows() > 0)
			{
				foreach($row1 as $value)
				{
					$user = $value->userid;
						// pics
						if($value->social_type == '2' || $value->social_type == '4' || $value->social_type == '5' || $value->social_type == '6')
						{
							$pic = $value->profile_pic;
							
						}
						else if($value->social_type == '3')// general login so provide path to image
						{
							$pic = base_url('images').'/'.$value->profile_pic;
							
						}
						$aack = $this->db->query("select * from tbl_aacks where aack_id 
												IN (select max(aack_id) from tbl_aacks where userid='$user' and status='1')
												and userid='$user'");
						$row2 = $aack->row_array();
						$count = $aack->num_rows();
						// interval calculation 
 						$date1 = $row2['devicedatetime'];
						$date2  = str_replace("%20"," ",$devicedatetime);
						if($count > 0)
						{
							$resultdate = $this->datedifference($date1,$date2);
						}
						elseif($count == '0')
						{
							$resultdate = ""; 
						}
						
						$fullname = $value->firstname." ".$value->lastname;
						$fullname = rtrim($fullname," "); 
						$message1[]=array('userid'=>$value->userid,'userpic'=>$pic,'username'=>$value->username,'nickname'=>$fullname,
						'aackdate'=>$resultdate=($resultdate==null)?"":$resultdate); 
	
				}
				
			}
			$message=array('followingcount'=>$followingcount,'useraacks'=>$message1);
		}
		else
		{
			$message=array("message"=>"provide values");
		}
		echo json_encode($message);
	
	}*/ 
	//********************************************************************
	
	//===============
	//backing up messages
		//service shifted to another class backupapi
	
	// get all latest messages
	function getMessages($userid,$devicedatetime,$start)
	{
		$message=array();
		if(!empty($userid))
		{
				if($start == '')
				{
					$start = '0';
				}
				else
				{
					$start = $start;
				}
				$q = "	SELECT t1.* FROM tbl_backupmessages t1
					JOIN 
					(SELECT number, MAX(message_datetime) message_datetime FROM tbl_backupmessages where userid = '$userid'	GROUP BY number) t2
					ON t1.number = t2.number AND t1.message_datetime = t2.message_datetime 
					where userid = '$userid' GROUP BY t2.message_datetime order by message_datetime desc limit $start,20";
			//	echo $q;
			$query = $this->db->query($q);
					
			/*select * from tbl_backupmessages where message_datetime IN
			(SELECT MAX(message_datetime) FROM tbl_backupmessages where userid='$userid' GROUP BY number order by message_datetime desc) 
			and userid='$userid' order by message_datetime desc limit $start,20*/
			//select * from tbl_backupmessages where userid='$userid' group by number order by message_datetime desc
			$res = $query->result();
			$count = $query->num_rows();
			
			foreach($res as $value)
			{	
				$query1 = $this->db->query("select * from tbl_users where number='$value->number'");
				$res1 = $query1->row_array();
				//echo "select * from tbl_users where number='$value->number'";
				$countusers = $query1->num_rows();

					if(($res1['social_type'] == '2' || $res1['social_type'] == '4' || $res1['social_type'] == '5' || $res1['social_type'] == '6') && $countusers > 0)
					{
								if (strpos($res1['profile_pic'],'http:') !== false || strpos($res1['profile_pic'],'https:') !== false)
								{
									$pic =$res1['profile_pic'];
								}
								else
								{
									$pic = base_url('images').'/'.$res1['profile_pic'];	
								}
						//$pic = $res1['profile_pic'];
						
					}
					else if($res1['social_type'] == '3' && $countusers > 0)// general login so provide path to image
					{
						$pic = base_url('images').'/'.$res1['profile_pic'];
						
					}
					elseif($countusers == 0)
					{
						$pic = "";
					}
					// interval calculation 
					$date1 = $value->message_datetime;
					$date2  = $devicedatetime;
					$resultdate = $this->datedifference($date1,$date2);
					//========================

					$fullname = $res1['firstname']." ".$res1['lastname'];
					$fullname = rtrim($fullname," ");
					$phonenumber=$value->number;
					//$media = $value->media;
					if(!empty($value->media))
					{
						$media = base_url('multimedia').'/'.$value->media;
					}			
					else
					{
						$media = " ";
					}
				 $message[]=array("backupid"=>$value->backup_id,"userid"=>$value->userid,"username"=>$value->username=($value->username==null)?$phonenumber:$value->username,"number"=>$value->number,
				"message"=>$value->messages,"type"=>$value->type,"message_datetime"=>$resultdate=($resultdate==null)?"":$resultdate,"created_date"=>$value->created_date,
				"logo"=>$pic=($pic == null)?"":$pic,"media"=>$media,"mmstext"=>$value->sms=($value->sms == null)?"":$value->sms,
				'fullname'=>$fullname=($fullname==null)?"No Name":$fullname,"messagetype"=>$value->messagetype=($value->messagetype == null)?"":$value->messagetype);
				

				
			}
		}
		else
		{
			$message = array("message"=>"provide values","userid"=>$userid);
		}
		echo json_encode($message);
	}
	
	// get entire chat or message body
	function getMessageBody($userid,$number)
	{
		$message=array();

		if(!empty($userid) && !empty($number))
		{
			$query = $this->db->query("select * from tbl_backupmessages where (userid='$userid' and number='$number') order by message_datetime");
			$res = $query->result();
			$count = $query->num_rows();
			
			foreach($res as $value)
			{	
				if(!empty($value->media))
				{
				$media = base_url('multimedia').'/'.$value->media;
				}			
				else
				{
				$media = " ";
				}
			$messagedate = $value->message_datetime;
				$message[]=array("messagetype"=>$value->messagetype=($value->messagetype == null)?"":$value->messagetype,"backupid"=>$value->backup_id,"userid"=>$value->userid,"username"=>$value->username=($value->username==null)?"No Name":$value->username,"number"=>$value->number,
				"message"=>$value->messages,"type"=>$value->type,"message_datetime"=>$messagedate,"media"=>$media,"mmstext"=>$value->sms=($value->sms == null)?"":$value->sms,
				"created_date"=>$value->created_date);
			}
		}
		else
		{
			$message = array("message"=>"provide values","userid"=>$userid,"number"=>$number);
		}
		echo json_encode($message);
	}
//-----------------------------------------------------------------------------------------------------------------------------------------
//test services 
//-----------------------------------------------------------------------------------------------------------------------------------------	

// login
	// General login test
	function testaddUserSample($username,$password,$number,$logintype,$firstname,$lastname,$logo,$email,$devicetoken)
	{
		//echo "asdsad";
		//mandory fields
		if(!empty($username) && !empty($password) && !empty($firstname) && !empty($lastname) && !empty($logintype) && !empty($email) && !empty($logo) && !empty($number))
		{
			// check validation
			$devicecheck = $this->db->query("select * from tbl_users where devicetoken = '$devicetoken'");
			$countdevices = $devicecheck->num_rows();
			if($countdevices > '0')
			{
				$message = array("message"=>"device already registered");
			}
			else
			{
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
						$query=$this->db->query("select * from tbl_users where userid='$insert_id'");	
						$row=$query->row_array();
						//success message
						$fullname = $row['firstname']." ".$row['lastname'];
						$fullname = rtrim($fullname," ");
						$message=array("message"=>"Successfully Inserted",'userid'=>$row['userid'],'username'=>$row['username'],
						'number'=>$row['number']=($row['number']==null)?"":$row['number'],'followingcount'=>'0','followerscount'=>'0',
						'firstname'=>$row['firstname'],'lastname'=>$row['lastname'],'logo'=>$logo,'name'=>$fullname);
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
			//message if mandatory fields not given
			$message=array("message"=>"provide values",'username'=>$username,'number'=>$number,'social_type'=>$logintype,'password'=>$password,
			'firstname'=>$fristname,'lastname'=>$lastname,'email'=>$email,'logo'=>$logo);
			
			
			
			 
		}
		echo json_encode($message); 
	}
	
	// adding aacks
	function addAack($userid,$aackimage,$devicedatetime,$number,$lastmessage,$aackthumb)
	{
		if(!empty($userid) && !empty($aackimage))
		{
			$time = str_replace("%20"," ",$devicedatetime);
			
			$data=array('userid'=>$userid,'aack_content'=>$aackimage,'devicedatetime'=>$time,'conversation_with'=>$number,
			'lastmessage'=>$lastmessage,'thumbnail'=>$aackthumb);
			$sql = $this->db->insert('tbl_aacks',$data);
			
			
			if($sql)
			{
				$select = $this->db->query("select * from tbl_users where userid='$userid'");
				$res = $select->row_array();
				
				$select1 = $this->db->query("SELECT MAX(aack_id) as insert_id FROM tbl_aacks WHERE  userid='$userid'");
				$res1 = $select1->row_array();
				$insert_id = $res1['insert_id'];
				log_message('error', 'return id '.$insert_id);
				// get aack url
				$select1 = $this->db->query("select * from tbl_aacks where aack_id='$insert_id'");
				$res1 = $select1->row_array();
				$aackurl = base_url('aacks').'/'.$res1['aack_content'];
				
				
				$picture = $res['profile_pic'];
				if($res['social_type'] == '2' || $res['social_type'] == '4' || $res['social_type'] == '5' || $res['social_type'] == '6')
				{
								if (strpos($picture,'http:') !== false || strpos($picture,'https:') !== false)
								{
									$pic =$picture;
								}
								else
								{
									$pic = base_url('images').'/'.$picture;	
								}
					//$pic = $picture;
				}
				elseif($res['profile_pic'] == '3')
				{
				// general login users so image will be from server
					$pic = base_url('images').'/'.$res['profile_pic'];
				}
				
				$message=array("message"=>"success","aackid"=>$insert_id,"email"=>$res['email'],"username"=>$res['username'],
				"pic"=>$pic,"socialtype"=>$res['social_type'],'aackurl'=>$aackurl,'devicedatetime'=>$devicedatetime);
			}
			else
			{
				$message=array("message"=>"insertion failed");
			}
			
		}
		else
		{
			$message=array("message"=>"provide values","userid"=>$userid,"aackimage"=>$aackimage,'devicedatetime'=>$devicedatetime,'number'=>$number);
		}
		
		echo json_encode($message);
		
	}
	/*
	This screen is used for sharing aacks to social media or make the aack as fav. 
	so we are using the same service for all means
	Sharedto = 1(Facebook)
	Sharedto = 2(twitter)
	Sharedto = 3(tumblr)
	Sharedto = 4(reddit)
	Sharedto = 5(email)
	Sharedto = 6(Fav4MeOnlyl)
	
	if shared to is 6 then it is made fav. So while retrieving the aacks for fav, we must give the check for sharedto column as 6 in our query

	*/
	// finction for share aacks
	function shareAack($userid,$aackid,$caption,$conversation,$screenlook,$sharedto)
	{
		if(!empty($userid) && !empty($aackid) && !empty($caption) && !empty($conversation) && !empty($screenlook) && !empty($sharedto))
		{
			$select = $this->db->query("select aack_content from tbl_aacks where userid='$userid' and aack_id='$aackid'");
			$res = $select->row_array();
			$aackimageurl = base_url('aacks').'/'.$res['aack_content'];
			
			$updateSet = array('aack_caption'=>$caption,'conversation_from'=>$conversation
			,'screen_look'=>$screenlook,'sharedto'=>$sharedto,'status'=>'1');
					$this->db->where('userid', $userid);
					$this->db->where('aack_id', $aackid);
					$this->db->update('tbl_aacks', $updateSet);
			//$data = array('aack_caption'=>$caption,'conversation_from'=>$conversation,'screen_look'=>$screenlook,'sharedto'=>$sharedto);
			/* $updatequery = $this->db->query("UPDATE tbl_aacks SET aack_caption='$caption',conversation_from='$conversation'
			,screen_look='$screenlook',sharedto='$sharedto',status='1' where userid='$userid' and aack_id='$aackid'"); */
			$message = array("message"=>"update success","aackimageurl"=>$aackimageurl);
		}
		else
		{
			$message = array("message"=>"provide values","userid"=>$userid,"aackid"=>$aackid,"caption"=>$caption,"conversation"=>$conversation,
			"screenlook"=>$screenlook,"screenlook"=>$screenlook,"sharedto"=>$sharedto);
		}
		echo json_encode($message);
	}
	
	
	function reshareAack($userid,$aackid,$sharedto,$date)
	{
		if(!empty($userid) && !empty($aackid) && !empty($sharedto) && !empty($date))
		{
		  $data = array('UserId' =>  $userid, 'AackId' => $aackid , 'SharedTo' => $sharedto, 'DeviceDateTime'=>$date);
		  $this->db->insert('tbl_reshares', $data); 
		  $message = array("message"=>"update success");
		}
		else
		{
			$message = array("message"=>"provide values","userid"=>$userid,"aackid"=>$aackid,
			"sharedto"=>$sharedto);
		}
		echo json_encode($message);
	}
	

function testgetAllMsgs()
{
	$query = $this->db->query("select * from tbl_backupmessages");
	$res = $query->result();
	$count = $query->num_rows();

			foreach($res as $value)
			{	
				$query1 = $this->db->query("select * from tbl_users where number='$value->number'");
				$res1 = $query1->row_array();
				//echo "select * from tbl_users where number='$value->number'";
				$countusers = $query1->num_rows();

					if(($res1['social_type'] == '2' || $res1['social_type'] == '4' || $res1['social_type'] == '5' || $res1['social_type'] == '6') && $countusers > 0)
					{
						//$pic = $res1['profile_pic'];
								if (strpos($res1['profile_pic'],'http:') !== false || strpos($res1['profile_pic'],'https:') !== false)
								{
									$pic =$res1['profile_pic'];
								}
								else
								{
									$pic = base_url('images').'/'.$res1['profile_pic'];	
								}
						
					}
					else if($res1['social_type'] == '3' && $countusers > 0)// general login so provide path to image
					{
						$pic = base_url('images').'/'.$res1['profile_pic'];
						
					}
					elseif($countusers == 0)
					{
						$pic = "";
					}
					// interval calculation 
					$date1 = $value->message_datetime;
					$date2  = $devicedatetime;
					$resultdate = $this->datedifference($date1,$date2);
					//========================


					
				$message[]=array("backupid"=>$value->backup_id,"userid"=>$value->userid,"username"=>$value->username=($value->username==null)?"No Name":$value->username,"number"=>$value->number,
				"message"=>$value->messages,"type"=>$value->type,"message_datetime"=>$resultdate=($resultdate==null)?"":$resultdate,
				"created_date"=>$value->created_date,"logo"=>$pic=($pic == null)?"":$pic,"mmstext"=>$value->sms);
				

				
			}

			//$message[]=array("backupid"=>1,"userid"=>2,"username"=>"No Name","number"=>100,
			//	"message"=>"hello","mmstext"=>"Hi there.");

		echo json_encode($message);
}

	// test messages
	// get all latest messages
	function testgetMessages($userid,$devicedatetime)
	{
		$message=array();
		if(!empty($userid))
		{
			$query = $this->db->query("select * from tbl_backupmessages where userid='$userid' group by number order by message_datetime desc");
			$res = $query->result();
			$count = $query->num_rows();
			
			foreach($res as $value)
			{	
				$query1 = $this->db->query("select * from tbl_users where number='$value->number'");
				$res1 = $query1->row_array();
				//echo "select * from tbl_users where number='$value->number'";
				$countusers = $query1->num_rows();

					if(($res1['social_type'] == '2' || $res1['social_type'] == '4' || $res1['social_type'] == '5' || $res1['social_type'] == '6') && $countusers > 0)
					{
						//$pic = $res1['profile_pic'];
								if (strpos($res1['profile_pic'],'http:') !== false || strpos($res1['profile_pic'],'https:') !== false)
								{
									$pic =$res1['profile_pic'];
								}
								else
								{
									$pic = base_url('images').'/'.$res1['profile_pic'];	
								}
						
					}
					else if($res1['social_type'] == '3' && $countusers > 0)// general login so provide path to image
					{
						$pic = base_url('images').'/'.$res1['profile_pic'];
						
					}
					elseif($countusers == 0)
					{
						$pic = "";
					}
					// interval calculation 
					$date1 = $value->message_datetime;
					$date2  = $devicedatetime;
					$resultdate = $this->datedifference($date1,$date2);
					//========================


					
				$message[]=array("backupid"=>$value->backup_id,"userid"=>$value->userid,"username"=>$value->username=($value->username==null)?"No Name":$value->username,"number"=>$value->number,
				"message"=>$value->messages,"type"=>$value->type,"message_datetime"=>$resultdate=($resultdate==null)?"":$resultdate,
				"created_date"=>$value->created_date,"logo"=>$pic=($pic == null)?"":$pic,"mmstext"=>$value->sms);
				

				
			}
		}
		else
		{
			$message = array("message"=>"provide values","userid"=>$userid);
		}
		echo json_encode($message);
	}
	
	// log out 
	function logOut($userid)
	{
		if(!empty($userid) || $userid != null)
		{
			$data = array('online_status' => '0');

			$this->db->where('userid', $userid);
			$this->db->update('tbl_users', $data);
			$message=array("message"=>"Logout Success");
		}
		else
		{
			$message=array("message"=>"Provide Values","userid"=>$userid);
		}
		echo json_encode($message);
	}
	
	// profile
	function profile($userid,$devicedatetime,$start,$userid2)
	{
		if(!empty($userid) && !empty($devicedatetime))
		{
			$message=array();
			$message1=array();
		if($start == '')
		{
			$start = '0';
		}
		else
		{
			$start = $start;
		} 
			$qry1 = $this->db->query("select * from tbl_users where userid = '$userid'");
			$row1 = $qry1->row_array();
			
			//userid=profile being viewed 
			//userid2=logged in user
			
			//follower status between logged in user and  profile view user
			$f1=$this->db->query("select follow_id from tbl_follow where follower='$userid' and followee='$userid2'");
			
			//following status
			$f2=$this->db->query("select follow_id from tbl_follow where follower='$userid2' and followee='$userid'");
			if($f1->num_rows()>0 && $f2->num_rows()>0)
			{
			$status='both';
			}
			else if($f1->num_rows()>0 && $f2->num_rows()==0)
			{
			$status='follower';
			}
			else if($f1->num_rows()==0 && $f2->num_rows()>0)
			{
			$status='followee';
			}
			else
			{
			$status='none';
			}
			// how many users you are following
				$querystring=$this->db->query("select followee from tbl_follow where follower = '$userid'");
				$followingcount = $querystring->num_rows();
				
				//follower count. Means how many users are following you
				
				$query4=$this->db->query("select follower from tbl_follow where followee = '$userid'");
				$followerscount = $query4->num_rows(); 
				// count for aacks
				$query5=$this->db->query("(select aack_id from tbl_aacks  where userid='$userid' and status='1' and sharedto NOT IN (0,6)) 
UNION ALL
(select ta.aack_id from tbl_reshares tr inner join tbl_aacks ta  on ta.aack_id=tr.AackId where tr.UserId='$userid' and ta.Status='1' and tr.SharedTo NOT IN (0,6))
");

				$aackscount = $query5->num_rows(); 
				
				$fullname = $row1['firstname']." ".$row1['lastname'];
				$fullname = rtrim($fullname," ");
				
					if($row1['social_type'] == '2' || $row1['social_type'] == '4' || $row1['social_type'] == '5' || $row1['social_type'] == '6')
					{
								if (strpos($row1['profile_pic'],'http:') !== false || strpos($row1['profile_pic'],'https:') !== false)
								{
									$pic =$row1['profile_pic'];
								}
								else
								{
									$pic = base_url('images').'/'.$row1['profile_pic'];	
								}
						//$pic = $row1['profile_pic'];
						
					}
					else if($row1['social_type'] == '3')// general login so provide path to image
					{
						$pic = base_url('images').'/'.$row1['profile_pic'];
						
					}
				// get aacks of the logged in user 10 10 records
				
				$qry2 = $this->db->query("(select ta.*,case when (select count(tr.AackId) from tbl_reshares tr where tr.AackId=ta.aack_id) > 0 then 'reshare' else 'myshare' end as sharetype from tbl_aacks ta  where ta.userid='$userid' and ta.status='1' and ta.sharedto NOT IN (0,6)) 
UNION ALL
(select ta.aack_id,ta.userid,ta.conversation_with,ta.lastmessage,ta.aack_content,ta.thumbnail,ta.aack_caption,ta.conversation_from,ta.screen_look,tr.SharedTo as sharedto,ta.status,tr.devicedatetime as devicedatetime,tr.CreatedDate as created_date,'reshare' as sharetype from tbl_reshares tr inner join tbl_aacks ta  on ta.aack_id=tr.AackId where tr.UserId='$userid' and ta.Status='1' and tr.SharedTo NOT IN (0,6))
ORDER BY devicedatetime desc LIMIT $start,10");
				$row2 = $qry2->result();
				$countaacks = $qry2->num_rows();
			    //echo $this->db->last_query();
				if($countaacks > 0)
				{
					foreach($row2 as $value)
					{
				//if userid2 is empty we check reshare status with userid1,if userid2 is not empty we check with userid2 
					if(!empty($userid2))
					$use = $userid2;
				    else
					$use = $userid;
				
					$q23 = $this->db->query("select AackId from tbl_reshares where AackId='$value->aack_id' and UserId='$use'");
					$resharestatus = ($q23->num_rows()>0)?true:false;
					$aackimage = base_url('aacks').'/'.$value->aack_content;
					$aackthumburl = base_url('aack_thumbs').'/'.$value->thumbnail;
					// interval calculation 
					$date1 = $value->created_date;
					//$date2  = $devicedatetime;
					$date2  = date('Y-m-d H:i:s');
					$resultdate = $this->datedifference($date1,$date2);
					if($value->sharetype == "reshare")
					{
					$qry23 = $this->db->query("select * from tbl_users where userid = '$value->userid'");
					$row23 = $qry23->row();
					
					
					  if (strpos($row23->profile_pic,'http:') !== false || strpos($row23->profile_pic,'https:') !== false)
								{
									$Ownerpic =$row23->profile_pic;
								}
								else
								{
									$Ownerpic = base_url('images').'/'.$row23->profile_pic;	
								}
					
					
					$message1[]=array('aackid'=>$value->aack_id,'userid'=>$value->userid,'aackcontent'=>$aackimage,'caption'=>$value->aack_caption
						,'conversationfrom'=>$value->conversation_from,'screentype'=>$value->screen_look,'sharedto'=>$value->sharedto,"reshareStatus"=>$resharestatus
						,'devicedatetime'=>$resultdate=($resultdate==null)?"":$resultdate,"serverdatetime"=>$date2,'profilepic'=>$pic=($pic==null)?"":$pic,
						'aackthumb'=>$aackthumburl,"sharetype"=>$value->sharetype,"Ownerfullname"=>trim($row23->firstname." ".$row23->lastname),'Ownerusername'=>$row23->username,'Ownerprofilepic'=>!empty($Ownerpic)?$Ownerpic:"");
					}
					else
					{
						$message1[]=array('aackid'=>$value->aack_id,'userid'=>$value->userid,'aackcontent'=>$aackimage,'caption'=>$value->aack_caption
						,'conversationfrom'=>$value->conversation_from,'screentype'=>$value->screen_look,'sharedto'=>$value->sharedto,"reshareStatus"=>$resharestatus
						,'devicedatetime'=>$resultdate=($resultdate==null)?"":$resultdate,"serverdatetime"=>$date2,'profilepic'=>$pic=($pic==null)?"":$pic,
						'aackthumb'=>$aackthumburl,"sharetype"=>$value->sharetype);
					}
					}
				}
				
				$message=array('userid'=>$row1['userid'],'fullname'=>$fullname,'username'=>$row1['username'],'followingcount'=>$followingcount,
				'followerscount'=>$followerscount,'status'=>$status,'aackscount'=>$aackscount,'profilepic'=>$pic=($pic==null)?"":$pic,'logintype'=>$row1['social_type']
				,'aacks'=>$message1);
			
		}
		else
		{
			$message=array("message"=>"provide values","userid"=>$userid,"devicedatetime"=>$date2);
		}
		
		echo json_encode($message);
	}
	
	// display aacks which are made fav by that user 
	function getAacks($userid,$start)
	{
		if(!empty($userid))
		{
		$message = array();
		$message1 = array();
			if($start == '')
			{
				$start = '0';
			}
			elseif(!empty($start))
			{
				$start = $start;
			}
			//$query1=$this->db->query("select followee from tbl_follow where follower = '$userid' limit $start,10");// one who logged in will be follower
			$query1=$this->db->query("select * from tbl_aacks where status = '1' and userid IN (select followee from tbl_follow where follower = '$userid') limit $start,10");
			$row1 = $query1->result();
			$qq1 = $this->db->query("select followee from tbl_follow where follower = '$userid'");
			$followingcount = $qq1->num_rows();// how many users you are following example A->b,c count for A is 2
			if($query1->num_rows() > 0)
			{
				foreach($row1 as $value)
				{
					$query2 = $this->db->query("select * from tbl_aacks where userid='$value->userid' and status = '1'");
					$row2 = $query2->row_array();
					$count = $query2->num_rows();
								
						$query3 = $this->db->query("select * from tbl_users where userid='$value->userid'");
						$row3 = $query3->row_array();
						// pics
						if($row3['social_type'] == '2' || $row3['social_type'] == '4' || $row3['social_type'] == '5' || $row3['social_type'] == '6')
						{
							//$pic = $row3['profile_pic'];
								if (strpos($row3['profile_pic'],'http:') !== false || strpos($row3['profile_pic'],'https:') !== false)
								{
									$pic =$row3['profile_pic'];
								}
								else
								{
									$pic = base_url('images').'/'.$row3['profile_pic'];	
								}
							
						}
						else if($row3['social_type'] == '3')// general login so provide path to image
						{
							$pic = base_url('images').'/'.$row3['profile_pic'];
							
						}
						
						
						$fullname = $row3['firstname']." ".$row3['lastname'];
						$fullname = rtrim($fullname," ");
						
						$message1[] = array('userid'=>$value->userid,'aackscount'=>$count,'userpic'=>$pic,'username'=>$row3['username']
						,'fullname'=>$fullname,
						'conversationfrom'=>$value->conversation_from=($value->conversation_from == null)?"":$value->conversation_from);
				
				}
			
			}
			$message=array('followingcount'=>$followingcount,'start'=>$start,'useraacks'=>$message1);
		}
		else
		{
			$message=array('message'=>"provide values");
		}
		echo json_encode($message);
	}
	
	//
	/*
		Step 1: get (Logged in)user details
		Step 2: get fav aack user details
		Step 3: Display his aacks according to time in an array format
	*/
	
	function getUseraacks($userid,$aackuserid,$devicedatetime,$start)
	{
			$message = array();
			$message1 = array();
		if(!empty($userid) && !empty($aackuserid) && !empty($devicedatetime))
		{
			$devicedatetime = str_replace("%20"," ",$devicedatetime);
			if($start == '')
			{
				$start = '0';
			}
			else
			{
				$start = $start;
			}
			$userquery = $this->db->query("select * from tbl_users where userid=$userid");
			$userresult = $userquery->row_array();
			
			//------
			$userquery1 = $this->db->query("select * from tbl_users where number='$aackuserid'");
			$userresult1 = $userquery1->row_array();
			//------
					// to get name from tbl_backup messages table
					$nameofuser = $this->db->query("select username from tbl_backupmessages where number = '$aackuserid' limit 0,1");
					$resname = $nameofuser->row_array();
			// aacks
			
			$aackquery = $this->db->query("select * from tbl_aacks where userid = '$userid' and status = '1' and sharedto='6' 
			and conversation_with='$aackuserid' order by created_date desc limit $start,10");
			$aackres = $aackquery->result();
			$aackcount  = $aackquery->num_rows();
			
			foreach($aackres as $value)
			{
				// interval calculation
				$date1 = $value->created_date;
				$date2  = date('Y-m-d H:i:s');
				
				$resultdate = $this->datedifference($date1,$date2);
	
				$aackimageurl = base_url('aacks').'/'.$value->aack_content;
								
					// pics
					if($userresult1['social_type'] == '2' || $userresult1['social_type'] == '4' || $userresult1['social_type'] == '5' || $userresult1['social_type'] == '6')
					{
					//$aackuserpic = $userresult1['profile_pic'];
								if (strpos($userresult1['profile_pic'],'http:') !== false || strpos($userresult1['profile_pic'],'https:') !== false)
								{
									$aackuserpic =$userresult1['profile_pic'];
								}
								else
								{
									$aackuserpic = base_url('images').'/'.$userresult1['profile_pic'];	
								}
					}
					else if($userresult1['social_type'] == '3')// general login so provide path to image
					{
					$aackuserpic = base_url('images').'/'.$userresult1['profile_pic'];

					}
			
				$message1[]=array("aackuserid"=>strval($value->conversation_with),"aackcontent"=>$aackimageurl,"aackcaption"=>$value->aack_caption
				,"conversationfrom"=>$value->conversation_from
				,"screenlook"=>strval($value->screen_look)
				,"sharedto"=>strval($value->sharedto)
				,"devicedatetime"=>$resultdate,"username"=>$userresult['username'],"aackusername"=>$resname['username']=($resname['username']==null)?$aackuserid:$resname['username'],
				"aackuserpic"=>$aackuserpic=($aackuserpic==null)?"":$aackuserpic,"aackid"=>$value->aack_id,'lastmessage'=>$value->lastmessage);
			}
			
			$fullname = $userresult['firstname']." ".$userresult['lastname'];
			$fullname = rtrim($fullname," ");
			// pics
			if($userresult['social_type'] == '2' || $userresult['social_type'] == '4' || $userresult['social_type'] == '5' || $userresult['social_type'] == '6')
			{
								if (strpos($userresult['profile_pic'],'http:') !== false || strpos($userresult['profile_pic'],'https:') !== false)
								{
									$userpic =$userresult['profile_pic'];
								}
								else
								{
									$userpic = base_url('images').'/'.$userresult['profile_pic'];	
								}
				//$userpic = $userresult['profile_pic'];
				
			}
			else if($userresult['social_type'] == '3')// general login so provide path to image
			{
				$userpic = base_url('images').'/'.$userresult['profile_pic'];
				
			}
			$favscount=$this->db->query("select * from tbl_aacks where status = '1' and sharedto = '6' and userid = '$userid' and conversation_with = '$aackuserid'");
			$resultcount = $favscount->num_rows();
			
			$fav4menameqry = $this->db->query("select * from tbl_users where userid='$aackuserid'");
			$fav4menameres = $fav4menameqry->row_array();
			
			$message=array("userid"=>$userresult['userid'],"fullname"=>$fullname,"username"=>$userresult['username']
			,"userpic"=>$userpic,"favaackcount"=>$resultcount,"fav4mename"=>$fav4menameres['username']=($fav4menameres['username']==null)?$aackuserid:$fav4menameres['username'],
			"aacks"=>$message1);
		}
		else
		{
			$message = array("message"=>"provide values","userid"=>$userid,"aackuserid"=>$aackuserid,"devicedatetime"=>$devicedatetime,"start"=>$start);
			
		}
		echo json_encode($message);
	}
	
	// display aacks which are made fav by that user 
	function getFavAacks($userid,$start)
	{
		if(!empty($userid))
		{
		$message = array();
		$message1 = array();
			if($start == '')
			{
				$start = '0';
			}
			elseif(!empty($start))
			{
				$start = $start;
			}
			$favscount=$this->db->query("select * from tbl_aacks where status = '1' and sharedto = '6' and userid = '$userid'");
			$resultcount = $favscount->num_rows();
			
			$usernamesql = $this->db->query("select * from tbl_users where userid='$userid'");
			$usernameres = $usernamesql->row_array();
			
			// pics
				$fullname = $usernameres['firstname']." ".$usernameres['lastname'];
				$fullname = rtrim($fullname," ");
				// pics
 				if($usernameres['social_type'] == '2' || $usernameres['social_type'] == '4' || $usernameres['social_type'] == '5' || $usernameres['social_type'] == '6')
				{
								if (strpos($usernameres['profile_pic'],'http:') !== false || strpos($usernameres['profile_pic'],'https:') !== false)
								{
									$userpic =$usernameres['profile_pic'];
								}
								else
								{
									$userpic = base_url('images').'/'.$usernameres['profile_pic'];	
								}
					//$userpic = $usernameres['profile_pic'];
					
				}
				else if($usernameres['social_type'] == '3')// general login so provide path to image
				{
				
					$userpic = base_url('images').'/'.$usernameres['profile_pic'];
					
				} 
	
			//
	
			$distinctnumbers = $this->db->query("SELECT * FROM `tbl_aacks` where userid='$userid'
			and sharedto='6' and status='1'  group by conversation_with order by aack_id desc limit $start,10");
			$row = $distinctnumbers->result();
			
			foreach($row as $value)
			{
				
				//echo "asd";
  				$selectdata = $this->db->query("select * from tbl_aacks where 
				conversation_with = '$value->conversation_with' and userid='$userid' and sharedto='6' and status='1'");
				//select *,count(aack_id) as count from tbl_aacks where userid='4' and conversation_with='LM-AxisBk' and status='1' and sharedto='6'
				/* echo "select * from tbl_aacks where 
				conversation_with = '$value->conversation' and userid='$userid' and sharedto='6' and status='1'"; */
				$res1 = $selectdata->row_array();
				$count = $selectdata->num_rows();
				$number = $res1['conversation_with'];
				
				$usernamesql1 = $this->db->query("select * from tbl_users where number='$number'");
				$usernameres1 = $usernamesql1->row_array();
				//$imagenumber = $usernameres1->num_rows();
					//echo "select * from tbl_users where number='$number'";
					// pics
					if($usernameres1['social_type'] == '3')// general login so provide path to image
					{
						$userpic1 = base_url('images').'/'.$usernameres1['profile_pic'];
						
					}
					else 
					{
								if (strpos($usernameres1['profile_pic'],'http:') !== false || strpos($usernameres1['profile_pic'],'https:') !== false)
								{
									$userpic1 =$usernameres1['profile_pic'];
								}
								else
								{
									$userpic1 = base_url('images').'/'.$usernameres1['profile_pic'];	
								}
						//$userpic1 = $usernameres1['profile_pic'];
						
					}

					
					//echo $userpic1."<br/>";

					// to get name from tbl_backup messages table
					$nameofuser = $this->db->query("select username from tbl_backupmessages where number = '$number' and userid='$userid'  limit 0,1");
					$resname = $nameofuser->row_array();

				

			
			//
				$message1[] = array("aackid"=>$res1['aack_id'],"conversationfrom"=>$res1['conversation_from'],"count"=>$count,
				'username'=>$resname['username']=($resname['username']==null)?$number:$resname['username'],'picture'=>$userpic1=($userpic1==null)?"":$userpic1,
				'number'=>$number,'lastmessage'=>$value->lastmessage=($value->lastmessage==null)?"":$value->lastmessage,"screenLook"=>$value->screen_look); 
			}
		$message=array('favscount'=>$resultcount,'userpic'=>$userpic,'fullname'=>$fullname,'username'=>$usernameres['username'],'userid'=>$userid,
				'data'=>$message1);
		}
		else
		{
			$message=array('message'=>"provide values");
		}
		echo json_encode($message);
	}
	
	// following
	function getFollowList($userid,$start)
	{
		$message=array();
		if(!empty($userid))
		{
			// following
			$query1 = $this->db->query("select * from tbl_users where userid in (select followee from tbl_follow where follower = '$userid') order by username");
			$res1 = $query1->result();
			foreach($res1 as $value)
			{
						if($value->social_type == '2' || $value->social_type == '5' || $value->social_type == '4' || $value->social_type == '6')
						{
								if (strpos($value->profile_pic,'http:') !== false || strpos($value->profile_pic,'https:') !== false)
								{
									$pic =$value->profile_pic;
								}
								else
								{
									$pic = base_url('images').'/'.$value->profile_pic;	
								}
							//$pic = $value->profile_pic;
							
						}
						else if($value->social_type == '3')// general login so provide path to image
						{
							$pic = base_url('images').'/'.$value->profile_pic;
							
						}
						$fullname = $value->firstname." ".$value->lastname;
						$fullname = rtrim($fullname," ");
					$message[] = array("userid"=>$value->userid,"username"=>ucfirst($value->username),"email"=>$value->email,"profilepic"=>$pic,
					"nickname"=>$fullname,"number"=>$value->number,"onlinestatus"=>$value->online_status,"createddate"=>$value->created_date);
			}
		}
		else
		{
			$message=array("message"=>"provide values","userid"=>$userid);
		}
		echo json_encode($message);
	
	}
	
	// followers
	
	function getFolloweeList($userid,$start)
	{
		$message=array();
		if(!empty($userid))
		{
			// following
			$query1 = $this->db->query("select * from tbl_users where userid in (select follower from tbl_follow where followee = '$userid') order by username");
			$res1 = $query1->result();
			foreach($res1 as $value)
			{
						if($value->social_type == '2' || $value->social_type == '5' || $value->social_type == '4' || $value->social_type == '6')
						{
							//$pic = $value->profile_pic;
								if (strpos($value->profile_pic,'http:') !== false || (strpos($value->profile_pic,'https:') !== false))
								{
									$pic =$value->profile_pic;
								}
								else
								{
									$pic = base_url('images').'/'.$value->profile_pic;	
								}							
							
						}
						else if($value->social_type == '3')// general login so provide path to image
						{
							$pic = base_url('images').'/'.$value->profile_pic;
							
						}
						$fullname = $value->firstname." ".$value->lastname;
						$fullname = rtrim($fullname," ");
					$message[] = array("userid"=>$value->userid,"username"=>ucfirst($value->username),"email"=>$value->email,"profilepic"=>$pic,
					"nickname"=>$fullname,"number"=>$value->number,"onlinestatus"=>$value->online_status,"createddate"=>$value->created_date);
			}
		}
		else
		{
			$message=array("message"=>"provide values","userid"=>$userid);
		}
		echo json_encode($message);
	
	}
	
// details of the profile with aacks gallery
// userid1 is one who logged in and userid is whose details are you viewing
	function detailProfile($userid,$devicedatetime,$start,$userid1)
	{
		if(!empty($userid) && !empty($devicedatetime) && !empty($userid1))
		{
			$message=array();
			$message1=array();
		if($start == '')
		{
			$start = '0';
		}
		else
		{
			$start = $start;
		} 
			$qry1 = $this->db->query("select * from tbl_users where userid = '$userid'");
			$row1 = $qry1->row_array();
			
			// how many users you are following
				$querystring=$this->db->query("select followee from tbl_follow where follower = '$userid'");
				$followingcount = $querystring->num_rows();
				
				//follower count. Means how many users are following you
				
				$query4=$this->db->query("select follower from tbl_follow where followee = '$userid'");
				$followerscount = $query4->num_rows(); 
				// count for aacks
				$query5=$this->db->query("select * from tbl_aacks where userid = '$userid' and status = '1'");
				$aackscount = $query5->num_rows(); 
				
				// get status of the following
				$followstatusqry = $this->db->query("select * from tbl_follow where follower='$userid1' and followee='$userid'");
				$resultstatus = $followstatusqry->num_rows();
				if($resultstatus > '0')
				{
					$resultstatus = '1';
				}
				else
				{
					$resultstatus = '0';
				}
				
				$fullname = $row1['firstname']." ".$row1['lastname'];
				$fullname = rtrim($fullname," ");
				
					if($row1['social_type'] == '2' || $row1['social_type'] == '4' || $row1['social_type'] == '5' || $row1['social_type'] == '6')
					{
						//$pic = $row1['profile_pic'];
								if (strpos($row1['profile_pic'],'http:') !== false || strpos($row1['profile_pic'],'https:') !== false)
								{
									$pic =$row1['profile_pic'];
								}
								else
								{
									$pic = base_url('images').'/'.$row1['profile_pic'];	
								}
						
					}
					else if($row1['social_type'] == '3')// general login so provide path to image
					{
						$pic = base_url('images').'/'.$row1['profile_pic'];
						
					}
				// get aacks of the logged in user 10 10 records
				
				$qry2 = $this->db->query("select * from tbl_aacks where userid='$userid' and status='1' order by devicedatetime desc limit $start,10");
				$row2 = $qry2->result();
				$countaacks = $qry2->num_rows();
				if($countaacks > 0)
				{
					foreach($row2 as $value)
					{
					
					$aackimage = base_url('aacks').'/'.$value->aack_content;
					// interval calculation 
					$date1 = $value->devicedatetime;
					$date2  = date('Y-m-d H:i:s');
					$resultdate = $this->datedifference($date1,$date2);
						$message1[]=array('aackid'=>$value->aack_id,'aackcontent'=>$aackimage,
						'devicedatetime'=>$resultdate=($resultdate==null)?"":$resultdate);
					}
				}
				
				$message=array('userid'=>$row1['userid'],'fullname'=>$fullname,'username'=>$row1['username'],'followingcount'=>$followingcount,
				'followerscount'=>$followerscount,'aackscount'=>$aackscount,'followstatus'=>$resultstatus,
				'profilepic'=>$pic=($pic==null)?"":$pic,'aacks'=>$message1);
			
		}
		else
		{
			$message=array("message"=>"provide values","userid"=>$userid,"devicedatetime"=>$devicedatetime,"userid1"=>$userid1,);
		}
		
		echo json_encode($message);
	}
	
	
	function searchmsgs($userid,$search,$start,$devicedate)
	{
	 $logobs=base_url('images').'/';
	 $mediabs=base_url('multimedia').'/';
     $q=$this->db->query("select bm.backup_id as backupid,bm.userid,bm.username,bm.number,bm.messages as message,
	 bm.type,bm.message_datetime,case when (LOCATE('http', uu.profile_pic)>0) then uu.profile_pic else concat('$logobs',uu.profile_pic) END as logo,
	 case when CHAR_LENGTH(bm.media)>0 then concat('$mediabs',bm.media) else '' END as media,case when bm.sms IS NOT NULL then bm.sms else '' END as mmstext,
	 case when (uu.firstname IS NULL and uu.lastname IS NULL) then 'No Name' else concat(uu.firstname,uu.lastname) END as fullname,
	 case when bm.messagetype IS NOT NULL then bm.messagetype else '' END as messagetype,bm.created_date
	 from tbl_backupmessages bm inner join tbl_users uu on bm.userid=uu.userid 
	 where (bm.messages like '%$search%' or bm.number like '%$search%' or bm.username like '%$search%') and bm.userid='$userid' group by bm.number order by backupid desc limit $start,20");
	 if($q->num_rows()>0)
	 {
		$r=$q->result();
		foreach($r as $v)
		{
		 $resultdate = $this->datedifference($v->message_datetime,$devicedate);
         $msg[]=array("backupid"=>$v->backupid,"userid"=>$v->userid,"username"=>$v->username,"number"=>$v->number,"message"=>$v->message,"media"=>$v->media,"logo"=>$v->logo,
		 "fullname"=>$v->fullname,"messagetype"=>$v->messagetype,"created_date"=>$v->created_date,"type"=>$v->type,"message_datetime"=>$resultdate);
        
		}
		return $msg;
	 }
	 else
	 return array();
	}
	// date differences
	function datedifference($date1,$date2)
	{
		// interval calculation 
/* 					$date1 = $value->devicedatetime;
					$date2  = $devicedatetime; */
					/* $start_date = new DateTime("$date1");
					$end_date = new DateTime("$date2");
					$interval = $start_date->diff($end_date); */
					$start_date=date_create($date1);
					$end_date=date_create($date2);
					$interval=date_diff($start_date,$end_date);
					//echo "Result " . $interval->y . " years, " . $interval->m." months, ".$interval->d." days ";
					//======================

						$days = $interval->d;
						$months = $interval->m;
						$years = $interval->y;
						$hours = $interval->h;
						$mins = $interval->i;
						$secs = $interval->s;
						
								if($years < '1' && $months < '1' && $days < '1' && $hours < '1' && $mins < '1' && $secs >= '0')
								{
									// display in secs
									$resultdate = $secs." s";
								}
								else if($years < '1' && $months < '1' && $days < '1' && $hours < '1' && $mins >= '1')
								{
									// display in hours
									$resultdate = $mins." m";
								}
								else if($years < '1' && $months < '1' && $days < '1' && $hours >= '1')
								{
									// display in mins
									$resultdate = $hours." h";
								}
								else if($years < '1' && $months < '1' && ($days <= '10' && $days > '0'))
								{
									if($days == '1'){$key="day";}else{$key="days";}
									// display in days
									$resultdate = $days." ".$key;
								}
								else if($years < '1' && ($months >='1' || $days > '10' || $days >= '0'))
								{
									$resultdate =  date("M j",strtotime($date1)); // month
								}
								else if($years > '0')
								{
									$resultdate = $years." years"; // years
								}
								return $resultdate;
	}
	
	
}
?>
