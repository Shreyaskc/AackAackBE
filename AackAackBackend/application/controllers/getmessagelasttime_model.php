<?php
Class getmessagelasttime_model extends CI_Model
{

	function gettime($userid)
	{
		if(!empty($userid))
		{
			
			
			$q1 = $this->db->query("select max(backup_id) as data from tbl_backupmessages where userid='$userid'");
			$r1 = $q1->row_array();
			$count = $q1->num_rows();
			if($count > '0' && $r1['data'] != null)
			{
			$query = $this->db->query("select lastbackup from tbl_backupmessages where backup_id = $r1[data]");
			$res = $query->row_array();
			
			$message = array("userid"=>$userid,"lastdatetime"=>$res['lastbackup']=($res['lastbackup'] == null)?"0":$res['lastbackup']);
			}
			else
			{
				$message = array("userid"=>$userid,"lastdatetime"=>"0");
			}
		}
		else
		{
			$message = array("message"=>"provide userid");
		}
		echo json_encode($message); 
	}
	

	
	
}
?>
