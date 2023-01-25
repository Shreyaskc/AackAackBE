<!DOCTYPE html>
<html lang="en">
	<head>
	
		<script src="<?=base_url()?>js/jquery-1.8.3.min.js"></script>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="description" content="">
		<meta name="author" content="">
			<!-- Le styles -->
		<link href="<?=base_url()?>assets/css/bootstrap.css" rel="stylesheet">
		<link href="<?=base_url()?>assets/css/bootstrap-responsive.css" rel="stylesheet">
		
	</head>
	<body>
		<div class="container-fluid" style="background-color: rgb(37, 41, 39);">
			<div class="row-fluid">

			</div>
		<?php
		//print_r($results)."<br/>";
		$data =  json_decode($results);
		//print_r($data)."<br/>";
		foreach($data as $value)
		{
			$messagebody = $value->{'message'};
			$messagetype = $value->{'type'};
			if($messagetype == '1')
			{
			?>
						<div class="clearfix"></div>
				<div class="row-fluid">
					<div class = "span4 pull-right">
						<div class="batch" style="float:right;background-color:rgb(131, 28, 28);margin-left:30%;">
							<p style="color:white;text-align:justify;"><?php echo $messagebody;?><div class="clearfix"></div></p>
							
						</div>
						
					</div>
				</div>
				<div class="row-fluid">
					<div class="clearfix"></div>
				</div>
			<?php
			}
			elseif($messagetype == '2')
			{
			?>
				
				<div class="row-fluid">
					<div class = "span4 pull-left">
					<div class="batch" style="float:left;background-color:rgb(14, 121, 44);margin-right:30%;">
						<p style="color:white;text-align:justify;"><?php echo $messagebody;?><div class="clearfix"></div></p>
						
					</div>
					
					</div>
				</div>
				<div class="row-fluid">
					<div class="clearfix"></div>
				</div>
					
			<?php
			}
			?>
		<div class="clearfix"></div>
		<?php
		}
		?>
			
		</div>
	</body>
</html>