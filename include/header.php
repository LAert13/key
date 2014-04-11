<?php
if (!defined('WEB_ROOT')) {
	exit;
}

// set the default page title
$pageTitle = 'KeyShop';

// if a product id is set add the product name
// to the page title but if the product id is not
// present check if a category id exist in the query string
// and add the category name to the page title
if (isset($_GET['p']) && (int)$_GET['p'] > 0) {
	$pdId = (int)$_GET['p'];
	$sql = "SELECT pd_name
			FROM tbl_product
			WHERE pd_id = $pdId";
	
	$result    = dbQuery($sql);
	$row       = dbFetchAssoc($result);
	$pageTitle = $row['pd_name'];
	
} else if (isset($_GET['c']) && (int)$_GET['c'] > 0) {
	$catId = (int)$_GET['c'];
	$sql = "SELECT cat_name
	        FROM tbl_category
			WHERE cat_id = $catId";

    $result    = dbQuery($sql);
	$row       = dbFetchAssoc($result);
	$pageTitle = $row['cat_name'];

}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title><?php echo $pageTitle; ?></title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">


<script language="JavaScript" type="text/javascript" src="library/jquery.min.js"></script>

<script language="JavaScript" type="text/javascript" src="library/common.js"></script>

<link href="include/bootstrap.css" rel="stylesheet">

<link href="include/shop.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="include/style.css" media="screen" />
<link href="include/fotorama.css" rel="stylesheet">

<link href="include/navbar.css" rel="stylesheet" type="text/css">
<script src="library/bootstrap.js"></script>
<script type="text/javascript" src="library/script.js"></script>
<script src="library/validation.js"></script>
<script src="library/fotorama.js"></script>

</head>
<body>