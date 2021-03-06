<?php
if (!defined('WEB_ROOT')) {
	exit;
}

$productsPerRow = 3;
$productsPerPage = 9;

//$productList    = getProductList($catId);
$children = array_merge(array($catId), getChildCategories(NULL, $catId));
$children = ' (' . implode(', ', $children) . ')';

$sql = "SELECT pd_id, pd_name, pd_price, pd_image, pd_qty, c.cat_id
		FROM tbl_product pd, tbl_category c
		WHERE pd.cat_id = c.cat_id AND pd.cat_id IN $children 
		ORDER BY pd_name";
$result     = dbQuery(getPagingQuery($sql, $productsPerPage));
$pagingLink = getPagingLink($sql, $productsPerPage, "c=$catId");
$numProduct = dbNumRows($result);

// the product images are arranged in a table. to make sure
// each image gets equal space set the cell width here
$columnWidth = (int)(100 / $productsPerRow);
?>
<table width="100%" border="0" cellspacing="0" cellpadding="20">
<?php 
if ($numProduct > 0 ) {

	$i = 0;
	while ($row = dbFetchAssoc($result)) {
	
		extract($row);
		if ($pd_image) {
			$pd_image = WEB_ROOT . 'images/product/' . $pd_image;
		} else {
			$pd_image = WEB_ROOT . 'images/no-image-large.png';
		}
	
		if ($i % $productsPerRow == 0) {
			echo '<tr>';
		}

		// format how we display the price
		$pd_price = displayAmount($pd_price);
		
		echo "<td width=\"$columnWidth%\" align=\"center\"><a href=\"" . $_SERVER['PHP_SELF'] . "?c=$catId&p=$pd_id" . "\"><img src=\"$pd_image\" border=\"0\" width=\"200px\"><br>$pd_name</a><br>Цена : $pd_price";

		// if the product is no longer in stock, tell the customer
		if ($pd_qty <= 0) {
		?>
		<br><input type="button" class="btn btn-primary" name="btnAddToOrder" value="Под заказ" onClick="window.location.href='<?php echo $_SERVER['PHP_SELF']."?c=$catId&p=$pd_id" ?>';" class="addToOrderButton">
		<?php	
		} 
		else {
		?>
		<br><input type="button" class="btn btn-success" name="btnAddToCart" value="В наличии" onClick="window.location.href='<?php echo $_SERVER['PHP_SELF']."?c=$catId&p=$pd_id" ?>';" class="addToCartButton">
		<?php
		}
		
		echo "</td>\r\n";
	
		if ($i % $productsPerRow == $productsPerRow - 1) {
			echo '</tr>';
		}
		
		$i += 1;
	}
	
	if ($i % $productsPerRow > 0) {
		echo '<td colspan="' . ($productsPerRow - ($i % $productsPerRow)) . '">&nbsp;</td>';
	}
	
} else {
?>
	<tr><td width="100%" align="center" valign="center">No products in this category</td></tr>
<?php	
}	
?>
</table>
<p align="center"><?php echo $pagingLink; ?></p>