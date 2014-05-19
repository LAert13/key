<?php
require_once '../library/config.php';
require_once '../library/functions.php';

$_SESSION['login_return_url'] = $_SERVER['REQUEST_URI'];
checkUser();

$view = (isset($_GET['view']) && $_GET['view'] != '') ? $_GET['view'] : '';

switch ($view) {
	case 'list' :
		$content 	= 'list.php';		
		$pageTitle 	= 'Список Пользователей';
		break;

	case 'add' :
		$content 	= 'add.php';		
		$pageTitle 	= 'Добавление Пользователя';
		break;

	case 'modify' :
		$content 	= 'modify.php';		
		$pageTitle 	= 'Редактирование Пользователя';
		break;

	default :
		$content 	= 'list.php';		
		$pageTitle 	= 'Список Пользователей';
}

$script    = array('user.js');

require_once '../include/template.php';
?>
