<?php
require_once '../library/config.php';
require_once '../library/functions.php';

$_SESSION['login_return_url'] = $_SERVER['REQUEST_URI'];
checkUser();

$view = (isset($_GET['view']) && $_GET['view'] != '') ? $_GET['view'] : '';

switch ($view) {
	case 'list' :
		$content 	= 'list.php';		
		$pageTitle 	= 'Список Категорий';
		break;

	case 'add' :
		$content 	= 'add.php';		
		$pageTitle 	= 'Добавление Категории';
		break;

	case 'modify' :
		$content 	= 'modify.php';		
		$pageTitle 	= 'Редактирование Категории';
		break;

	default :
		$content 	= 'list.php';		
		$pageTitle 	= 'Список Категорий';
}


$script    = array('category.js');

require_once '../include/template.php';
?>
