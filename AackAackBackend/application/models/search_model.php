<?php
Class search_model extends CI_Model
{
	function Usersearch($user,$userid,$start)
	{
		
		if(!empty($user) && !empty($userid))
		{
			$message=array();
			$message1=array();
			
			// count
			$querystring=$this->db->query("select followee from tbl_follow where follower = '$userid'");
			$followingcount = $querystring->num_rows();
			
			//and userid IN (select userid from tbl_aacks where userid!='$userid')
			$qString = "select * from tbl_users where (firstname like '%$user%' or lastname like '%$user%' or username like '%$user%') and userid!='$userid' 
			and profile_status='0' and (username != '' or username != NULL) and userid IN (select userid from tbl_aacks where userid!='$userid') order by username limit $start,5";
			$query = $this->db->query($qString);
			
// 			$qString = "select * from tbl_users where (firstname like '%$user%' or lastname like '%$user%' or username like '%$user%') and userid!='$userid'
// 			 and (username != '' or username != NULL)  order by username limit $start,5";
// 			$query = $this->db->query($qString);
			//echo $qString;
			$res = $query->result();
			foreach($res as $value)
			{
			
			
				//Adding new code as per new requirement 04-Nov-2013
				//**********************************************************************
				$aacks_sql = $this->db->query("(select *,case when (select count(tr.AackId) from tbl_reshares tr where tr.AackId=ta.aack_id) > 0 then 'reshare' else 'myshare' end as sharetype from tbl_aacks ta where ta.userid = '$value->userid' and ta.status='1')
UNION ALL
(select ta.aack_id,ta.userid,ta.conversation_with,ta.lastmessage,ta.aack_content,ta.thumbnail,ta.aack_caption,ta.conversation_from,ta.screen_look,tr.SharedTo as sharedto,ta.status,tr.devicedatetime as devicedatetime,tr.CreatedDate as created_date,'reshare' as sharetype from tbl_aacks ta inner join tbl_reshares tr on ta.aack_id=tr.AackId where ta.userid = '$value->userid' and ta.status='1') ORDER BY created_date desc limit 0,1");
				//echo $this->db->last_query();
				$aacksdata = $aacks_sql->row_array();
				
				$q23 =  $this->db->query("select ReshareId from tbl_reshares where UserId='$userid' and AackId='$aacksdata[aack_id]'");
				$reshareStatus = ($q23->num_rows()>0)?true:false;
				log_message('error', $q23->num_rows()>0 . ' , '.$reshareStatus);
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
							
							
						}
						else if($value->social_type == '3')// general login so provide path to image
						{
							$pic = base_url('images').'/'.$value->profile_pic;
							
						}
						$fullname = $value->firstname." ".$value->lastname;
						$fullname = rtrim($fullname," ");
						//echo $fullname;
						// interval calculation 
						$date1 = $aacksdata['created_date'];
						//$date2  = str_replace("%20"," ",$devicedatetime);						
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


 							$message[] = array("userid"=>$value->userid,"followstatus"=>$followstatus,"username"=>$value->username,"email"=>$value->email,"profilepic"=>$pic,
							"nickname"=>$fullname,"number"=>$value->number,"onlinestatus"=>$value->online_status,"createddate"=>$value->created_date,"reshareStatus" => $reshareStatus,
							"aackid"=>$aacksdata['aack_id']=($aacksdata['aack_id'] == null)?"":$aacksdata['aack_id'],"conversationfrom"=>$aacksdata['conversation_from']=($aacksdata['conversation_from']==null)?"":$aacksdata['conversation_from'],"caption"=>$aacksdata['aack_caption']=($aacksdata['aack_caption'] == null)?"":$aacksdata['aack_caption'],
							"aackthumb"=>$aackthumb,"aackimage"=>$aackurl,"datetime"=>$resultdate,"sharetype"=>$aacksdata['sharetype']); 
			}
			

					
		}
		else
		{
			$message = array("message"=>"provide values","user"=>$user,"userid"=>$userid);
		}
		echo json_encode($message); 
	}
	
	
	
	// Aacks with given caption
	
 	function hashtags($string,$userid,$start)
	{
		if(!empty($string) && !empty($userid))
		{
			$message=array();
			$string = str_replace("%20"," ",$string);
			$string = str_replace(" ","|",$string);
			$sql = $this->db->query("(select ta.*,case when (select count(tr.AackId) from tbl_reshares tr where tr.AackId=ta.aack_id) > 0 then 'reshare' else 'myshare' end as sharetype from tbl_aacks ta where ta.aack_caption REGEXP '$string' and ta.status='1' GROUP BY ta.aack_caption)
UNION ALL
(select ta.aack_id,ta.userid,ta.conversation_with,ta.lastmessage,ta.aack_content,ta.thumbnail,ta.aack_caption,ta.conversation_from,ta.screen_look,tr.SharedTo as sharedto,ta.status,tr.devicedatetime as devicedatetime,tr.CreatedDate as created_date,'reshare' as sharetype from tbl_aacks ta inner join tbl_reshares tr on ta.aack_id=tr.AackId where ta.aack_caption REGEXP '$string' and ta.status='1' GROUP BY ta.aack_caption) limit $start,5");
			$res = $sql->result();
			foreach($res as $value)
			{
				$sharetype = $value->sharetype;
				
				//to check if Aack reshared by user
				$q23 =  $this->db->query("select ReshareId from tbl_reshares where UserId='$userid' and AackId='$value->aack_id'");
				$reshareStatus = ($q23->num_rows()>0)?true:false;
				
				$query1 = $this->db->query("select * from tbl_users where userid='$value->userid'");
				$res1 = $query1->row_array();
				//echo $res1[''];
				//echo $this->db->last_query();
				
						if($res1['social_type'] == '2' || $res1['social_type'] == '5' || $res1['social_type'] == '4' || $res1['social_type'] == '6')
						{
								if (strpos($res1['profile_pic'],'http:') !== false || strpos($res1['profile_pic'],'https:') !== false)
								{
									$pic =$res1['profile_pic'];
								}
								else
								{
									$pic = base_url('images').'/'.$res1['profile_pic'];	
								}
							
							
						}
						else if($res1['social_type'] == '3')// general login so provide path to image
						{
							$pic = base_url('images').'/'.$res1['profile_pic'];
							
						}
						$fullname = $res1['firstname']." ".$res1['lastname'];
						$fullname = rtrim($fullname," ");
						
						$date1 = $value->created_date;
						//$date2  = str_replace("%20"," ",$devicedatetime);						
						$date2  = date('Y-m-d H:i:s');		
						$resultdate = $this->datedifference($date1,$date2);
						if($value->thumbnail)
						{
						$aackthumb = base_url('aack_thumbs').'/'.$value->thumbnail;
						$aackurl = base_url('aacks').'/'.$value->aack_content;
						}
						else
						{
							$aackthumb = "";
							$aackurl ="";
						}
							//to check the login user following other users or not
							$followquery=$this->db->query("select * from tbl_follow where follower = '$userid' and followee='$res1[userid]'");
							$followcount=$followquery->num_rows();
							if($followcount>0)
							{
								$followstatus="follow";
							}
							else
							{
								$followstatus="unfollow";
							}
				
				$message[] = array("userid"=>$res1['userid'],"followstatus"=>$followstatus,"username"=>$res1['username'],"email"=>$res1['email'],"profilepic"=>$pic,
				"nickname"=>$fullname,"number"=>$res1['number'],"onlinestatus"=>$res1['online_status'],"createddate"=>$res1['created_date'],"reshareStatus" => $reshareStatus,
				"aackid"=>$value->aack_id=($value->aack_id == null)?"":$value->aack_id,"conversationfrom"=>$value->conversation_from=($value->conversation_from==null)?"":$value->conversation_from,"caption"=>$value->aack_caption=($value->aack_caption == null)?"":$value->aack_caption,
				"aackthumb"=>$aackthumb,"aackimage"=>$aackurl,"datetime"=>$resultdate,"sharetype"=>$sharetype); 

			}
							
		}
		else
		{
			$message = array("message"=>"provide values","string"=>$string,"userid"=>$userid);
		}
		echo json_encode($message);
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
