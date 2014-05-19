<?php
if (!defined('WEB_ROOT')) {
	exit;
}

$self = '/admin/index.php';
?>
<html>
<head>
<title><?php echo $pageTitle; ?></title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<link href="/admin/include/admin.css" rel="stylesheet" type="text/css">
<script language="JavaScript" type="text/javascript" src="/admin/library/common.js"></script>
<script language="JavaScript" type="text/javascript" src="/admin/library/category.js"></script>
<script language="JavaScript" type="text/javascript" src="/admin/library/order.js"></script>
<script language="JavaScript" type="text/javascript" src="/admin/library/product.js"></script>
<script language="JavaScript" type="text/javascript" src="/admin/library/shop.js"></script>
<script language="JavaScript" type="text/javascript" src="/admin/library/user.js"></script>
</head>
<body>
<table width="750" border="0" align="center" cellpadding="0" cellspacing="1" class="graybox">
  <tr>
    <td colspan="2"><img src="/admin/include/banner-top.gif" width="750" height="75"></td>
  </tr>
  <tr>
    <td width="150" valign="top" class="navArea"><p>&nbsp;</p>
      <a href="/admin/" class="leftnav">Домой</a>
	  <a href="/admin/category/" class="leftnav">Категории</a>
	  <a href="/admin/product/" class="leftnav">Товары</a>
	  <a href="/admin/order/" class="leftnav">Заказы</a>
	  <a href="/admin/config/" class="leftnav">Конфигурация</a>
	  <a href="/admin/user/" class="leftnav">Пользователи</a>
	  <a href="<?php echo $self; ?>?logout" class="leftnav">Выход</a>
      <p>&nbsp;</p>
      <p>&nbsp;</p>
      <p>&nbsp;</p>
      <p>&nbsp;</p></td>
    <td width="600" valign="top" class="contentArea"><table width="100%" border="0" cellspacing="0" cellpadding="20">
        <tr>
          <td>
<?php
require_once $content;	 
?>
          </td>
        </tr>
      </table></td>
  </tr>
</table>
</body>
</html>
