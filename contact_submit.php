<?php
require_once('library/config.php');
include('library/functions.php');

$sitesettings = getSiteSettings();
$site_email = $sitesettings[0]['site_email'];

	// we check if everything is filled in and perform checks
	$find = "/(content-type|bcc:|cc:)/i";

	if(empty($_SESSION['user_id'])){
		if(!(isset($_SESSION['captcha_keystring']) && $_SESSION['captcha_keystring'] === $_POST['keystring']))
		{
			die(msg(0,"<p>Неверно указан текст на картинке.</p>"));
		} 
	}

	if(!$_POST['username'])
	{
		die(msg(0,"Введите ваше имя."));
	}
	
	elseif(preg_match($find, $_POST['username'])){
		die(msg(0,"В имени присутствуют запрещенные к использованию символы."));
	}

	elseif(!$_POST['email'] || validateEmail($_POST['email']) || preg_match($find, $_POST['email']))
	{
		die(msg(0,"Неправильно введен адрес электронной почты."));
	}

	elseif(!$_POST['message'])
	{
		die(msg(0,"Введите текст сообщения."));
	}
	
	elseif(preg_match($find, $_POST['message']) || strpos($_POST['message'], "&") !== false || strlen(strip_tags($_POST['message'])) < strlen($_POST['message']))
	{
		die(msg(0,"В сообщении присутствуют запрещенные к использованию символы."));
	}

	else
		{
			$res = contactUs($_POST['username'],$_POST['email'],$_POST['message'],$site_email);
				if ($res == 1){
					die(msg(0,"При отправке вашего запроса произошла ошибка. Пожалуйста попробуйте позднее."));
				}
				if ($res == 99){
					die(msg(1,"Спасибо за ваше обращение. Мы рассмотрим его как можно быстрее"));
				}
		}

	function msg($status,$txt)
	{
		return '{"status":'.$status.',"txt":"'.$txt.'"}';
	}

?>
