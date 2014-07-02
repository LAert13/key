<?php
require_once '../../library/config.php';
require_once '../library/functions.php';

header("Content-Type: text/html; charset=utf-8");

$_SESSION['login_return_url'] = $_SERVER['REQUEST_URI'];
checkUser();

$view = (isset($_GET['view']) && $_GET['view'] != '') ? $_GET['view'] : '';

switch ($view) {
	case 'list' :
		$content 	= 'list.php';		
		$pageTitle 	= 'Просмотр Заказов';
		break;

	case 'detail' :
		$content 	= 'detail.php';		
		$pageTitle 	= 'Подробности Заказа';
		break;

	case 'modify' :
		modifyStatus();
		//$content 	= 'modify.php';		
		//$pageTitle 	= 'Shop Admin Control Panel - Modify Orders';
		break;

	default :
		$content 	= 'list.php';		
		$pageTitle 	= 'Просмотр Заказов';
}




$script    = array('order.js');

require_once '../include/template.php';
?>
