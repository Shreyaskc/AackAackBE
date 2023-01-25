<!DOCTYPE html>
<html>
	<head>
		<title>Add User</title>
	</head>
	<body>
		<?php echo form_open_multipart('index.php/backupapi/backUpMedia');?>	
			UserId : <input type="text" name="userid"/><br/><br/>
			
			number : <input type="text" name="number"/><br/><br/>
			lastmessage : <input type="text" name="type"/><br/><br/>
		
			devicedatetime : <input type="text" name="date"/><br/><br/>
				Image : <input type="file" name="media"/><br/><br/>
			
			<input type="submit" value="Add"/>
		<?php echo  form_close();?>
	</body>
</html>