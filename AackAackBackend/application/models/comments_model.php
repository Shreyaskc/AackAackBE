<?php
Class comments_model extends CI_Model
{

// query for comments
	function addComment($aackid,$userid,$comment,$devicedatetime)
	{
		if(!empty($aackid) && !empty($userid) && !empty($comment))
		{
		
				$data = array('aack_id'=>$aackid,'userid'=>$userid,'comment'=>$comment,'devicedatetime'=>$devicedatetime);
				$query = $this->db->insert('tbl_comments',$data);
				if($query)
				{
					$message = array("message"=>"Comment added Successfully","deviceddatetime"=>$devicedatetime);
				}
				else
				{
					$message = array("message"=>"Failed to add Comment");
				}

			
			
		}
		else
		{
			$message = array("message"=>"Provide values","aackid"=>$aackid,"userid"=>$userid,"comment"=>$comment);
		}
		echo json_encode($message);
	}
	
	//get comments for a given aackid
	function getComments($aackid,$start,$devicedatetime)
	{
		//$query = $this->db->query("select * from tbl_comments where aack_id =$aackid order by created_date asc limit $start,20");
		$query = $this->db->query("select * from tbl_comments where aack_id =$aackid order by created_date asc");
		$res = $query->result();
		foreach($res as $value)
		{
			
			$date1 = $devicedatetime;
			$date2 = $value->created_date;
			$resultdate = $this->datedifference($date1,$date2);
			$userid=$value->userid;
			$query1 = $this->db->query("SELECT * FROM  `tbl_users` where userid =$userid");
			$row=$query1->row_array();
			if($row['social_type'] == '2' || $row['social_type'] == '5' || $row['social_type'] == '4' || $row['social_type'] == '6')
			{
				if (strpos($row['profile_pic'],'http:') !== false)
				{
					$profilepic =$row['profile_pic'];
				}
				else
				{
					$profilepic = base_url('images').'/'.$row['profile_pic'];	
				}
				
				
			}
			else if($row['social_type'] == '3')// general login so provide path to image
			{
				$profilepic = base_url('images').'/'.$row['profile_pic'];				
			}

	
			$message[] = array('commentid'=>$value->comment_id,'aackid'=>$value->aack_id,'userid'=>$value->userid,'comment'=>$value->comment,
			'createddate'=>$value->created_date,"datetime"=>$resultdate,"username"=>$row['username'],"profilepic"=>$profilepic,
			"devicedatetime"=>$value->devicedatetime);
		}
		echo json_encode($message);
	}
	
	// date differences
	function datedifference($date1,$date2)
	{
		//return $date1.'/'.$date2;
		// interval calculation 
/* 					$date1 = $value->devicedatetime;
					$date2  = $devicedatetime; */
					/*$start_date = new DateTime("$date1");
					$end_date = new DateTime("$date2");
					$interval = $start_date->diff($end_date);*/
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
									$resultdate = $secs." seconds ago";
								}
								else if($years < '1' && $months < '1' && $days < '1' && $hours < '1' && $mins >= '1')
								{
									// display in hours
									$resultdate = $mins." minutes ago";
								}
								else if($years < '1' && $months < '1' && $days < '1' && $hours >= '1')
								{
									// display in mins
									$resultdate = $hours." hours ago";
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
								return  $resultdate;
	}

}
?>
