<?php
DEFINE('INCLUDE_CHECK',1);
require_once('library/config.php');
include('library/functions.php');
require_once('library/checkout-functions.php');

	if(!$_POST['name'])
	{
		die(msg(0,"<p>Пожалуйста укажите имя.</p>"));
	}
	
	if(!$_POST['phone'])
	{
		die(msg(0,"<p>Пожалуйста укажите номер телефона.</p>"));
	}
	elseif($_POST['phone'] && !validateNumeric($_POST['phone']))
		{
			die(msg(0,"Номер телефона может содержать только цифры."));
		}

	if(!$_POST['email'])
	{
		die(msg(0,"<p>Пожалуйста укажите адрес электронной почты.</p>"));
	}
	elseif($_POST['email'] && validateEmail($_POST['email']))
		{
			die(msg(0,"Неправильная электронная почта!"));
		}
	if (!empty($_SESSION['user_id'])) { $usID = $_SESSION['user_id']; }
	else {$usID = 0; }

		$res = addOrder($_POST['name'],$_POST['phone'],$_POST['email'],$_POST['pdId'],$usID);
			
			if($res == 1){
				die(msg(0,"Внутренняя ошибка. Свяжитесь со службой поддержки!"));
			}
			if($res == 99){
				die(msg(1,"Заказ оформлен успешно!"));
			}
	
	function msg($status,$txt)
	{
		return '{"status":'.$status.',"txt":"'.$txt.'"}';
	}

?>
