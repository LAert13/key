<?php
require_once '../../library/config.php';
require_once '../library/functions.php';

$_SESSION['login_return_url'] = $_SERVER['REQUEST_URI'];
checkUser();

$view = (isset($_GET['view']) && $_GET['view'] != '') ? $_GET['view'] : '';

switch ($view) {
	case 'list' :
		$content 	= 'list.php';		
		$pageTitle 	= 'Список Фильтров';
		break;

    case 'listValues' :
        $content 	= 'listValues.php';
        $pageTitle 	= 'Список Значений Фильтра';
        break;

	case 'addFilter' :
		$content 	= 'addFilter.php';
		$pageTitle 	= 'Добавление Фильтра';
		break;

    case 'addValue' :
        $content 	= 'addValue.php';
        $pageTitle 	= 'Добавление Значения Фильтра';
        break;

	case 'modify' :
		$content 	= 'modify.php';		
		$pageTitle 	= 'Редактирование Фильтра';
		break;

    case 'modifyValue' :
        $content 	= 'modifyValue.php';
        $pageTitle 	= 'Редактирование Значения Фильтра';
        break;

	default :
		$content 	= 'list.php';		
		$pageTitle 	= 'Список Фильтров';
}


$script    = array('category.js');

require_once '../include/template.php';
?>
