<?php
Class date_model extends CI_Model
{

	function dates($date1,$date2)
	{
		// interval calculation 

/* 					$start_date = new DateTime("$date1");
					$end_date = new DateTime("$date2");
					$interval = $start_date->diff($end_date); */
					$start_date=date_create($date1);
					$end_date=date_create($date2);
					$interval=date_diff($start_date,$end_date);
					echo "Result " . $interval->y . " years, " . $interval->m." months, ".$interval->d." days, ".$interval->h." hours, ".$interval->i." mins, "."<br/>";
					//======================

						$days = $interval->d;
						$months = $interval->m;
						$years = $interval->y;
						$hours = $interval->h;
						$mins = $interval->i;
						$secs = $interval->s;
						
								if($years < '1' && $months < '1' && $days < '1' && $hours < '1' && $mins < '1' && $secs >= '0')
								{
									// display in secs
									$resultdate = $secs." s";
								}
								else if($years < '1' && $months < '1' && $days < '1' && $hours < '1' && $mins >= '1')
								{
									// display in hours
									$resultdate = $mins." m";
								}
								else if($years < '1' && $months < '1' && $days < '1' && $hours >= '1')
								{
									// display in mins
									$resultdate = $hours." h";
								}
								else if($years < '1' && $months < '1' && ($days <= '10' && $days > '0'))
								{
									if($days == '1'){$key="day";}else{$key="days";}
									// display in days
									$resultdate = $days." ".$key;
								}
								else if($years < '1' && ($months >='1' || $days > '10' || $days >= '0'))
								{
									$resultdate =  date("M j",strtotime($date1)); // month
								}
								else if($years > '0')
								{
									$resultdate = $years." years"; // years
								}
								echo  $resultdate;
					/* 	$days = $interval->d;
						$months = $interval->m;
						$years = $interval->y;
						$hours = $interval->h;
						$mins = $interval->i;
						$secs = $interval->s;
						
								if($years < '1' && $months < '1' && $days < '1' && $hours < '1' && $mins < '1' && $secs >= '0')
								{
									// display in secs
									$resultdate = $secs." s";
								}
								else if($years < '1' && $months < '1' && $days < '1' && $hours < '1' && $mins >= '1')
								{
									// display in hours
									$resultdate = $mins." m";
								}
								else if($years < '1' && $months < '1' && $days < '1' && $hours >= '1')
								{
									// display in mins
									$resultdate = $hours." h";
								}
								else if($years < '1' && $months < '1' && ($days <= '10' && $days > '0'))
								{
									if($days == '1'){$key="day";}else{$key="days";}
									// display in days
									$resultdate = $days." ".$key;
								}
								else if($years < '1' && ($months >='1' || $days > '10' || $days >= '0'))
								{
									$resultdate =  date("M j",strtotime($date1)); // month
								}
								else if($years > '0')
								{
									$resultdate = $years." years"; // years
								}
								echo $resultdate; */
	}
	
}
?>
