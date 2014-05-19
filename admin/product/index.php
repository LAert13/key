<?php
require_once '../library/config.php';
require_once '../library/functions.php';

$_SESSION['login_return_url'] = $_SERVER['REQUEST_URI'];
checkUser();

$view = (isset($_GET['view']) && $_GET['view'] != '') ? $_GET['view'] : '';

switch ($view) {
	case 'list' :
		$content 	= 'list.php';		
		$pageTitle 	= 'Просмотр Товаров';
		break;

	case 'add' :
		$content 	= 'add.php';		
		$pageTitle 	= 'Добавление Товара';
		break;

	case 'modify' :
		$content 	= 'modify.php';		
		$pageTitle 	= 'Изменение Товара';
		break;

	case 'detail' :
		$content    = 'detail.php';
		$pageTitle  = 'Подробная информация Товара';
		break;
		
	default :
		$content 	= 'list.php';		
		$pageTitle 	= 'Просмотр Товаров';
}




$script    = array('product.js');

require_once '../include/template.php';
?>
