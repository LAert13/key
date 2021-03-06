function login()
{
	hideshow('loading',1);
	error(0);
	
	$.ajax({
		type: "POST",
		url: "login_submit.php",		
		data: $('#loginForm').serialize(),
		dataType: "json",
		success: function(msg){
			
			if(!(msg.status))
			{
				error(1,msg.txt);
			}
			else location.replace(msg.txt);
			
			hideshow('loading',0);
		}
	});

}

function review()
{
	hideshow('loading',1);
	error(0);
	
	$.ajax({
		type: "POST",
		url: "review_submit.php",		
		data: $('#reviewForm').serialize(),
		dataType: "json",
		success: function(msg){
			
			if(parseInt(msg.status)==1)
			{
				//hide the form
				$('.form').fadeOut('slow');					
					
				//show the success message
				$('.done').fadeIn('slow');
			}
			else if(parseInt(msg.status)==0)
			{
				error(1,msg.txt);
			}
			
			hideshow('loading',0);
		}
	});

}

function shipping()
{
	hideshow('loading',1);
	error(0);
	
	$.ajax({
		type: "POST",
		url: "include/shipping_submit.php",		
		data: $('#frmCheckout').serialize(),
		dataType: "json",
		success: function(msg){
			
			if(!(msg.status))
			{
				error(1,msg.txt);
			}
			else location.replace(msg.txt);
			
			hideshow('loading',0);
		}
	});

}


function contactus()
{
	hideshow('loading',1);
	error(0);
	
	$.ajax({
		type: "POST",
		url: "contact_submit.php",		
		data: $('#ContactUsForm').serialize(),
		dataType: "json",
		success: function(msg){
			
			if(parseInt(msg.status)==1)
			{
				//hide the form
				$('.form').fadeOut('slow');					
					
				//show the success message
				$('.done').fadeIn('slow');
			}
			else if(parseInt(msg.status)==0)
			{
				error(1,msg.txt);
			}
			
			hideshow('loading',0);
		}
	});

}

function order()
{
	hideshow('loading',1);
	error2(0);
	
	$.ajax({
		type: "POST",
		url: "order_submit.php",		
		data: $('#orderForm').serialize(),
		dataType: "json",
		success: function(msg){
			
			if(parseInt(msg.status)==1)
			{
				//hide the form
				$('.form2').fadeOut('slow');					
					
				//show the success message
				$('.done2').fadeIn('slow');
			}
			else if(parseInt(msg.status)==0)
			{
				error2(1,msg.txt);
			}
			
			hideshow('loading',0);
		}
	});

}

function register()
{
	hideshow('loading',1);
	error(0);
	
	$.ajax({
		type: "POST",
		url: "reg_submit.php",		
		data: $('#regForm').serialize(),
		dataType: "json",
		success: function(msg){
			
			if(parseInt(msg.status)==1)
			{
				//hide the form
				$('.form').fadeOut('slow');					
					
				//show the success message
				$('.done').fadeIn('slow');
			}
			else if(parseInt(msg.status)==0)
			{
				error(1,msg.txt);
			}
			
			hideshow('loading',0);
		}
	});

}

function passreset()
{
	hideshow('loading',1);
	error(0);
	
	$.ajax({
		type: "POST",
		url: "pass_reset_submit.php",		
		data: $('#passreset').serialize(),
		dataType: "json",
		success: function(msg){
			
			if(parseInt(msg.status)==1)
			{
				//hide the form
				$('.form').fadeOut('slow');					
					
				//show the success message
				$('.done').fadeIn('slow');
			}
			else if(parseInt(msg.status)==0)
			{
				error(1,msg.txt);
			}
			
			hideshow('loading',0);
		}
	});

}

function editprofile()
{
	hideshow('loading',1);
	error(0);
	
	$.ajax({
		type: "POST",
		url: "edit_profile_submit.php",		
		data: $('#editprofileForm').serialize(),
		dataType: "json",
		success: function(msg){
			
			if(parseInt(msg.status)==1)
			{
				//hide the form
				$('.form').fadeOut('slow');					
					
				//show the success message
				$('.done').fadeIn('slow');
			}
			else if(parseInt(msg.status)==0)
			{
				error(1,msg.txt);
			}
			
			hideshow('loading',0);
		}
	});

}

function edituser()
{
	hideshow('loading',1);
	error(0);
	
	$.ajax({
		type: "POST",
		url: "edit_user_submit.php",		
		data: $('#edituserForm').serialize(),
		dataType: "json",
		success: function(msg){
			
			if(parseInt(msg.status)==1)
			{
				//hide the form
				$('.form').fadeOut('slow');					
					
				//show the success message
				$('.done').fadeIn('slow');
			}
			else if(parseInt(msg.status)==0)
			{
				error(1,msg.txt);
			}
			
			hideshow('loading',0);
		}
	});

}

function updatepass()
{
	hideshow('loading',1);
	error(0);
	
	$.ajax({
		type: "POST",
		url: "change_pass_submit.php",		
		data: $('#updatepassForm').serialize(),
		dataType: "json",
		success: function(msg){
			
			if(parseInt(msg.status)==1)
			{
				//hide the form
				$('.form').fadeOut('slow');					
					
				//show the success message
				$('.done').fadeIn('slow');
			}
			else if(parseInt(msg.status)==0)
			{
				error(1,msg.txt);
			}
			
			hideshow('loading',0);
		}
	});

}

function updateuserpass()
{
	hideshow('loading',1);
	error(0);
	
	$.ajax({
		type: "POST",
		url: "change_user_pass_submit.php",		
		data: $('#updatepassForm').serialize(),
		dataType: "json",
		success: function(msg){
			
			if(parseInt(msg.status)==1)
			{
				//hide the form
				$('.form').fadeOut('slow');					
					
				//show the success message
				$('.done').fadeIn('slow');
			}
			else if(parseInt(msg.status)==0)
			{
				error(1,msg.txt);
			}
			
			hideshow('loading',0);
		}
	});

}

function editsiteset()
{
	hideshow('loading',1);
	error(0);
	
	$.ajax({
		type: "POST",
		url: "edit_siteset_submit.php",		
		data: $('#sitesetForm').serialize(),
		dataType: "json",
		success: function(msg){
			
			if(parseInt(msg.status)==1)
			{
				//hide the form
				$('.form').fadeOut('slow');					
					
				//show the success message
				$('.done').fadeIn('slow');
			}
			else if(parseInt(msg.status)==0)
			{
				error(1,msg.txt);
			}
			
			hideshow('loading',0);
		}
	});

}

function hideshow(el,act)
{
	if(act) $('#'+el).css('visibility','visible');
	else $('#'+el).css('visibility','hidden');
}

function error(act,txt)
{
	hideshow('error',act);
	if(txt) $('#error').html(txt);
}

function error2(act,txt)
{
	hideshow('error2',act);
	if(txt) $('#error2').html(txt);
}