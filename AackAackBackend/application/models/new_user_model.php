<?php
class new_user_model extends CI_Model
{
// General login test
    function testaddUserSample($username,$password,$number,$logintype,$firstname,$lastname,$logo,$email,$devicetoken)
    {
		
        //echo "asdsad";
        //mandory fields
        if(!empty($username) && !empty($password) && !empty($firstname)  && !empty($logintype) && !empty($email) && !empty($logo) && !empty($number))
        {
			
            // check validation
            // if already the device id is assigned to another user, empty the device id for him and assign the deviceid to newly registered user
            // and then continue the process of registration
            $devicecheck = $this->db->query("select * from tbl_users where devicetoken = '$devicetoken'");
            $countdevices = $devicecheck->num_rows();
			
            if($countdevices > '0')
            {
				
                $deviceUser = $devicecheck->row_array();

                $query112=$this->db->query("select * from tbl_users where email='$email'");
                $row112=$query112->row_array();

                $query113=$this->db->query("select * from tbl_users where username='$username'");
                $row113=$query113->row_array();

                if($query112->num_rows() > 0)
                {
                    $userid = $row112['userid'];
                    // how many users you are following example A->b,c count for A is 2
                    $querystring=$this->db->query("select followee from tbl_follow where follower = '$userid'");

                    $followingcount = $querystring->num_rows();

                    //follower count. Means how many users are following you

                    $query4=$this->db->query("select follower from tbl_follow where followee = '$userid'");

                    $followerscount = $query4->num_rows();
                    // get datetime of when a user made his messages backup
                    $backuptime=$this->db->query("select lastbackup from tbl_backupmessages where userid='$userid'");
                    $backup = $backuptime->row_array();

                    $fullname = $row112['firstname']." ".$row112['lastname'];
                    $fullname = rtrim($fullname," ");
                    $message=array("message"=>"User with this Email already exists",'userid'=>$row112['userid'],'username'=>$row112['username'],
                        'number'=>$row112['number']=($row112['number']==null)?"":$row112['number'],'socialtype'=>$row112['social_type'],
                        'followingcount'=>$followingcount,'followerscount'=>$followerscount,'firstname'=>$row112['firstname'],
                        'lastname'=>$row112['lastname'],'logo'=>$logo,'name'=>$fullname,'lastbackup'=>($backup['lastbackup'] == null)?"":$backup['lastbackup']);
                }
                elseif($query113->num_rows() > 0)
                {
                    $userid = $row113['userid'];
                    // how many users you are following example A->b,c count for A is 2
                    $querystring=$this->db->query("select followee from tbl_follow where follower = '$userid'");

                    $followingcount = $querystring->num_rows();

                    //follower count. Means how many users are following you

                    $query4=$this->db->query("select follower from tbl_follow where followee = '$userid'");

                    $followerscount = $query4->num_rows();
                    // get datetime of when a user made his messages backup
                    $backuptime=$this->db->query("select lastbackup from tbl_backupmessages where userid='$userid'");
                    $backup = $backuptime->row_array();

                    $fullname = $row113['firstname']." ".$row113['lastname'];
                    $fullname = rtrim($fullname," ");
                    $message=array("message"=>"User with this Username already exists",'userid'=>$row113['userid'],'username'=>$row113['username'],
                        'number'=>$row113['number']=($row113['number']==null)?"":$row113['number'],'socialtype'=>$row113['social_type'],
                        'followingcount'=>$followingcount,'followerscount'=>$followerscount,'firstname'=>$row113['firstname'],
                        'lastname'=>$row113['lastname'],'logo'=>$logo,'name'=>$fullname,'lastbackup'=>($backup['lastbackup'] == null)?"":$backup['lastbackup']);
                }
                else
                {
                    // Update device token value to empty for OLD User
                    $this->db->query("UPDATE tbl_users SET devicetoken=' ' where devicetoken = '$devicetoken'");
                    $data = array('username'=>$username,'password'=>$password,'number'=>$number,
                        'social_type'=>$logintype,'firstname'=>$firstname,'lastname'=>$lastname,'profile_pic'=>$logo,'email'=>$email,'devicetoken'=>$devicetoken);
                    //mysql insert query
                    $sql = $this->db->insert('tbl_users',$data);

                    if($sql)
                    {
                        $insert_id = $this->db->insert_id();
                        // count for aacks
                        $query5=$this->db->query("select * from tbl_aacks where userid = '$insert_id' and status = '1'");
                        $aackscount = $query5->num_rows();
                        $query=$this->db->query("select * from tbl_users where userid='$insert_id'");
                        $row=$query->row_array();
                        //success message
                        $fullname = $row['firstname']." ".$row['lastname'];
                        $fullname = rtrim($fullname," ");
                        $pic = base_url('images').'/'.$row['profile_pic'];

                        // how many users you are following example A->b,c count for A is 2
                        $querystring=$this->db->query("select followee from tbl_follow where follower = '$insert_id'");
                        $followingcount = $querystring->num_rows();

                        //follower count. Means how many users are following you
                        $query4=$this->db->query("select follower from tbl_follow where followee = '$insert_id'");
                        $followerscount = $query4->num_rows();
                        // get datetime of when a user made his messages backup
                        $backuptime=$this->db->query("select lastbackup from tbl_backupmessages where userid='$insert_id'");
                        $backup = $backuptime->row_array();
                        /* $message=array("message"=>"Successfully Inserted",'userid'=>$row['userid'],'username'=>$row['username'],
                        'number'=>$row['number']=($row['number']==null)?"":$row['number'],'followingcount'=>'0','followerscount'=>'0',
                        'firstname'=>$row['firstname'],'lastname'=>$row['lastname'],'logo'=>$logo,'name'=>$fullname); */


                        $message=array("message"=>"Successfully Inserted",'userid'=>$row['userid'],'username'=>$row['username'],'fullname'=>$fullname,
                            'number'=>$row['number']=($row['number']==null)?"":$row['number'],'socialtype'=>$row['social_type'],
                            'followingcount'=>$followingcount,'followerscount'=>$followerscount,'aackscount'=>$aackscount,
                            'profilepic'=>$pic=($pic==null)?"":$pic,'email'=>$row['email'],'lastbackup'=>($backup['lastbackup'] == null)?"":$backup['lastbackup']);//'email'=>$row112['email']
                    }
                    else
                    {
                        //failed message
                        $message=array("message"=>"Failed to Insert");
                    }

                }
                //$message = array("message"=>"device already registered");
            }
            elseif($countdevices <= '0')
            {
				
                $query112=$this->db->query("select * from tbl_users where email='$email'");
                $row112=$query112->row_array();

                $query113=$this->db->query("select * from tbl_users where username='$username'");
                $row113=$query113->row_array();

                if($query112->num_rows() > 0)
                {
                    $userid = $row112['userid'];
                    // how many users you are following example A->b,c count for A is 2
                    $querystring=$this->db->query("select followee from tbl_follow where follower = '$userid'");

                    $followingcount = $querystring->num_rows();

                    //follower count. Means how many users are following you

                    $query4=$this->db->query("select follower from tbl_follow where followee = '$userid'");

                    $followerscount = $query4->num_rows();
                    // get datetime of when a user made his messages backup
                    $backuptime=$this->db->query("select lastbackup from tbl_backupmessages where userid='$userid'");
                    $backup = $backuptime->row_array();

                    $fullname = $row112['firstname']." ".$row112['lastname'];
                    $fullname = rtrim($fullname," ");
                    $message=array("message"=>"User with this Email already exists",'userid'=>$row112['userid'],'username'=>$row112['username'],
                        'number'=>$row112['number']=($row112['number']==null)?"":$row112['number'],'socialtype'=>$row112['social_type'],
                        'followingcount'=>$followingcount,'followerscount'=>$followerscount,'firstname'=>$row112['firstname'],
                        'lastname'=>$row112['lastname'],'logo'=>$logo,'name'=>$fullname,'lastbackup'=>($backup['lastbackup'] == null)?"":$backup['lastbackup']);
                }
                elseif($query113->num_rows() > 0)
                {
                    $userid = $row113['userid'];
                    // how many users you are following example A->b,c count for A is 2
                    $querystring=$this->db->query("select followee from tbl_follow where follower = '$userid'");

                    $followingcount = $querystring->num_rows();

                    //follower count. Means how many users are following you

                    $query4=$this->db->query("select follower from tbl_follow where followee = '$userid'");

                    $followerscount = $query4->num_rows();
                    // get datetime of when a user made his messages backup
                    $backuptime=$this->db->query("select lastbackup from tbl_backupmessages where userid='$userid'");
                    $backup = $backuptime->row_array();

                    $fullname = $row113['firstname']." ".$row113['lastname'];
                    $fullname = rtrim($fullname," ");
                    $message=array("message"=>"User with this Username already exists",'userid'=>$row113['userid'],'username'=>$row113['username'],
                        'number'=>$row113['number']=($row113['number']==null)?"":$row113['number'],'socialtype'=>$row113['social_type'],
                        'followingcount'=>$followingcount,'followerscount'=>$followerscount,'firstname'=>$row113['firstname'],
                        'lastname'=>$row113['lastname'],'logo'=>$logo,'name'=>$fullname,'lastbackup'=>($backup['lastbackup'] == null)?"":$backup['lastbackup']);
                }
                else
                {
					
                  //  $data = array('username'=>$username,'password'=>$password,'number'=>$number,
                    //    'social_type'=>$logintype,'firstname'=>$firstname,'lastname'=>$lastname,'profile_pic'=>$logo,'email'=>$email,'devicetoken'=>$devicetoken);
                    //mysql insert query
					$this->db->set('username',$username);
					$this->db->set('password',$password);
					$this->db->set('number',$number);
					$this->db->set('social_type',$logintype);
					$this->db->set('firstname',$firstname);
					$this->db->set('lastname',$lastname);
					$this->db->set('profile_pic',$logo);
					$this->db->set('email',$email);
					$this->db->set('devicetoken',$devicetoken);
                    $sql = $this->db->insert('tbl_users');
					//echo $this->db->_error_message();
					//$sql = $this->db->insert('tbl_users',$data);
					
                    if($sql)
                    {
                        $insert_id = $this->db->insert_id();
                        // count for aacks
                        $query5=$this->db->query("select * from tbl_aacks where userid = '$insert_id' and status = '1'");
                        $aackscount = $query5->num_rows();
                        $query=$this->db->query("select * from tbl_users where userid='$insert_id'");
                        $row=$query->row_array();
                        //success message
                        $fullname = $row['firstname']." ".$row['lastname'];
                        $fullname = rtrim($fullname," ");
                        $pic = base_url('images').'/'.$row['profile_pic'];

                        // how many users you are following example A->b,c count for A is 2
                        $querystring=$this->db->query("select followee from tbl_follow where follower = '$insert_id'");
                        $followingcount = $querystring->num_rows();

                        //follower count. Means how many users are following you
                        $query4=$this->db->query("select follower from tbl_follow where followee = '$insert_id'");
                        $followerscount = $query4->num_rows();
                        // get datetime of when a user made his messages backup
                        $backuptime=$this->db->query("select lastbackup from tbl_backupmessages where userid='$insert_id'");
                        $backup = $backuptime->row_array();
                        /* $message=array("message"=>"Successfully Inserted",'userid'=>$row['userid'],'username'=>$row['username'],
                        'number'=>$row['number']=($row['number']==null)?"":$row['number'],'followingcount'=>'0','followerscount'=>'0',
                        'firstname'=>$row['firstname'],'lastname'=>$row['lastname'],'logo'=>$logo,'name'=>$fullname); */


                        $message=array("message"=>"Successfully Inserted",'userid'=>$row['userid'],'username'=>$row['username'],'fullname'=>$fullname,
                            'number'=>$row['number']=($row['number']==null)?"":$row['number'],'socialtype'=>$row['social_type'],
                            'followingcount'=>$followingcount,'followerscount'=>$followerscount,'aackscount'=>$aackscount,
                            'profilepic'=>$pic=($pic==null)?"":$pic,'email'=>$row['email'],'lastbackup'=>($backup['lastbackup'] == null)?"":$backup['lastbackup']);//'email'=>$row112['email']
                    }
                    else
                    {
						
                        //failed message
                        $message=array("message"=>"Failed to Insert");
                    }

                }
            }
        }
        else
        {
            //message if mandatory fields not given
            $message=array("message"=>"provide values",'username'=>$username,'number'=>$number,'social_type'=>$logintype,'password'=>$password,
                'firstname'=>$firstname,'lastname'=>$lastname,'email'=>$email,'logo'=>$logo);




        }
        echo json_encode($message);
    }

