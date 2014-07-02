<?php
require_once '../library/config.php';
require_once './library/functions.php';

header("Content-Type: text/html; charset=utf-8");

checkUser();

$content = 'main.php';

$pageTitle = 'Управление интернет-магазином';
$script = array();

require_once './include/template.php';
?>
