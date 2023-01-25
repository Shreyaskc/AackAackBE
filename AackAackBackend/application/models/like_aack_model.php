<?php
Class like_aack_model extends CI_Model
{

// query for likes
	function likeAack($aackid,$userid)
	{
		if(!empty($aackid) && !empty($userid))
		{
		
			$query1 = $this->db->query("select * from tbl_likes where aack_id='$aackid' and userid='$userid'");
			$count = $query1->num_rows();
			
			if($count > 0)
			{
	             
				$deleteqry = $this->db->query("delete from tbl_likes where aack_id='$aackid' and userid='$userid'");
				if($deleteqry )
				{
				$query2 = $this->db->query("select * from tbl_likes where aack_id='$aackid'");
				 $aackcount = $query2->num_rows();
				$message = array("message"=>"UnLiked","aackcount"=>$aackcount);
				}
				
			}
			else
			{
				$data = array('aack_id'=>$aackid,'userid'=>$userid);
				$query = $this->db->insert('tbl_likes',$data);
				
				if($query)
				{
					$query2 = $this->db->query("select * from tbl_likes where aack_id='$aackid'");
					$aackcount = $query2->num_rows();
					$message = array("message"=>"Liked","aackcount"=>$aackcount);
				}
				else
				{
					$message = array("message"=>"Failed");
				}
			}
			
			
		}
		else
		{
			$message = array("message"=>"Provide values","aackid"=>$aackid,"userid"=>$userid);
		}
		echo json_encode($message);
	}
	
	//
	
	function likedUsers($aackid,$start)
	{
		if(!empty($aackid))
		{
			$aackLike = $this->db->query("select * from tbl_likes where aack_id='$aackid'");
			$countlikes = $aackLike->num_rows();
			if($countlikes > '0')
			{
			
				$rowlikes = $aackLike->result();
				foreach ($rowlikes as $val)
				{	
					$user = $val->userid;
					$message3[] = $this->profile($user);
				}
				
			}
		}
		else
		{
			$message3 = array("message"=>"provide values");
		}
		echo json_encode($message3);
	}
	
	// get user details
	function profile($userid)
	{
	
		if(!empty($userid))
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
				
				$fullname = $row1['firstname']." ".$row1['lastname'];
				$fullname = rtrim($fullname," ");
				
					if($row1['social_type'] == '2' || $row1['social_type'] == '4' || $row1['social_type'] == '5' || $row1['social_type'] == '6')
					{
								if (strpos($row1['profile_pic'],'http:') !== false)
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
				
/* 				$qry2 = $this->db->query("select * from tbl_aacks where userid='$userid' and status='1' order by devicedatetime desc");
				$row2 = $qry2->result();
				$countaacks = $qry2->num_rows();
				if($countaacks > 0)
				{
					foreach($row2 as $value)
					{
					
					$aackimage = base_url('aacks').'/'.$value->aack_content;
					$aackthumburl = base_url('aack_thumbs').'/'.$value->thumbnail;
					// interval calculation 
					//$date1 = $value->devicedatetime;
					//$date2  = $devicedatetime;
					//$resultdate = $this->datedifference($date1,$date2);
						$message1[]=array('aackid'=>$value->aack_id,'userid'=>$value->userid,'aackcontent'=>$aackimage,'caption'=>$value->aack_caption
						,'conversationfrom'=>$value->conversation_from,'screentype'=>$value->screen_look,'sharedto'=>$value->sharedto
						,'devicedatetime'=>"",'profilepic'=>$pic=($pic==null)?"":$pic,
						'aackthumb'=>$aackthumburl);
					}
				} */
				
				$message=array('userid'=>$row1['userid'],'fullname'=>$fullname,'username'=>$row1['username'],'followingcount'=>$followingcount,
				'followerscount'=>$followerscount,'aackscount'=>$aackscount,'profilepic'=>$pic=($pic==null)?"":$pic);
				//,'aacks'=>$message1
			
		}
		return $message;
		//echo json_encode($message);
	}
	
	
	function aackCount($aackid,$userid)
	{
		if((!empty($aackid)) && (!empty($userid)))
		{
			$aackLike = $this->db->query("select * from tbl_likes where aack_id='$aackid'");
			$countlikes = $aackLike->num_rows();
			
			$likestats = $this->db->query("select * from tbl_likes where aack_id='$aackid' and userid='$userid'");
			$reslikes = $likestats->num_rows();
			if($reslikes > '0')
			{
				$likestatus = '1';
			}
			else
			{
				$likestatus = '0';
			}
			
			$message=array('aackcount'=>$countlikes,"likestatus"=>$likestatus);
		}
		else
		{
			$message = array("message"=>"provide values");
		}
		echo json_encode($message);
	}

}
?>
