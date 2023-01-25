<?php
Class backupmodel extends CI_Model
{

	//backing up messages
	function backUp($data,$userid)
	{
		if(!empty($userid))
		{
			$result = json_decode($data);
			
			$select1 = $this->db->query("select max(message_datetime) as lastbackup from tbl_backupmessages where userid = '$userid'");
			$res1 = $select1->row_array();
			$count = $select1->num_rows(); 
			foreach ($result as $value)
			{
				$dataformat = str_replace("%20"," ",$value->{'date'});// date is sent in 12 hour format so change to 24 hour format
				$hourformat  = DATE("Y-m-d H:i:s", STRTOTIME($dataformat));
				//if($hourformat > $res1['lastbackup'])
				//{
					$lastbackup=$value->{'lastbackup'}=($value->{'lastbackup'}==null)?" ":$value->{'lastbackup'};
					$number = str_replace(" ","",$value->{'number'});

					//$number  = substr($number,-10); // slice only to last 10 numbers
					// just check the condition to make sure already backup message must not entered again
					$content = array('userid'=>$userid,'username'=>$value->{'username'},'number'=>$number,'messages'=>$value->{'message'},
					'message_datetime'=>$hourformat,'type'=>$value->{'relatedto'}=($value->{'relatedto'}==null)?"0":$value->{'relatedto'},
					'lastbackup'=>$lastbackup);
					$sql = $this->db->insert('tbl_backupmessages',$content);
					
					//$updatebackup = $this->db->query("update tbl_backupmessages SET lastbackup='$lastbackup' where userid='$userid'");
				//}
				//else
				//{
					//$message=array("message"=>"Successfully Inserted","backup"=>"backup done");
				//} 
			}

				$select = $this->db->query("select max(message_datetime) as lastbackupmessage from tbl_backupmessages where userid = '$userid'");
				$res = $select->row_array();
				//$insert_id = $this->db->insert_id();
				$message=array("message"=>"Successfully Inserted","lastbackupdate"=>$res['lastbackupmessage']=($res['lastbackupmessage'] == null)?"":$res['lastbackupmessage']);

		}
		else
		{
			$message=array("message"=>"provide values","userid"=>$userid);
		}
		echo json_encode($message);
		
	}
	
	
	//backing up messages that contain media components
	function backUpMedia($userid,$number,$type,$date,$media,$lastbackup)
	{
		if(!empty($userid))
		{
				$number = str_replace(" ","",$number);
				$dataformat = str_replace("%20"," ",$date);// date is sent in 12 hour format so change to 24 hour format
				$hourformat  = DATE("Y-m-d H:i:s", STRTOTIME($dataformat));
					//$number  = substr($number,-10); // slice only to last 10 numbers
					// just check the condition to make sure already backup message must not entered again
					$content = array('userid'=>$userid,'number'=>$number,'media'=>$media,
					'message_datetime'=>$hourformat,'type'=>$type,'lastbackup'=>$lastbackup);
					$sql = $this->db->insert('tbl_backupmessages',$content);
 			if($sql)
			{
				$select = $this->db->query("select max(message_datetime) as lastbackup from tbl_backupmessages where userid = '$userid'");
				$res = $select->row_array();
				//$insert_id = $this->db->insert_id();
				$message=array("message"=>"Successfully Inserted","lastbackupdate"=>$res['lastbackup']=($res['lastbackup'] == null)?"":$res['lastbackup']);
			}
			else
			{
				$message=array("message"=>"Successfully Inserted","status"=>"insertion failed","lastbackupdate"=>$res['lastbackup']=($res['lastbackup'] == null)?"":$res['lastbackup']);
			}  

		}
		else
		{
			$message=array("message"=>"provide values","userid"=>$userid);
		}
		echo json_encode($message);
	
		
	}
	

}
?>
