<?php
require_once '../../library/config.php';
require_once '../library/functions.php';

header("Content-Type: text/html; charset=utf-8");

checkUser();

$view = (isset($_GET['view']) && $_GET['view'] != '') ? $_GET['view'] : '';

switch ($view) {
	default :
		$content 	= 'main.php';		
		$pageTitle 	= 'Настройки Интернет-магазина';
}

$script    = array('shop.js');

require_once '../include/template.php';
?>
