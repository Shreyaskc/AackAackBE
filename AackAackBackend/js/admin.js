// request window popup
function contNavigateReq() {
	if ($('#containerBtmReq').css('top') == '-28px')
	{
		$('.btmToggleAreaReq').css('display', 'block');
		$('#containerBtmReq').animate({ 'top': '-393px' }, 1000, function () { });
		$('#containerBtmRes').animate({ 'top': '-28px' }, 1000, function () { $('.btmToggleAreaRes').css('display', 'none'); });
		$('#containerBtmErr').animate({ 'top': '-28px' }, 1000, function () { $('.btmToggleAreaErr').css('display', 'none'); });
	} 
	else
	{
		$('.btmToggleAreaReq').css('display', 'block');
		$('#containerBtmReq').animate({ 'top': '-28px' }, 1000, function () { $('.btmToggleAreaReq').css('display', 'none'); });
	}
}

 // response window popup
function contNavigateRes() {
	if ($('#containerBtmRes').css('top') == '-28px') 
	{
		$('.btmToggleAreaRes').css('display', 'block');
		$('#containerBtmRes').animate({ 'top': '-393px' }, 1000, function () { });
		$('#containerBtmReq').animate({ 'top': '-28px' }, 1000, function () {$('.btmToggleAreaReq').css('display', 'none');});
		$('#containerBtmErr').animate({ 'top': '-28px' }, 1000, function () {$('.btmToggleAreaErr').css('display', 'none');});
	} 
	else 
	{
		$('.btmToggleAreaRes').css('display', 'block');
		$('#containerBtmRes').animate({ 'top': '-28px' }, 1000, function () { $('.btmToggleAreaRes').css('display', 'none');});
	}
}
	
//error window popup
function contNavigateErr() {
	if ($('#containerBtmErr').css('top') == '-28px') 
	{
		$('.btmToggleAreaErr').css('display', 'block');
		$('#containerBtmErr').animate({ 'top': '-393px' }, 1000, function () { });
		$('#containerBtmReq').animate({ 'top': '-28px' }, 1000, function () { $('.btmToggleAreaReq').css('display', 'none'); });
		$('#containerBtmRes').animate({ 'top': '-28px' }, 1000, function () { $('.btmToggleAreaRes').css('display', 'none'); });
	} 
	else
	{
		$('.btmToggleAreaErr').css('display', 'block');
		$('#containerBtmErr').animate({ 'top': '-28px' }, 1000, function () { $('.btmToggleAreaErr').css('display', 'none'); });
	}
}

