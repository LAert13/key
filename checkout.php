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
		$includeFile = 'shippingAndPaymentInfo.php';
		$pageTitle   = 'Checkout - Step 1 of 2';
	} else if ($step == 2) {
		$includeFile = 'checkoutConfirmation.php';
		$pageTitle   = 'Checkout - Step 2 of 2';
	} else if ($step == 3) {
		$orderId     = saveOrder();
		$orderAmount = getOrderAmount($orderId);
		
		$_SESSION['orderId'] = $orderId;
		
        header('Location: success');
        exit;
      
	}
} else {
	// missing or invalid step number, just redirect
	header('Location: shop');
}

require_once('include/header.php');
$pageTitle = 'Контактная информация';
?>

<?php require_once('include/top.php'); ?>

<table width="960" border="0" align="center" cellpadding="0" cellspacing="0">
 <tr valign="top"> 
  <td><?php require_once "include/$includeFile"; ?></td>
 </tr>
</table>

<?php require_once('include/footer.php'); ?>