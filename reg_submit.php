<?php
require_once('library/config.php');
include('library/functions.php');
$sitesettings = getSiteSettings();
$site_url = $sitesettings[0]['site_url'];
	
//For registration

	// we check if everything is filled in and perform checks
	if(!(isset($_SESSION['captcha_keystring']) && $_SESSION['captcha_keystring'] === $_POST['keystring']))
	{
		die(msg(0,"<p>Неверно указан текст на картинке.</p>"));
	}

	if(!$_POST['regname'])
	{
		die(msg(0,"<p>Пожалуйста укажите логин.</p>"));
	}
	
	if(strlen($_POST['regname'])<3 || strlen($_POST['regname'])>15)
	{
		die(msg(0,"<p>Длинна логина должна быть от 3 до 15 символов.</p>"));
	}

	elseif(uniqueUser($_POST['regname']))
	{
		die(msg(0,"Выбранный логин уже занят."));
	}

	if($_POST['regpass']!=$_POST['confirmation'] )
		{
			die(msg(0,"Введенный пароль не совпадает с его подтвержением."));
		}

	elseif(!$_POST['regpass'])
	{
		die(msg(0,"<p>Пожалуйста введите пароль.</p>"));
	}
	
	elseif(strlen($_POST['regpass'])<5)
	{
		die(msg(0,"<p>Длинна пароля должна быть как минимум 5 символов.</p>"));
	}

	elseif(!$_POST['email'])
	{
		die(msg(0,"<p>Пожалуйста укажите электронную почту.</p>"));
	}
	
	elseif(validateEmail($_POST['email']))
	{
		die(msg(0,"<p>Неправильный адрес электронной почты.</p>"));
	}

	elseif(uniqueEmail($_POST['email']))
	{
		die(msg(0,"<p>Указанный адрес электронной почты уже занят - укажите другой адрес.</p>"));
	}

	else
		{
			$res = addUser($_POST['regname'],$_POST['regpass'],$_POST['email'],$site_url);
				if ($res == 2){
					die(msg(0,"Произошла ошибка при обработке регистрационных данных. Пожалуйста свяжитесь с администрацией сайта."));
				}
				if ($res == 99){
					die(msg(1,"<p>Регистрация успешна! <a href='login'>Нажмите сюда</a> для входа.</p>"));
				}
		}

	function msg($status,$txt)
	{
		return '{"status":'.$status.',"txt":"'.$txt.'"}';
	}

?>
