<?php
Class samplebackupmodel extends CI_Model
{
/*
 [{"messagetype":"sms","message":"AXISBank Account 00014058 Date 2013-03-02 Effective Balance: 12725","number":"BTAxisBk","username":"BTAxisBk",
 "relatedto":"1","date":"1970\/01\/02 03:15:57 PM","lastbackup":121557107}]

*/
	//backing up messages
	function backUp($data,$userid,$username)
	{
		if(!empty($userid))
		{
			$checkUser = $this->db->query("select * from tbl_users where userid='$userid' and username = '$username'");
			$countuser = $checkUser->num_rows();
			if($countuser > 0)
			{
				$result = json_decode($data);
				if(count($result) > 0)
				{
					$select1 = $this->db->query("select max(message_datetime) as backup from tbl_backupmessages where userid = '$userid'");
					$res1 = $select1->row_array();
					$count = $select1->num_rows(); 
					foreach ($result as $value)
					{
						$dataformat = str_replace("%20"," ",$value->{'date'});// date is sent in 12 hour format so change to 24 hour format
						$hourformat  = DATE("Y-m-d H:i:s", STRTOTIME($dataformat));
						//if($hourformat > $res1['backup'])
						//{
							$lastbackup=$value->{'lastbackup'}=($value->{'lastbackup'}==null)?" ":$value->{'lastbackup'};
							$number = str_replace(" ","",$value->{'number'});

							//$number  = substr($number,-10); // slice only to last 10 numbers
							// just check the condition to make sure already backup message must not entered again
							$sms = $value->{'mmstext'}=($value->{'mmstext'} == null)?"":$value->{'mmstext'};
							$thread_id = ($value->{'thread_id'} == null)?" ":$value->{'thread_id'};
							$original_message_date = ($value->{'original_message_date'} == null)?" ":$value->{'original_message_date'};
							$content[] = array('userid'=>$userid,'username'=>$value->{'username'},'number'=>$number,'messages'=>$value->{'message'},
							'message_datetime'=>$hourformat,'type'=>$value->{'relatedto'}=($value->{'relatedto'}==null)?"0":$value->{'relatedto'},
							'lastbackup'=>$lastbackup,'messagetype'=>$value->{'messagetype'},'sms'=>$sms,'thread_id'=>$thread_id,'original_message_date'=>$original_message_date);
							
							
							//$updatebackup = $this->db->query("update tbl_backupmessages SET lastbackup='$lastbackup' where userid='$userid'");
						//}
						//else
						//{
							//$message=array("message"=>"Successfully Inserted","backup"=>"backup done");
						//} 
					}
					
					if($countuser > 0)
					{
						
						if($this->db->insert_batch('tbl_backupmessages',$content))
						{
							
								$select = $this->db->query("select max(message_datetime) as lastbackupmessage from tbl_backupmessages where userid = '$userid'");
								$res = $select->row_array();
								
								//$insert_id = $this->db->insert_id();
								$message=array("message"=>"Successfully Inserted",
								"lastbackupdate"=>$res['lastbackupmessage']=($res['lastbackupmessage'] == null)?"":$res['lastbackupmessage'],
								"hour"=>$hourformat,"last"=> $res1['backup']);
						}
						else
						{
								$message=array("message"=>"Failed");
						}
						
						
					}
				}
				else
				{
					$message=array("message"=>"empty data");
				}


			}
		}
		else
		{
			$message=array("message"=>"provide values","userid"=>$userid,"json_date"=>$data);
		}
		echo json_encode($message);
		
	}
	
}
?>
