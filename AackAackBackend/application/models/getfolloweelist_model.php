<?php
Class getfolloweelist_model extends CI_Model
{

//addUserFacebook
/* 	function getFolloweeList($userid,$start)
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
							$pic = $value->profile_pic;
							
						}
						else if($value->social_type == '3')// general login so provide path to image
						{
							$pic = base_url('images').'/'.$value->profile_pic;
							
						}
						$fullname = $value->firstname." ".$value->lastname;
						$fullname = rtrim($fullname," ");
					$message[] = array("userid"=>$value->userid,"username"=>$value->username,"email"=>$value->email,"profilepic"=>$pic,
					"nickname"=>$fullname,"number"=>$value->number,"onlinestatus"=>$value->online_status,"createddate"=>$value->created_date);
			}
		}
		else
		{
			$message=array("message"=>"provide values","userid"=>$userid);
		}
		echo json_encode($message); 
		//echo "asdasdasdasdasd";
	
	} */
	
	// get messages of all users you follow
	function getFolloweeList($userid,$devicedatetime,$start)
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
		
			$qq1=$this->db->query("select follower from tbl_follow where followee = '$userid'");
			$followeecount = $qq1->num_rows();
			
/* 		$query1 = $this->db->query("select * from tbl_aacks where status='1' and userid IN(select followee from tbl_follow where follower = '$userid')
		order by aack_id desc limit $start,10"); */
		
		//Client told to show all aacks instead of lates aacks 2013-11-19 So commented query is
				$query1 = $this->db->query("select A.* from tbl_aacks A 
									join(
									select max(aack_id) as aack_id,userid from tbl_aacks where status='1' and sharedto !='6'
									and 
									userid IN (select follower from tbl_follow where followee = '$userid')
									group by userid
									)
									B on A.userid = B.userid and A.aack_id = B.aack_id and A.status='1'  order by A.aack_id desc limit $start,10");
		
		
		$row1 = $query1->result();
		

			if($query1->num_rows() > 0)
			{
				foreach($row1 as $value)
				{
					$query5 = $this->db->query("select *,case when (select count(tr.AackId) from tbl_reshares tr where tr.AackId=ta.aack_id) > 0 then 'reshare' else 'myshare' end as sharetype from tbl_aacks ta where ta.aack_id = '$value->aack_id'");
					$res5   = $query5->row_array();
					//echo "select * from tbl_aacks where aack_id = $value->aack_id"."<br/>";
					$user = $res5['userid'];
					
					$q23 =  $this->db->query("select ReshareId from tbl_reshares where UserId='$userid' and AackId='$value->aack_id'");
					$reshareStatus = ($q23->num_rows()>0)?true:false;
					//echo "select * from tbl_users where userid=$user";
					
						$query3 = $this->db->query("select * from tbl_users where userid='$user'");
						$row3 = $query3->row_array();
						// pics
						if($row3['social_type'] == '2' || $row3['social_type'] == '4' || $row3['social_type'] == '5' || $row3['social_type'] == '6')
						{
								if (strpos($row3['profile_pic'],'http:') !== false)
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
						// interval calculation 
						$date1 = $res5['created_date'];
						//$date2  = str_replace("%20"," ",$devicedatetime);
						$date2  = date('Y-m-d H:i:s');
						$resultdate = $this->datedifference($date1,$date2);
						$aackimageurl = base_url('aacks').'/'.$res5['aack_content'];
						$aackthumburl = base_url('aack_thumbs').'/'.$res5['thumbnail'];
						$fullname = $row3['firstname']." ".$row3['lastname'];
						$fullname = rtrim($fullname," "); 
						//*********
						// like status
						//********
						$aackid = $res5['aack_id'];
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
						$message1[]=array('aackid'=>$res5['aack_id'],'userid'=>$res5['userid'],'userpic'=>$pic,'username'=>$row3['username']
						,'nickname'=>$fullname,'caption'=>$res5['lastmessage'],'aackdate'=>$resultdate=($resultdate==null)?"":$resultdate,
						"aackcontent"=>$aackimageurl,"aackthumb"=>$aackthumburl,'sharetype'=>$res5['sharetype'],"reshareStatus" => $reshareStatus,
						"conversation"=>$res5['conversation_from'],"likestatus"=>$likestatus,"followstatus"=>"followee"); 
						
					
					
				}
				
			}
			$message=array('followeecount'=>$followeecount,'useraacks'=>$message1);
		}
		else
		{
			$message=array("message"=>"provide values");
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