//clear the text in the popup windows
$(function()
{
	$('#wog_note').maxlength();
	var createddate=$('#createddate').val();
	var modifieddate=$('#modifieddate').val();
	
	//facebook tab popup
  	$('#facebook').click(function()
	{
		$('#facebook_login').toggle();
		$('#twitter_login').hide();
	});


	//twitter tab popup
	$('#twitter').click(function()
	{
		$('#twitter_login').toggle();
		$('#facebook_login').hide();
	});


	// general registration 
	$('#register').click(function()
	{
		var email=$('.s1').val();
		var password=$('.s2').val();
		var devicetoken=$('.s3').val();
		var devicetype=$('.s4').val();
		var logintype=$('.s5').val();
		$.ajax(
		{
			type: 'POST',
			url: base_url+'registration/signup',
			data:'email='+email+'&password='+password+'&devicetoken='+devicetoken+'&devicetype='+devicetype+'&logintype='+logintype+'&createddate='+createddate+'&modifieddate='+modifieddate,
			success: function(e)
			{      
				var response=e;
				var data=JSON.parse(response);	        
				var message=data.message;
				
				if(message=="provide values")
				{	
					$('#box1').hide(); 
					$('.btmToggleAreaReq .body .texArea #txtRequest').html(response);
					$('.btmToggleAreaReq').css('display', 'block');
					$('#containerBtmReq').animate({ 'top': '-393px' }, 1000, function () { });
					$('#containerBtmErr').animate({ 'top': '-28px' }, 1000, function () {
					$('.btmToggleAreaErr').css('display', 'none'); });
					$('#containerBtmRes').animate({ 'top': '-28px' }, 1000, function () {
					$('.btmToggleAreaRes').css('display', 'none');
					});
				}
				else 
				{   
					var userid=data.userid;
					$('#box1').show();
					$('#box1').load(base_url+'profile/getuser?userid='+userid);	
					$('.btmToggleAreaRes .body .texArea #txtResponse').html(response);
					$('.btmToggleAreaRes').css('display', 'block');
					$('#containerBtmRes').animate({ 'top': '-393px' }, 1000, function () { });
					$('#containerBtmReq').animate({ 'top': '-28px' }, 1000, function () {
					$('.btmToggleAreaReq').css('display', 'none'); });
					$('#containerBtmErr').animate({ 'top': '-28px' }, 1000, function () {
					$('.btmToggleAreaErr').css('display', 'none');
					});
				}	 
			},
			error: function()
			{
				alert('error');
			}

		});
	});

	// general login 
	$('#login').click(function()
	{
		var email=$('.log1').val();
		var password=$('.log2').val();
		var logintype=$('.log3').val();
		var devicetoken=$('.log4').val();
		$.ajax(
		{
			type: 'POST',
			url: base_url+'registration/login',
			data:'email='+email+'&password='+password+'&logintype='+logintype+'&devicetoken='+devicetoken,
			success: function(e)
			{     
				var response=e;
				var data=JSON.parse(response);
				var message=data.message;

				if(message=="login success")
				{	
					var userid=data.userid;
					$('#box1').show();
					$('#box1').load(base_url+'profile/getuser?userid='+userid);		
					$('.btmToggleAreaRes .body .texArea #txtResponse').html(response);
					$('.btmToggleAreaRes').css('display', 'block');
					$('#containerBtmRes').animate({ 'top': '-393px' }, 1000, function () { });
					$('#containerBtmReq').animate({ 'top': '-28px' }, 1000, function () {
					$('.btmToggleAreaReq').css('display', 'none'); });
					$('#containerBtmErr').animate({ 'top': '-28px' }, 1000, function () {
					$('.btmToggleAreaErr').css('display', 'none');
					}); 

				}
				else if(message=="provide values")
				{	
					$('#box1').hide(); 
					$('.btmToggleAreaReq .body .texArea #txtRequest').html(response);
					$('.btmToggleAreaReq').css('display', 'block');
					$('#containerBtmReq').animate({ 'top': '-393px' }, 1000, function () { });
					$('#containerBtmErr').animate({ 'top': '-28px' }, 1000, function () {
					$('.btmToggleAreaErr').css('display', 'none'); });
					$('#containerBtmRes').animate({ 'top': '-28px' }, 1000, function () {
					$('.btmToggleAreaRes').css('display', 'none');
					});

				}
				else
				{        
					$('#box1').hide(); 
					$('.btmToggleAreaErr .body .texArea #txtError').html(response);
					$('.btmToggleAreaErr').css('display', 'block');
					$('#containerBtmErr').animate({ 'top': '-393px' }, 1000, function () { });
					$('#containerBtmReq').animate({ 'top': '-28px' }, 1000, function () {
					$('.btmToggleAreaReq').css('display', 'none'); });
					$('#containerBtmRes').animate({ 'top': '-28px' }, 1000, function () {
					$('.btmToggleAreaRes').css('display', 'none');
					});	    
				}
			},
			error: function()
			{
				alert('error');
			}
		});
	});


	// facebook registration
	$('#facebook_register').click(function()
	{
		var socialid=$('.f1').val();
		var socialusername=$('.f2').val();
		var devicetoken=$('.f3').val();
		var devicetype=$('.f4').val();
		var logintype=$('.f5').val();
		$.ajax(
		{
			type: 'POST',
			url: base_url+'registration/login',
			data:'socialid='+socialid+'&socialusername='+socialusername+'&devicetoken='+devicetoken+'&devicetype='+devicetype+'&logintype='+logintype+'&createddate='+createddate+'&modifieddate='+modifieddate,
			success: function(e)
			{           
				var response=e;
				var data=JSON.parse(response);
				var message=data.message;
				if(message=="successfully inserted")
				{		  
					var userid=data.userid;
					$('#box1').show();
					$('#box1').load(base_url+'profile/getuser?userid='+userid);		
					$('.btmToggleAreaRes .body .texArea #txtResponse').html(response);
					$('.btmToggleAreaRes').css('display', 'block');
					$('#containerBtmRes').animate({ 'top': '-393px' }, 1000, function () { });
					$('#containerBtmReq').animate({ 'top': '-28px' }, 1000, function () {
					$('.btmToggleAreaReq').css('display', 'none'); });
					$('#containerBtmErr').animate({ 'top': '-28px' }, 1000, function () {
					$('.btmToggleAreaErr').css('display', 'none');
					});
				}
				else
				{	
					$('#box1').hide(); 
					$('.btmToggleAreaReq .body .texArea #txtRequest').html(response);
					$('.btmToggleAreaReq').css('display', 'block');
					$('#containerBtmReq').animate({ 'top': '-393px' }, 1000, function () { });
					$('#containerBtmErr').animate({ 'top': '-28px' }, 1000, function () {
					$('.btmToggleAreaErr').css('display', 'none'); });
					$('#containerBtmRes').animate({ 'top': '-28px' }, 1000, function () {
					$('.btmToggleAreaRes').css('display', 'none');
					});

				}
			},
			error: function()
			{
				alert('error');
			}
		});
	});

	// twitter registration 
	$('#twitter_register').click(function()
	{
		var socialid=$('.t1').val();
		var socialusername=$('.t2').val();
		var devicetoken=$('.t3').val();
		var devicetype=$('.t4').val();
		var logintype=$('.t5').val();

		$.ajax(
		{
			type: 'POST',
			url: base_url+'registration/login',
			data:'socialid='+socialid+'&socialusername='+socialusername+'&devicetoken='+devicetoken+'&devicetype='+devicetype+'&logintype='+logintype+'&createddate='+createddate+'&modifieddate='+modifieddate,
			success: function(e)
			{           
				var response=e;
				var data=JSON.parse(response);
				var message=data.message;
				if(message=="successfully inserted")
				{		  
					var userid=data.userid;
					$('#box1').show();
					$('#box1').load(base_url+'profile/getuser?userid='+userid);		
					$('.btmToggleAreaRes .body .texArea #txtResponse').html(response);
					$('.btmToggleAreaRes').css('display', 'block');
					$('#containerBtmRes').animate({ 'top': '-393px' }, 1000, function () { });
					$('#containerBtmReq').animate({ 'top': '-28px' }, 1000, function () {
					$('.btmToggleAreaReq').css('display', 'none'); });
					$('#containerBtmErr').animate({ 'top': '-28px' }, 1000, function () {
					$('.btmToggleAreaErr').css('display', 'none');
					});
				}
				else
				{	
					$('#box1').hide(); 
					$('.btmToggleAreaReq .body .texArea #txtRequest').html(response);
					$('.btmToggleAreaReq').css('display', 'block');
					$('#containerBtmReq').animate({ 'top': '-393px' }, 1000, function () { });
					$('#containerBtmErr').animate({ 'top': '-28px' }, 1000, function () {
					$('.btmToggleAreaErr').css('display', 'none'); });
					$('#containerBtmRes').animate({ 'top': '-28px' }, 1000, function () {
					$('.btmToggleAreaRes').css('display', 'none');
					});

				}

			},
			error: function()
			{
			alert('error');
			}
		});
	});

	// forgot password 
	$('#forgot_pwd').click(function()
	{
		var email=$('.fe1').val();
		$.ajax(
		{
			type: 'POST',
			url: base_url+'registration/forgotpassword?email='+email,
			success: function(e)
			{             
				var response=e;
				var data=JSON.parse(response);	        
				var message=data.message;

				if(message=="mail successfully sent")
				{
					$('#box1').hide(); 
					$('.btmToggleAreaRes .body .texArea #txtResponse').html(response);
					$('.btmToggleAreaRes').css('display', 'block');
					$('#containerBtmRes').animate({ 'top': '-393px' }, 1000, function () { });
					$('#containerBtmReq').animate({ 'top': '-28px' }, 1000, function () {
					$('.btmToggleAreaReq').css('display', 'none'); });
					$('#containerBtmErr').animate({ 'top': '-28px' }, 1000, function () {
					$('.btmToggleAreaErr').css('display', 'none');
					});
				}

				else if(message=="provide values")
				{	
					$('#box1').hide(); 
					$('.btmToggleAreaReq .body .texArea #txtRequest').html(response);
					$('.btmToggleAreaReq').css('display', 'block');
					$('#containerBtmReq').animate({ 'top': '-393px' }, 1000, function () { });
					$('#containerBtmErr').animate({ 'top': '-28px' }, 1000, function () {
					$('.btmToggleAreaErr').css('display', 'none'); });
					$('#containerBtmRes').animate({ 'top': '-28px' }, 1000, function () {
					$('.btmToggleAreaRes').css('display', 'none');
					});
				}
				else 
				{   
					$('#box1').hide(); 
					$('.btmToggleAreaErr .body .texArea #txtError').html(response);
					$('.btmToggleAreaErr').css('display', 'block');
					$('#containerBtmErr').animate({ 'top': '-393px' }, 1000, function () { });
					$('#containerBtmReq').animate({ 'top': '-28px' }, 1000, function () {
					$('.btmToggleAreaReq').css('display', 'none'); });
					$('#containerBtmRes').animate({ 'top': '-28px' }, 1000, function () {
					$('.btmToggleAreaRes').css('display', 'none');
					});      
				}
			},
			error: function()
			{
				alert('error');
			}
		});
	});

	// get user
	$('#get_user').click(function()
	{
		var userid=$('.gu1').val();
		$.ajax(
		{
			type: 'POST',
			url: base_url+'registration/getuser?userid='+userid,
			success: function(e)
			{     
				var response=e;
				var data=JSON.parse(response);
				var message=data.message;	
				if(message=="userid not exists")
				{	
					$('#box1').hide(); 
					$('.btmToggleAreaErr .body .texArea #txtError').html(response);
					$('.btmToggleAreaErr').css('display', 'block');
					$('#containerBtmErr').animate({ 'top': '-393px' }, 1000, function () { });
					$('#containerBtmReq').animate({ 'top': '-28px' }, 1000, function () {
					$('.btmToggleAreaReq').css('display', 'none'); });
					$('#containerBtmRes').animate({ 'top': '-28px' }, 1000, function () {
					$('.btmToggleAreaRes').css('display', 'none');
					});  

				}
					
				else if(message=="provide values")
				{	
					$('#box1').hide(); 
					$('.btmToggleAreaReq .body .texArea #txtRequest').html(response);
					$('.btmToggleAreaReq').css('display', 'block');
					$('#containerBtmReq').animate({ 'top': '-393px' }, 1000, function () { });
					$('#containerBtmErr').animate({ 'top': '-28px' }, 1000, function () {
					$('.btmToggleAreaErr').css('display', 'none'); });
					$('#containerBtmRes').animate({ 'top': '-28px' }, 1000, function () {
					$('.btmToggleAreaRes').css('display', 'none');
					});

				}
				else
				{
					$('#box1').show(); 
					$('#box1').load(base_url+'profile/getuser?userid='+userid);	
					$('.btmToggleAreaRes .body .texArea #txtResponse').html(response);
					$('.btmToggleAreaRes').css('display', 'block');
					$('#containerBtmRes').animate({ 'top': '-393px' }, 1000, function () { });
					$('#containerBtmReq').animate({ 'top': '-28px' }, 1000, function () {
					$('.btmToggleAreaReq').css('display', 'none'); });
					$('#containerBtmErr').animate({ 'top': '-28px' }, 1000, function () {
					$('.btmToggleAreaErr').css('display', 'none');
					}); 
				}   
			},
			error: function()
			{
				alert('error');
			}
		});
	});
 
	// update user 
	$('#update_user').click(function()
	{
		var userid=$('.up1').val();
		$.ajax(
		{
			type: 'POST',
			url: base_url+'registration/getuser?userid='+userid,
			success: function(e)
			{     
				var response=e;
				var data=JSON.parse(response);
				var message=data.message;	
				if(message=="userid not exists")
				{	
					$('#box1').hide(); 
					$('.btmToggleAreaErr .body .texArea #txtError').html(response);
					$('.btmToggleAreaErr').css('display', 'block');
					$('#containerBtmErr').animate({ 'top': '-393px' }, 1000, function () { });
					$('#containerBtmReq').animate({ 'top': '-28px' }, 1000, function () {
					$('.btmToggleAreaReq').css('display', 'none'); });
					$('#containerBtmRes').animate({ 'top': '-28px' }, 1000, function () {
					$('.btmToggleAreaRes').css('display', 'none');
					});  

				}
				else if(message=="provide values")
				{	
					$('#box1').hide(); 
					$('.btmToggleAreaReq .body .texArea #txtRequest').html(response);
					$('.btmToggleAreaReq').css('display', 'block');
					$('#containerBtmReq').animate({ 'top': '-393px' }, 1000, function () { });
					$('#containerBtmErr').animate({ 'top': '-28px' }, 1000, function () {
					$('.btmToggleAreaErr').css('display', 'none'); });
					$('#containerBtmRes').animate({ 'top': '-28px' }, 1000, function () {
					$('.btmToggleAreaRes').css('display', 'none');
					});
				  
				}
				else
				{            
					$('#box1').show(); 
					$('#box1').load(base_url+'profile/userdetails?userid='+userid); 
					$('#containerBtmErr').animate({ 'top': '-28px' }, 1000, function () {
					$('.btmToggleAreaErr').css('display', 'none');}); 
					$('#containerBtmRes').animate({ 'top': '-28px' }, 1000, function () {
					$('.btmToggleAreaRes').css('display', 'none');	});	
				}

			},
			error: function()
			{
				alert('error');
			}
		});
	});


	//Add Wog 
	$('#wog_add').click(function()
	{
		var userid=$('.w1').val();
		var miles=$('.w2').val();
		var time=$('.w3').val();
		var calories=$('.w4').val();
		var heartrate=$('.w5').val();
		var startlatitude=$('.w6').val();
		var startlongitude=$('.w7').val();
		var endlatitude=$('.w8').val();
		var endlongitude=$('.w9').val();
		var waypoints=$('.w10').val();
		var elevation=$('.w11').val();
		$.ajax(
		{		
			type: 'POST',
			url: base_url+'registration/addwog',
			data:'userid='+userid+'&miles='+miles+'&time='+time+'&calories='+calories+'&heartrate='+heartrate
			+'&startlatitude='+startlatitude+'&startlongitude='+startlongitude+'&endlatitude='+endlatitude
			+'&endlongitude='+endlongitude+'&waypoints='+waypoints+'&elevation='+elevation+'&createddate='+createddate+'&modifieddate='+modifieddate,
			success: function(e)
			{           
				var response=e;
				var data=JSON.parse(response);
				var message=data.message;

				if(message=="successfully inserted")
				{	    
					$('#box1').show();
					$("#box1").load(base_url+'profile/getwogdetails?userid='+userid);
					$('.btmToggleAreaRes .body .texArea #txtResponse').html(response);
					$('.btmToggleAreaRes').css('display', 'block');
					$('#containerBtmRes').animate({ 'top': '-393px' }, 1000, function () { });
					$('#containerBtmReq').animate({ 'top': '-28px' }, 1000, function () {
					$('.btmToggleAreaReq').css('display', 'none'); });
					$('#containerBtmErr').animate({ 'top': '-28px' }, 1000, function () {
					$('.btmToggleAreaErr').css('display', 'none');
					});
				}
				else if(message=="provide values")
				{	
						$('#box1').hide(); 
						$('.btmToggleAreaReq .body .texArea #txtRequest').html(response);
						$('.btmToggleAreaReq').css('display', 'block');
						$('#containerBtmReq').animate({ 'top': '-393px' }, 1000, function () { });
						$('#containerBtmErr').animate({ 'top': '-28px' }, 1000, function () {
						$('.btmToggleAreaErr').css('display', 'none'); });
						$('#containerBtmRes').animate({ 'top': '-28px' }, 1000, function () {
						$('.btmToggleAreaRes').css('display', 'none');
						});				  
				}
				else
				{ 
					$('#box1').hide(); 
					$('.btmToggleAreaErr .body .texArea #txtError').html(response);
					$('.btmToggleAreaErr').css('display', 'block');
					$('#containerBtmErr').animate({ 'top': '-393px' }, 1000, function () { });
					$('#containerBtmReq').animate({ 'top': '-28px' }, 1000, function () {
					$('.btmToggleAreaReq').css('display', 'none'); });
					$('#containerBtmRes').animate({ 'top': '-28px' }, 1000, function () {
					$('.btmToggleAreaRes').css('display', 'none');
					}); 
				}	 
			},
			error: function()
			{
				alert('error');
			}
		});
	});

	//get wog
	$('#wog_get').click(function()
	{
		var userid=$('.wg1').val();
		$.ajax(
		{
			type: 'POST',
			url: base_url+'registration/getwog?userid='+userid,
			success: function(e)
			{     
				var response=e;
				var data=JSON.parse(response);
				var message=data.message;

				if(message=="userid not exists")
				{	 	
					$('#box1').hide(); 
					$('.btmToggleAreaErr .body .texArea #txtError').html(response);
					$('.btmToggleAreaErr').css('display', 'block');
					$('#containerBtmErr').animate({ 'top': '-393px' }, 1000, function () { });
					$('#containerBtmReq').animate({ 'top': '-28px' }, 1000, function () {
					$('.btmToggleAreaReq').css('display', 'none'); });
					$('#containerBtmRes').animate({ 'top': '-28px' }, 1000, function () {
					$('.btmToggleAreaRes').css('display', 'none');
					});  
				}
				else if(message=="provide values")
				{	
					$('#box1').hide(); 
					$('.btmToggleAreaReq .body .texArea #txtRequest').html(response);
					$('.btmToggleAreaReq').css('display', 'block');
					$('#containerBtmReq').animate({ 'top': '-393px' }, 1000, function () { });
					$('#containerBtmErr').animate({ 'top': '-28px' }, 1000, function () {
					$('.btmToggleAreaErr').css('display', 'none'); });
					$('#containerBtmRes').animate({ 'top': '-28px' }, 1000, function () {
					$('.btmToggleAreaRes').css('display', 'none');
					});
				}
				else
				{
					$('#box1').show(); 
					$('#box1').load(base_url+'profile/getwogdetails?userid='+userid);
					$('.btmToggleAreaRes .body .texArea #txtResponse').html(response);
					$('.btmToggleAreaRes').css('display', 'block');
					$('#containerBtmRes').animate({ 'top': '-393px' }, 1000, function () { });
					$('#containerBtmReq').animate({ 'top': '-28px' }, 1000, function () {
					$('.btmToggleAreaReq').css('display', 'none'); });
					$('#containerBtmErr').animate({ 'top': '-28px' }, 1000, function () {
					$('.btmToggleAreaErr').css('display', 'none');
					}); 
				}  

			},
			error: function()
			{
				alert('error');
			}

		});
	});

	//update wog 
	$('#wog_update').click(function()
	{
		var userid=$('.wu1').val();
		var wogid=$('.wu2').val();
		$.ajax(
		{
			type: 'POST',
			url: base_url+'profile/getwog?userid='+userid+'&wogid='+wogid,
			success: function(e)
			{     
				var response=e;
				var data=JSON.parse(response);
				var message=data.message;
				if(message=="wogid not exists with the given userid")
				{	 	
					$('#box1').hide(); 
					$('.btmToggleAreaErr .body .texArea #txtError').html(response);
					$('.btmToggleAreaErr').css('display', 'block');
					$('#containerBtmErr').animate({ 'top': '-393px' }, 1000, function () { });
					$('#containerBtmReq').animate({ 'top': '-28px' }, 1000, function () {
					$('.btmToggleAreaReq').css('display', 'none'); });
					$('#containerBtmRes').animate({ 'top': '-28px' }, 1000, function () {
					$('.btmToggleAreaRes').css('display', 'none');
					});  
				}
				else if(message=="provide values")
				{	
					$('#box1').hide(); 
					$('.btmToggleAreaReq .body .texArea #txtRequest').html(response);
					$('.btmToggleAreaReq').css('display', 'block');
					$('#containerBtmReq').animate({ 'top': '-393px' }, 1000, function () { });
					$('#containerBtmErr').animate({ 'top': '-28px' }, 1000, function () {
					$('.btmToggleAreaErr').css('display', 'none'); });
					$('#containerBtmRes').animate({ 'top': '-28px' }, 1000, function () {
					$('.btmToggleAreaRes').css('display', 'none');
					});
				}
				else
				{
					$('#box1').show();          
					$('#box1').load(base_url+'profile/updatewogdetails?userid='+userid+'&wogid='+wogid);
					$('#containerBtmErr').animate({ 'top': '-28px' }, 1000, function () {
					$('.btmToggleAreaErr').css('display', 'none');}); 
					$('#containerBtmRes').animate({ 'top': '-28px' }, 1000, function () {
					$('.btmToggleAreaRes').css('display', 'none');	});	
				} 	
			},
			error: function()
			{
				alert('error');
			}
		});
	});

	//wogdetails  update function
	$('#Send2').click(function()
	{
	var wogid=$('#wogid').val();
	var climate=$('#climate').val();
	var wognote=$('#wog_note').val();
	var modifieddate=$('#modifieddate').val();
	$.ajax({
	   type: 'POST',
		url: base_url+'registration/updatewog',
		data:'wogid='+wogid+'&climate='+climate+'&wognote='+wognote+'&modifieddate='+modifieddate,
		 success: function(e)
		{     
			  
				var response=e;
				$('.btmToggleAreaRes .body .texArea #txtResponse').html(response);
				$('.btmToggleAreaRes').css('display', 'block');
				$('#containerBtmRes').animate({ 'top': '-393px' }, 1000, function () { });
				$('#containerBtmReq').animate({ 'top': '-28px' }, 1000, function () {
				$('.btmToggleAreaReq').css('display', 'none'); });
				$('#containerBtmErr').animate({ 'top': '-28px' }, 1000, function () {
				$('.btmToggleAreaErr').css('display', 'none');
				}); 
				
		},
		error: function()
		{
		  alert('error');
		}
		
		});
	});

	//delete wog
	$('#wog_delete').click(function()
	{
		var userid=$('.wd1').val();
		var wogid=$('.wd2').val();
		$.ajax(
		{
			type: 'POST',
			url: base_url+'registration/deletewog?userid='+userid+'&wogid='+wogid,
			success: function(e)
			{     
				var response=e;
				var data=JSON.parse(response);
				var message=data.message;
				if(message=="wogid not exists with the given userid")
				{	 	
					$('#box1').hide(); 
					$('.btmToggleAreaErr .body .texArea #txtError').html(response);
					$('.btmToggleAreaErr').css('display', 'block');
					$('#containerBtmErr').animate({ 'top': '-393px' }, 1000, function () { });
					$('#containerBtmReq').animate({ 'top': '-28px' }, 1000, function () {
					$('.btmToggleAreaReq').css('display', 'none'); });
					$('#containerBtmRes').animate({ 'top': '-28px' }, 1000, function () {
					$('.btmToggleAreaRes').css('display', 'none');
					});  
				}
				else if(message=="provide values")
				{	
					$('#box1').hide(); 
					$('.btmToggleAreaReq .body .texArea #txtRequest').html(response);
					$('.btmToggleAreaReq').css('display', 'block');
					$('#containerBtmReq').animate({ 'top': '-393px' }, 1000, function () { });
					$('#containerBtmErr').animate({ 'top': '-28px' }, 1000, function () {
					$('.btmToggleAreaErr').css('display', 'none'); });
					$('#containerBtmRes').animate({ 'top': '-28px' }, 1000, function () {
					$('.btmToggleAreaRes').css('display', 'none');
					});
				}
				else
				{
					$('#box1').hide(); 
					$('.btmToggleAreaRes .body .texArea #txtResponse').html(response);
					$('.btmToggleAreaRes').css('display', 'block');
					$('#containerBtmRes').animate({ 'top': '-393px' }, 1000, function () { });
					$('#containerBtmReq').animate({ 'top': '-28px' }, 1000, function () {
					$('.btmToggleAreaReq').css('display', 'none'); });
					$('#containerBtmErr').animate({ 'top': '-28px' }, 1000, function () {
					$('.btmToggleAreaErr').css('display', 'none');
					});
				}   

			},
			error: function()
			{
				alert('error');
			}
		});
	});
});
