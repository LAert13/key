<?php
DEFINE('INCLUDE_CHECK',1);
require_once('library/config.php');
include('library/functions.php');

$sitesettings = getSiteSettings();	
$site_url = $sitesettings[0]['site_url'];
//For password recovery

	// we check if everything is filled in and perform checks

	if(!$_POST['email'])
		{
			die(msg(0,"Пожалуйста введите ваш адрес электронной почты."));
		}
	if(validateEmail($_POST['email']))
		{
			die(msg(0,"Неправильно введен адрес электронной почты!"));
		}
		else{
			$res = pass_recovery($_POST['email'],$site_url);
				if($res == 1){
					die(msg(0,"Произошла ошибка при восстановлении пароля. Пожалуйста свяжитесь с администрацией сайта."));
				}
				if($res == 2){
					die(msg(0,"Произошла ошибка базы данных. Пожалуйста свяжитесь с администрацией сайта."));
				}
				if($res == 3){
					die(msg(0,"Введенный адрес электронной почты не совпадает ни с одним адресом в базе данных. Пожалуйста <a href='register'>нажмите здесь</a> для регистрации."));
				}
				if($res == 99){
					die(msg(1,"Временный пароль выслан. Проверьте ваш почтовый ящик для дальнейших инструкций."));
				}
		}

	function msg($status,$txt)
	{
		return '{"status":'.$status.',"txt":"'.$txt.'"}';
	}

?>
