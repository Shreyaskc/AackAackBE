<?php
Class delete_model extends CI_Model
{

	function user($userid)
	{
		 if(!empty($userid))
		{
			// get user aack id's
			$sql = $this->db->query("select aack_id from tbl_aacks where userid = '$userid'");
			$res = $sql->result();
			$count = $sql->num_rows();
			foreach($res as $value)
			{
				$data[] = $value->aack_id; // all aack details
			}
			$aacks = implode(',',$data);
			//echo "aacks are ".$aacks;
			
			 if($count > '0')
			{
				// removing tbl_comments that belongs to aackid
				$sql1 = $this->db->query("delete from tbl_comments where aack_id IN ($aacks)");
					
				$sql2 = $this->db->query("delete from tbl_comments where userid ='$userid' ");
			
				
				//tbl_likes removing likes
				$sql3 = $this->db->query("delete  from tbl_likes where aack_id IN ($aacks)");
					
				$sql4= $this->db->query("delete  from tbl_likes where userid ='$userid' ");
			}
			
				//tbl_follow
				$sql5 = $this->db->query("delete from tbl_follow where follower = '$userid' or followee='$userid'");
				
				//tbl_backupmessages
				$sql5 = $this->db->query("delete from tbl_backupmessages where userid='$userid'");
				
				//tbl_reshares
				$sql5 = $this->db->query("delete from tbl_reshares where UserId='$userid'");
				
				//tbl_aacks
				$sql = $this->db->query("delete from tbl_aacks where userid = '$userid'");
				
				//tbl_users
				$sql5 = $this->db->query("delete from tbl_users where userid='$userid'");
				
				//Social Table
				$sql6 = $this->db->query("select * from tbl_social where userid='$userid'");
				$res6 = $sql6->result();
				foreach($res6 as $value1)
				{
					$socialid = $value1->social_id;
					//Facebook
					$facebook = $this->db->query("delete from tbl_facebook where social_feed_id='$socialid'");
					//twitter
					$twitter = $this->db->query("delete from tbl_twitter where social_feed_id='$socialid'");
					
					//Insta
					$insta = $this->db->query("delete from tbl_instagram where social_feed_id='$socialid'");
				}
				
				//tbl_users
				$socialsql = $this->db->query("delete from tbl_social where userid='$userid'");
				
				
				$message = array("message"=>"Deleted user"); 
		}
		else
		{
			$message = array("message"=>"provide userid");
		}
		echo json_encode($message); 
	}
	
	function aack($userid,$aackid)
	{
		if(!empty($userid) && !empty($aackid))
		{
			$deleteaackcomments = $this->db->query("delete from tbl_comments where aack_id='$aackid'");
			$deleteaacklikes = $this->db->query("delete from tbl_likes where aack_id='$aackid'");
			
			// delete aack
			
			$deleteaack = $this->db->query("delete from tbl_aacks where aack_id='$aackid' and userid='$userid'");
			$message= array("message"=>"success");
			
			
		}
		else
		{
			$message = array("message"=>"provide values","userid"=>$userid,"aackid"=>$aackid);
		}
		echo json_encode($message);
	}
	

	
	
}
?>
