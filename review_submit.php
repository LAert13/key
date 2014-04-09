<?php
require_once('library/db.php');
include('library/functions.php');
	if(empty($_SESSION['user_id'])){
	if(!(isset($_SESSION['captcha_keystring']) && $_SESSION['captcha_keystring'] === $_POST['keystring']))
	{
		die(msg(0,"<p>Неверно указан текст на картинке.</p>"));
	} }

	if(strlen($_POST['username'])<1)
	{
		die(msg(0,"<p>Пожалуйста введите имя.</p>"));
	}
	
	/*elseif(strlen($_POST['username'])<3 || strlen($_POST['username'])>25)
	{
		die(msg(0,"<p>Имя должно быть как минимум ТРИ символа длинной.</p>"));
	}*/

	elseif(!$_POST['email'])
	{
		die(msg(0,"<p>Пожалуйста введите почтовый адрес.</p>"));
	}
	
	elseif(validateEmail($_POST['email']))
	{
		die(msg(0,"<p>Неправильный адрес электронной почты.</p>"));
	}
	if(!$_POST['rvtext'])
	{
		die(msg(0,"<p>Пожалуйста введите текст отзыва/вопроса.</p>"));
	}
	/*elseif(uniqueEmail($_POST['email']))
	{
		die(msg(0,"<p>На этот товар вы уже отправляли свой отзыв.</p>"));
	}*/
	else
		{
			$res = addReview($_POST['username'],$_POST['rating'],$_POST['email'],$_POST['rvtext'],$_POST['pdid'],$_POST['usrid']);
				if ($res == 1){
					die(msg(0,"<p>Произошла ошибка при регистрации. Пожалуйста свяжитесь с администрацией сайта.</p>"));
				}
				if ($res == 99){
					die(msg(1,"Отзыв успешно отправлен!"));
				}
		}

	function msg($status,$txt)
	{
		return '{"status":'.$status.',"txt":"'.$txt.'"}';
	}

?>
