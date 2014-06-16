<?php
require_once('library/config.php');
require_once('library/cart-functions.php');
require_once('library/checkout-functions.php');

if (isCartEmpty()) {
	// the shopping cart is still empty
	// so checkout is not allowed
	header('Location: cart');
} else if (isset($_GET['step']) && (int)$_GET['step'] > 0 && (int)$_GET['step'] <= 3) {
	$step = (int)$_GET['step'];

	$includeFile = '';
	if ($step == 1) {
		$includeFile = 'contactInfo.php';
		$pageTitle   = 'Оформление заказа - Контактная информация';
	} else if ($step == 2) {
		$includeFile = 'confirmation.php';
		$pageTitle   = 'Оформление заказа - Подтверждение заказа';
	} else if ($step == 3) {
		$orderId     = saveOrder();
		$orderAmount = getOrderAmount($orderId);
        if ($shopConfig['sendOrderEmail'] == 'y') {
            $subject = "[New Order] " . $orderId;
            $email   = 'keyshop.ua@gmail.com';
            $message = "Пришел новый заказ. Проверьте подробности \n http://" . $_SERVER['HTTP_HOST'] . WEB_ROOT . 'admin/order/index.php?view=detail&oid=' . $orderId;
            mail($email, $subject, $message, "From: $email\r\nReturn-path: $email");
        }
        $pageTitle   = 'Заказ успешен';
        $includeFile = 'success.php';
	}
} else {
	// missing or invalid step number, just redirect
	header('Location: shop');
}

require_once('include/header.php');
require_once('include/top.php'); ?>

<table width="960" border="0" align="center" cellpadding="0" cellspacing="0">
 <tr valign="top"> 
  <td><?php require_once "include/checkout/$includeFile"; ?></td>
 </tr>
</table>

<?php require_once('include/footer.php'); ?>