<?php
Class getAacksmodel extends CI_Model
{

// display aacks
	function getAacks($userid,$start)
	{
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
		
			$query1=$this->db->query("select followee from tbl_follow where follower = '$userid' limit $start,10");// one who logged in will be follower
			$row1 = $query1->result();
			$followingcount = $query1->num_rows();// how many users you are following example A->b,c count for A is 2
			if($query1->num_rows() > 0)
			{
				foreach($row1 as $value)
				{
					$query2 = $this->db->query("select * from tbl_aacks where userid='$value->followee'");
					$row2 = $query2->row_array();
					$countmess = $query2->num_rows();
					
						$query3 = $this->db->query("select * from tbl_users where userid='$value->followee'");
						$row3 = $query3->row_array();
						// pics
						if($row3['social_type'] == '2')
						{
							$pic = $row3['profile_pic'];
							
						}
						else if($row3['social_type'] == '3')// general login so provide path to image
						{
							$pic = base_url('images').'/'.$row3['profile_pic'];
							
						}
						
						
						$fullname = $row3['firstname']." ".$row3['lastname'];
						$fullname = rtrim($fullname," ");
						
						$message1[]=array('userid'=>$row2['userid'],'userpic'=>$pic,'username'=>$row3['username'],'aackscount'=>$countmess
						,'fullname'=>$fullname,'caption'=>$row2['aack_caption'],'conversationfrom'=>$row2['conversation_from']);

					
				}
			
			}
			$message=array('followingcount'=>$followingcount,'useraacks'=>$message1);
		}
		else
		{
			$message=array('message'=>"provide values");
		}
		echo json_encode($message);
	}
}
?>