    // login users

    function loginUser($username,$password,$logintype,$devicetoken)
    {
        
        //mandory fields
        if(!empty($username) && !empty($password) && !empty($logintype))
        {
            

            // check validation
            $query1=$this->db->query("select * from tbl_users where username='$username' and password='$password' and social_type = '$logintype'");
            $row1=$query1->row_array();
            if($query1->num_rows() > 0)
            {
                
                $userid = $row1['userid'];
                // how many users you are following example A->b,c count for A is 2
                $querystring=$this->db->query("select followee from tbl_follow where follower = '$userid'");

                $followingcount = $querystring->num_rows();
                $followstatus=false;
                if($followingcount>0)
                {

                    $followstatus=true;
                }

                //follower count. Means how many users are following you

                $query4=$this->db->query("select follower from tbl_follow where followee = '$userid'");

                $followerscount = $query4->num_rows();

                // count for aacks
                $query5=$this->db->query("select * from tbl_aacks where userid = '$userid' and status = '1'");

                $aackscount = $query5->num_rows();
                // picture
                $pic = base_url('images').'/'.$row1['profile_pic'];
                $fullname = $row1['firstname']." ".$row1['lastname'];
                // remove if any spaces at the end of the word
                $fullname = rtrim($fullname," ");
                // update online_status to 1

                $updating = array('online_status' => '1');

                $this->db->where('userid', $userid);
                $this->db->update('tbl_users', $updating);
                $backuptime=$this->db->query("select lastbackup from tbl_backupmessages where userid='$userid'");
                $backup = $backuptime->row_array();

                $message=array("message"=>"success",'userid'=>$row1['userid'],'username'=>$row1['username'],'fullname'=>$fullname,
                    'number'=>$row1['number']=($row1['number']==null)?"":$row1['number'],'socialtype'=>$row1['social_type'],
                    'followingcount'=>$followingcount,'followerscount'=>$followerscount,'followstatus'=>$followstatus,'aackscount'=>$aackscount,
                    'profilepic'=>$pic=($pic==null)?"":$pic,'email'=>$row1['email'],'lastbackup'=>($backup['lastbackup'] == null)?"":$backup['lastbackup']);
            }
            else
            {

                //failed message
                $message=array("message"=>"login failed");


            }
        }
        else
        {
            //message if mandatory fields not given
            $message=array("message"=>"provide values",'username'=>$username,'password'=>$password,'logintype'=>$logintype);
        }
        echo json_encode($message);
    }


}

?>