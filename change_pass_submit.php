<?php
DEFINE('INCLUDE_CHECK',1);
require_once('library/db.php');
include('library/functions.php');

checkLogin('2');

		if (empty($_POST['oldpassword']) || empty($_POST['newpassword1']) || empty($_POST['newpassword2'])) 
		{
			die(msg(0,"Не введен старый или новый пароли."));
		}

		if($_POST['newpassword1']!=$_POST['newpassword2'] )
		{
			die(msg(0,"Новый пароль не совпадает с его подтвержением."));
		}
		
		if(strlen($_POST['newpassword1'])<5)
		{
			die(msg(0,"Пароль должен состоять из более чем пяти символов."));
		}
				
		$res = updatePass($_SESSION['user_id'], $_POST['oldpassword'], $_POST['newpassword1']);
				
			if($res == 2){
				die(msg(0,"Неверно указан старый пароль!"));
			}
			if($res == 3){
				die(msg(0,"Возникла ошибка при обновлении пароля. Свяжитесь со службой поддержки."));
			}
			if($res == 99){
				die(msg(1,"Новый пароль успешно установлен."));
			}

	function msg($status,$txt)
	{
		return '{"status":'.$status.',"txt":"'.$txt.'"}';
	}

?>
