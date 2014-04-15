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
		
        if ($_POST['hidPaymentMethod'] == 'cod') {
            header('Location: success.php');
            exit;
        }
        elseif ($_POST['hidPaymentMethod'] == 'cour') {
        	            header('Location: success.php');
            exit;
        }
        
	}
} else {
	// missing or invalid step number, just redirect
	header('Location: index');
}

require_once('include/header.php');
$pageTitle = 'Контактная информация';
?>

<script language="JavaScript" type="text/javascript" src="library/checkout.js"></script>

<?php require_once('include/top.php'); ?>

<table width="960" border="0" align="center" cellpadding="0" cellspacing="0">
 <tr valign="top"> 
  <td><?php require_once "include/$includeFile"; ?></td>
 </tr>
</table>

<?php require_once('include/footer.php'); ?>