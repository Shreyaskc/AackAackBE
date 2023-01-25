<?php
class admin_model extends CI_Model
{

    function angularlogin($username,$password)
    {
	if($username=="admin" && $password=="aackaack")
	{
	 $pic=base_url('assets/img').'/admin.jpg';
	 return array("message"=>"success","userid"=>0,"username"=>"Admin","pic"=> $pic);
	}
	else
	return array("message"=>"fail");
	
	/*
        $q=$this->db->query("select userid,profile_pic from tbl_users where username='$username' and password='$password'");
        if($q->num_rows() >0)
        {
            $r=$q->row();
            if (strpos($r->profile_pic,'http') == false)
                $pic=base_url('images').'/'.$r->profile_pic;
            else
                $pic=$r->profile_pic;

            return array("message"=>"success","userid"=>$r->userid,"username"=>$username,"pic"=> $pic);

        }
        else
            return array("message"=>"fail");
     */
    }
	
	function getreports()
	{
		$q=$this->db->query("select uu.userid,uu.username,(select count(bm.backup_id) from tbl_backupmessages bm where bm.userid=uu.userid and bm.messagetype='sms') as sms,
                             (select count(bm.backup_id) from tbl_backupmessages bm where bm.userid=uu.userid and bm.messagetype='mms') as mms from tbl_users uu"); 
	    if($q->num_rows>0)
		{
		  $r=$q->result();
		  foreach($r as $v)
		  {
		  $id=$v->userid."/";
		 // echo $id;
		  $msg[]=array("UserName"=>$v->username,"SMS"=>$v->sms,"MMS"=>$v->mms,"S3"=>$this->getcountfromS3($id));
		  }
		  return $msg;
		}
		else
		{
		  return array("message"=>"fail");
		}
	
	}
	
	function truncAllTables()
	{
	 $q=$this->db->query("show Tables");
	 $r=$q->result();
	 foreach($r as $v)
	 {
	  //$msg[]=array("table"=>$v->Tables_in_AackAack_Production);
	  $this->db->truncate($v->Tables_in_AackAack_Production);
	 }
	 return array("message"=>"success");
	}

	function deleteS3Data()
	{
	
		//AWS access info
// 		if (!defined('awsAccessKey')) define('awsAccessKey', 'AKIAJJCM7TAQSDTARNDA');
// 		if (!defined('awsSecretKey')) define('awsSecretKey', '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');
		
		
// 		if (!defined('awsAccessKey')) define('awsAccessKey', 'AKIAIEBNB5MAJGLPRXKA');
// 		if (!defined('awsSecretKey')) define('awsSecretKey', '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');
		
		if (!defined('awsAccessKey')) define('awsAccessKey', 'AKIAJFF3ZDUNJH5AKX7A');
		if (!defined('awsSecretKey')) define('awsSecretKey', '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');
		

		//instantiate the class
		$s3 = new S3(awsAccessKey, awsSecretKey);
		//$bucket="aackproduction";
		$bucket="aackaack-s3";
		//$dat=$s3->deleteBucket($bucket);
		$dat=$s3->getBucket($bucket);
		foreach($dat as $k=>$v)
		{
	        //$msg[]= array("Key"=>$k);
			if($k!="000000-1212-1212-1212-121212121212.png")
			$r=$s3->deleteObject($bucket,$k);
			//echo $r;
		}
		
		return array("message"=>"success");
	}
	
	function getcountfromS3($id)
	{	   
		$count=0;
		//AWS access info
// 		if (!defined('awsAccessKey')) define('awsAccessKey', 'AKIAJJCM7TAQSDTARNDA');
// 		if (!defined('awsSecretKey')) define('awsSecretKey', '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');
		
// 		if (!defined('awsAccessKey')) define('awsAccessKey', 'AKIAIEBNB5MAJGLPRXKA');
// 		if (!defined('awsSecretKey')) define('awsSecretKey', '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');

		
		if (!defined('awsAccessKey')) define('awsAccessKey', 'AKIAJFF3ZDUNJH5AKX7A');
		if (!defined('awsSecretKey')) define('awsSecretKey', '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');
		
		
		//instantiate the class
		$s3 = new S3(awsAccessKey, awsSecretKey);
		//$bucket="aackproduction";
		$bucket="aackaack-s3";
		
		
		//instantiate the class
		$s3 = new S3(awsAccessKey, awsSecretKey);
		$dat=$s3->getBucket($bucket);
		foreach($dat as $k=>$v)
		{
		//echo $k."||";
		//echo strchr($k,$id)!=false;
		//echo "||";
		if(strchr($k,$id)!=false)
		$count=$count+1;
		}
		return $count;
	}		
		
    function nggetaacks($userid)
    {
        $q=$this->db->query("select aack_content,aack_id,aack_caption,conversation_with,created_date from tbl_aacks where status = '1' and userid='$userid'");
        if($q->num_rows()>0)
        {
            $r=$q->result();
            foreach($r as $val)
            {
                $image=$val->aack_content;
                $aackid=$val->aack_id;
                $caption=$val->aack_caption;
                $con_with=$val->conversation_with;
                $date=$val->created_date;
                $pic = base_url('aacks').'/'.$image;
                $msg[]=array("image"=>$pic,"aackid"=>$aackid,"caption"=>$caption,"con_with"=>$con_with,"date"=>$date);

            }
            return $msg;
        }
        else
            return array("message"=>"Sorry! No Aacks to Display!");

    }




    function aackemail($userid,$aackid)
    {

        $q=$this->db->query("select aack_content,aack_caption,conversation_with,created_date from tbl_aacks where userid='$userid' and aack_id='$aackid'");
        if($q->num_rows() == 1)
        {
            $r=$q->row();
			$pic = base_url('aacks').'/'.$r->aack_content;
            return array("image"=>$pic,"aackid"=>$aackid,"caption"=>$r->aack_caption,"con_with"=>$r->conversation_with,"date"=>$r->created_date);
        }
        else
            return array("message"=>"Aack not available");

    }


  function sendemail($userid,$aackid,$email)
	{
	   $q=$this->db->query("select aa.aack_content,aa.aack_caption,aa.conversation_with,aa.created_date,uu.firstname,uu.lastname,uu.email from tbl_aacks aa inner join tbl_users uu on aa.userid=uu.userid  where aa.userid='$userid' and aa.aack_id='$aackid'");
	   $r=$q->row();
	   $pic = base_url('aacks').'/'.$r->aack_content;
	   $caption=$r->aack_caption;
	   $con_with=$r->conversation_with;
	   $date=$r->created_date;
	  
	  //sending mail
	  
		$headers  = "MIME-Version: 1.0\r\n";
		$headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
		$headers .='From:'.$r->email. "\r\n";
		$to=$email;
		$subject="AackAack-aack";
    	$message="<b>Caption:</b>".$caption."<br/><b>Conversation with:</b>".$con_with."<br/><b>Date:</b>".$date."<br/><img src=".$pic." />";
		
		if(mail($to, $subject, $message, $headers))
		return array("message"=>"mail sent successfully");  
		else
		return array("message"=>"unable to send mail");
	  
	 
	}

    function login($username,$password)
    {


        $query1=$this->db->query("select * from tbl_users where username='$username' and password='$password'");


        if($query1->num_rows() > 0)
        {
            $row1=$query1->row_array();
            $userid = $row1['userid'];
            return array("userid"=>$userid,"message"=>"success");
        }
        else
        {
            return array("message"=>"failed");
        }
    }

    function getAacks($userid,$start)
    {
        if(!empty($userid))
        {
            //$query1=$this->db->query("select followee from tbl_follow where follower = '$userid' limit $start,10");// one who logged in will be follower
            $query1=$this->db->query("select * from tbl_aacks where status = '1' and userid='$userid'");
            $row1 = $query1->result();
            if($query1->num_rows() > 0)
            {
                foreach($row1 as $value)
                {
                    $image=$value->aack_content;
                    $aackid=$value->aack_id;
                    $caption=$value->aack_caption;
                    $con_with=$value->conversation_with;
                    $date=$value->created_date;

                    $pic = base_url('aacks').'/'.$image;

                    $aacks[]=array("image"=>$pic,"aackid"=>$aackid,"caption"=>$caption,"con_with"=>$con_with,"date"=>$date);

                }
                return $aacks;
            }
        }
        else
        {
            $message=array('message'=>"provide values");
        }
    }
}
?>