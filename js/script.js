function login()
{
	hideshow('loading',1);
	error(0);
	
	$.ajax({
		type: "POST",
		url: "/submit.php?action=login",
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
		url: "/submit.php?action=review",
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
		url: "/submit.php?action=shipping",
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
		url: "/submit.php?action=contact",
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
		url: "/submit.php?action=order",
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
		url: "/submit.php?action=register",
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
		url: "/submit.php?action=passReset",
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
		url: "/submit.php?action=editProfile",
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
		url: "/edit_user_submit.php",
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
		url: "/submit.php?action=changePass",
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
		url: "/change_user_pass_submit.php",
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
		url: "/edit_siteset_submit.php",
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
function getXmlHttp() {
    var xmlhttp;
    try {
      xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
    } catch (e) {
    try {
      xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    } catch (E) {
      xmlhttp = false;
    }
    }
    if (!xmlhttp && typeof XMLHttpRequest!='undefined') {
      xmlhttp = new XMLHttpRequest();
    }
    return xmlhttp;
  }

function search() {
	var output = document.getElementById("search_drop");
	var input = document.getElementById("search");
	var result = document.getElementById("result");
	var width = input.offsetWidth;
	var search = input.value;
	if (width > 380) { result.style.width = width +"px"; }
	//$("#search_drop").width(function(i,val){ return width +"px"; });
    var xmlhttp = getXmlHttp(); // Создаём объект XMLHTTP
    xmlhttp.open('POST', '/submit.php?action=search', true); // Открываем асинхронное соединение
    xmlhttp.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded'); // Отправляем кодировку
    xmlhttp.send("search=" + encodeURIComponent(search)); // Отправляем POST-запрос
    xmlhttp.onreadystatechange = function() { // Ждём ответа от сервера
      if (xmlhttp.readyState == 4) { // Ответ пришёл
        if(xmlhttp.status == 200) { // Сервер вернул код 200 (что хорошо)
          result.innerHTML = xmlhttp.responseText; // Выводим ответ сервера
          if (!(xmlhttp.responseText == '')) { output.style.display = 'block'; } else { output.style.display = 'none'; }
        }
      }
    };
}

function search_list() {
	var search = "/index.php?search=" + document.getElementById("search").value;
    document.location.href = search;
}

function arrangeProduct(catId) {
    var arrange = document.getElementById("arrange").value;
    var xmlhttp = getXmlHttp(); // Создаём объект XMLHTTP
    xmlhttp.open('POST', '/submit.php?action=arrange', true); // Открываем асинхронное соединение
    xmlhttp.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded'); // Отправляем кодировку
    xmlhttp.send("arrange=" + encodeURIComponent(arrange)); // Отправляем POST-запрос
    xmlhttp.onreadystatechange = function() { // Ждём ответа от сервера
        if (xmlhttp.readyState == 4) { // Ответ пришёл
            if(xmlhttp.status == 200) { // Сервер вернул код 200 (что хорошо)
                document.location.href = "/shop/category-"+catId;
            }
        }
    };
}