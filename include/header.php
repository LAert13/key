<?php
if (!defined('WEB_ROOT')) {
	exit;
}

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

}?>

<!DOCTYPE html>
<html lang="en">
<head>

    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="description" content="">
    <meta name="author" content="">

<?php if (!isset($pageTitle)) $pageTitle = 'KeyShop'; ?>
    <title><?php echo $pageTitle; ?></title>

    <link rel="shortcut icon" href="/favicon.png">

    <!-- Fonts -->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:700,800' rel='stylesheet' type='text/css'>

    <!-- Bootstrap core CSS -->
    <link href="/css/bootstrap.css" rel="stylesheet">
    <link href="/css/bootstrap.addon.css" rel="stylesheet">

    <!-- css animation -->
    <link href="/css/animate.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="/include/style.css" rel="stylesheet">
    <link href="/include/shop.css" rel="stylesheet">
    <link href="/css/style.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="/js/html5shiv.js"></script>
    <script src="/js/respond.min.js"></script>
    <![endif]-->


    <!-- Custom page js -->
    <script language="JavaScript" type="text/javascript" src="/js/jquery.min.js"></script>
    <script language="JavaScript" type="text/javascript" src="/js/common.js"></script>
    <script language="JavaScript" type="text/javascript" src="/js/bootstrap.js"></script>
    <script language="JavaScript" type="text/javascript" src="/js/script.js"></script>
    <script language="JavaScript" type="text/javascript" src="/js/modernizr.js"></script>
</head>

<body>