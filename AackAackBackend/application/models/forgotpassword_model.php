<?php
Class forgotpassword_model extends CI_Model
{

	function user($email)
	{
		 if(!empty($email))
		{
				// send password to email
				
				// User may also send username instead of email, So we are checking with both columns
				$getemail = $this->db->query("select * from tbl_users where (email='$email' or username='$email') and social_type='3'");
				$row = $getemail->row_array(); 
				$count = $getemail->num_rows();
				if($count > 0)
				{
					$to_email=$row['email'];
					//$to_email="ramaraju.d@stellentsoft.com";
					$username=$row['username'];
					$password=$row['password'];
					//sending mail to user for recovery of password
					$subject = "Aack Aack Password Reminder";
					$notes="Hello!"."<br/><br/>"."We received a request to provide you with your AackAack App Login Credentials, which are noted below."."<br/><br/>".
					"Username : ".$username."<br/> Password : ".$password."<br/><br/>"."Thank you for using AackAack!"."<br/><br/>";
					$this->email->from('admin@aackaack.com', 'AackAack');
					$this->email->to($to_email); 
					$this->email->subject($subject);
					$this->email->message($notes);
					$this->email->reply_to('',''); 
					$this->email->set_mailtype("html");
					$result=$this->email->send();
					if($result)
					{
						// success message
						$message=array("message"=>"Mail successfully sent"); 
					}
					else
					{
						// failed message
						 $message=array("message"=>"Mail delivery failed.");
					}
				}
				else
				{
					$gettype = $this->db->query("select * from tbl_users where (email='$email' or username='$email')");
					$rows = $gettype->row_array(); 
					if($gettype->num_rows() > 0)
					{
						$message = array("message"=>"Email not found","logintype"=>$rows['social_type']);
					}
					else
					{
						$message = array("message"=>"Email not found","logintype"=>"");
					}
					
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
