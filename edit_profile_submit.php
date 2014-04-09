<?php
DEFINE('INCLUDE_CHECK',1);
require_once('library/db.php');
include('library/functions.php');

checkLogin('2');	

	if($_POST['phone'] && !validateNumeric($_POST['phone']))
		{
			die(msg(0,"Номер телефона может содержать только цифры."));
		}
	if($_POST['email'] && validateEmail($_POST['email']))
		{
			die(msg(0,"Неправильная электронная почта!"));
		}
	if($_POST['email'] && uniqueEmail($_POST['email']))
		{
			die(msg(0,"Этот адрес электронной почты уже присутствует в базе. Пожалуйста введите другую электронную почту."));
		}
		
		$res = editUser($_SESSION['user_id'],$_POST['email'],$_POST['first_name'],$_POST['last_name'],$_POST['dialing_code'],$_POST['phone'],$_POST['city'],$_POST['country']);
			
			if($res == 4){
				die(msg(0,"Внутренняя ошибка. Свяжитесь со службой поддержки!"));
			}
			if($res == 99){
				die(msg(1,"Профиль обновлен успешно!"));
			}

	function msg($status,$txt)
	{
		return '{"status":'.$status.',"txt":"'.$txt.'"}';
	}

?>
