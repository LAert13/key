<?php
require_once 'config.php';

/*********************************************************
*                 CHECKOUT FUNCTIONS 
*********************************************************/
function saveOrder()
{
	$orderId       = 0;
	$shippingCost  = 5;
	$requiredField = array('hidShippingFIO', 'hidShippingPhone', 'hidShippingCity');
						   
	if (checkRequiredPost($requiredField)) {
	    extract($_POST);
		
		// make sure the first character in the 
		// customer and city name are properly upper cased
		$hidShippingFIO = ucwords($hidShippingFIO);
		$hidShippingCity = ucwords($hidShippingCity);
		$hidShippingEmail  = ucwords($hidShippingEmail);
				
		$cartContent = getCartContent();
		$numItem     = count($cartContent);
				
		// save order & get order id
		$sql = "INSERT INTO tbl_order(od_date, od_last_update, od_memo, od_shipping_first_name, od_shipping_address1, 
		                              od_shipping_phone, od_shipping_city, od_shipping_cost, od_user_id, od_shipping)
                VALUES (NOW(), NOW(),'$hidShippingEmail', '$hidShippingFIO', '$hidShippingAddress', '$hidShippingPhone', 
                	'$hidShippingCity', '$shippingCost', '$hidUserID', '$hidPaymentMethod')";
		$result = dbQuery($sql);
		
		// get the order id
		$orderId = dbInsertId();
		
		if ($orderId) {
			// save order items
			for ($i = 0; $i < $numItem; $i++) {
				$sql = "INSERT INTO tbl_order_item(od_id, pd_id, od_qty, od_sw, od_il)
						VALUES ($orderId, {$cartContent[$i]['pd_id']}, {$cartContent[$i]['ct_qty']}, {$cartContent[$i]['ct_sw']}, {$cartContent[$i]['ct_il']})";
				$result = dbQuery($sql);					
			}
		
			
			// update product stock
			for ($i = 0; $i < $numItem; $i++) {
				$sql = "UPDATE tbl_product 
				        SET pd_qty = pd_qty - {$cartContent[$i]['ct_qty']}
						WHERE pd_id = {$cartContent[$i]['pd_id']}";
				$result = dbQuery($sql);					
			}

			for ($i = 0; $i < $numItem; $i++) {
				switch ($cartContent[$i]['ct_sw']) {
                    case 1:
                    	$sql = "UPDATE tbl_product 
						        SET pd_sw_black = pd_sw_black - {$cartContent[$i]['ct_qty']}
								WHERE pd_id = {$cartContent[$i]['pd_id']}";
                        break;                            
                    case 2:
                    	$sql = "UPDATE tbl_product 
						        SET pd_sw_brown = pd_sw_brown - {$cartContent[$i]['ct_qty']}
								WHERE pd_id = {$cartContent[$i]['pd_id']}";
                        break;
                    case 3:
                    	$sql = "UPDATE tbl_product 
						        SET pd_sw_blue = pd_sw_blue - {$cartContent[$i]['ct_qty']}
								WHERE pd_id = {$cartContent[$i]['pd_id']}";
                        break;
                    case 4:
                    	$sql = "UPDATE tbl_product 
						        SET pd_sw_red = pd_sw_red - {$cartContent[$i]['ct_qty']}
								WHERE pd_id = {$cartContent[$i]['pd_id']}";
                        break;
                }
				$result = dbQuery($sql);					
			}
			
			for ($i = 0; $i < $numItem; $i++) {
				switch ($cartContent[$i]['ct_il']) {
                    case 2:
                    	$sql = "UPDATE tbl_product 
						        SET pd_il_blue = pd_il_blue - {$cartContent[$i]['ct_qty']}
								WHERE pd_id = {$cartContent[$i]['pd_id']}";
                        break;
                    case 3:
                    	$sql = "UPDATE tbl_product 
						        SET pd_il_orang = pd_il_orang - {$cartContent[$i]['ct_qty']}
								WHERE pd_id = {$cartContent[$i]['pd_id']}";
                        break;
                }
				$result = dbQuery($sql);					
			}
			
			// then remove the ordered items from cart
			for ($i = 0; $i < $numItem; $i++) {
				$sql = "DELETE FROM tbl_cart
				        WHERE ct_id = {$cartContent[$i]['ct_id']}";
				$result = dbQuery($sql);					
			}							
		}					
	}
	
	return $orderId;
}

/*
	Get order total amount ( total purchase + shipping cost )
*/
function getOrderAmount($orderId)
{
	$orderAmount = 0;
	
	$sql = "SELECT SUM(pd_price * od_qty)
	        FROM tbl_order_item oi, tbl_product p 
		    WHERE oi.pd_id = p.pd_id and oi.od_id = $orderId
			
			UNION
			
			SELECT od_shipping_cost 
			FROM tbl_order
			WHERE od_id = $orderId";
	$result = dbQuery($sql);

	if (dbNumRows($result) == 2) {
		$row = dbFetchRow($result);
		$totalPurchase = $row[0];
		
		$row = dbFetchRow($result);
		$shippingCost = $row[0];
		
		$orderAmount = $totalPurchase + $shippingCost;
	}	
	
	return $orderAmount;	
}

?>