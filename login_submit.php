<?php
require_once('library/db.php');
include('library/functions.php');

$returnURL = "/";

//For login

	// we check if everything is filled in and perform checks
	
	if(!$_POST['username'] || !$_POST['password'])
	{
		die(msg(0,"Не введен логин / пароль."));
	}

	else
		{
			$res = login($_POST['username'],$_POST['password']);
				if ($res == 1){
					die(msg(0,"Логин или пароль введен неправильно!"));
				}
				if ($res == 2){
					die(msg(0,"Извените, но ваш аккаунт заблокирован."));
				}
				if ($res == 99){
					echo(msg(1,$returnURL));
				}
		}

	function msg($status,$txt)
	{
		return '{"status":'.$status.',"txt":"'.$txt.'"}';
	}
	
?>
