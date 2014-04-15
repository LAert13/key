<?php
DEFINE('INCLUDE_CHECK',1);
require_once('../library/config.php');
include('../library/functions.php');
$returnURL = "../checkout?step=2";
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
	if(!$_POST['city'])
	{
		die(msg(0,"<p>Пожалуйста укажите город.</p>"));
	}
	
		$res = addShipping($_POST['name'],$_POST['phone'],$_POST['email'],$_POST['city'],$_POST['address'],$_POST['optPayment']);

			if($res == 1){
				die(msg(0,"Внутренняя ошибка. Свяжитесь со службой поддержки!"));
			}
			if($res == 99){
				echo(msg(1,$returnURL));
			}
	
	function msg($status,$txt)
	{
		return '{"status":'.$status.',"txt":"'.$txt.'"}';
	}

?>
