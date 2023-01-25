<!DOCTYPE html>
<html>
	<head>
		<title>Add User</title>
	</head>
	<body>
		<?php echo form_open_multipart('index.php/userprofile/update');?>	
			userid : <input type="text" name="userid"/><br/><br/>
			firstname :  <input type="text" name="firstname"/><br/><br/>
			lastname :  <input type="test" name="lastname"/><br/><br/>
			username :  <input type="test" name="username"/><br/><br/>
			
			password :  <input type="test" name="password"/><br/><br/>
			email :  <input type="test" name="email"/><br/><br/>
			number :  <input type="test" name="number"/><br/><br/>
			
			
			Image : <input type="file" name="logo"/><br/><br/>
		
			<input type="submit" value="Add"/>
		<?php echo  form_close();?>
	</body>
</html>