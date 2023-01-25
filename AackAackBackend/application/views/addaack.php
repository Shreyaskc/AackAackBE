<!DOCTYPE html>
<html>
	<head>
		<title>Add Aack</title>
	</head>
	<body>
		<?php echo form_open_multipart('index.php/api/addAack');?>	
			UserId : <input type="text" name="userid"/><br/><br/>
			
			number : <input type="text" name="number"/><br/><br/>
			lastmessage : <input type="text" name="lastmessage"/><br/><br/>
		
			devicedatetime : <input type="text" name="devicedatetime"/><br/><br/>
		
			Image : <input type="file" name="logo"/><br/><br/>
			Image : <input type="file" name="thumb"/><br/><br/>
			<input type="submit" value="Add"/>
		<?php echo  form_close();?>
	</body>
</html>