<!DOCTYPE html>
<html>
	<head>
		<title>Add User</title>
	</head>
	<body>
		<?php echo form_open_multipart('index.php/sample/addImage');?>	

			Image : <input type="file" name="logo"/><br/><br/>
			Thumb : <input type="file" name="thumb"/><br/><br/>
			<input type="submit" value="Add"/>
		<?php echo  form_close();?>
	</body>
</html>