<?php
Class backupmodel extends CI_Model
{

	//backing up messages
	function backUp($data,$userid)
	{
		if(!empty($userid))
		{
			$result = json_decode($data);
			
			
			$select1 = $this->db->query("select max(message_datetime) as backup from tbl_backupmessages where userid = '$userid'");
			$res1 = $select1->row_array();
			$count = $select1->num_rows(); 
			foreach ($result as $value)
			{
				$dataformat = str_replace("%20"," ",$value->{'date'});// date is sent in 12 hour format so change to 24 hour format
				$hourformat  = DATE("Y-m-d H:i:s", STRTOTIME($dataformat));

					$lastbackup=$value->{'lastbackup'}=($value->{'lastbackup'}==null)?" ":$value->{'lastbackup'};
					$number = str_replace(" ","",$value->{'number'});


					$sms = $value->{'mmstext'}=($value->{'mmstext'} == null)?"":$value->{'mmstext'};
					$content[] = array('userid'=>$userid,'username'=>$value->{'username'},'number'=>$number,'messages'=>$value->{'message'},
					'message_datetime'=>$hourformat,'type'=>$value->{'relatedto'}=($value->{'relatedto'}==null)?"0":$value->{'relatedto'},
					'lastbackup'=>$lastbackup,'messagetype'=>$value->{'messagetype'},'sms'=>$sms);

			} 
			//print_r($content); 
				
 				 $sql = $this->db->insert_batch('tbl_backupmessages',$content);
				$select = $this->db->query("select max(message_datetime) as lastbackupmessage from tbl_backupmessages where userid = '$userid'");
				$res = $select->row_array();
				//$insert_id = $this->db->insert_id();
				$message=array("message"=>"Successfully Inserted",
				"lastbackupdate"=>$res['lastbackupmessage']=($res['lastbackupmessage'] == null)?"":$res['lastbackupmessage'],
				"hour"=>$hourformat,"last"=> $res1['backup']); 

		}
		else
		{
			$message=array("message"=>"provide values","userid"=>$userid);
		}
		echo json_encode($message);
		
	}
	
}
?>
