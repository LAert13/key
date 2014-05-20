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

<?php
if ($numProduct > 0 ) {

	$i = 0;
	while ($row = dbFetchAssoc($result)) {

		extract($row);
		if ($pd_image) {
			$pd_image = '/images/product/' . $pd_image;
		} else {
			$pd_image = '/images/no-image-large.png';
		}
	
		/*if ($i % $productsPerRow == 0) {
			echo '<tr>';
		}*/

		// format how we display the price
		$pd_price = displayAmount($pd_price);
?>

    <div class="col-xs-12 col-s-6 col-sm-6 col-md-6 col-lg-4" name="pos">
        <div class="ks-block-content ks-block-shadow">
            <div class="ks-position">
                <a class="ks-position__link" href="<?php echo "/shop/product-$pd_id"; ?>">
                    <img class="ks-position__image" src="<?php echo $pd_image; ?>" />
                    <span class="ks-position__details">
                        <span class="ks-position__name"><?php echo $pd_name; ?></span>
                        <span class="ks-position__price">
                            <input hidden name="price" value="<?php echo $pd_price*1; ?>"/>
                            <div name="price-usd" style="display: <?php if ($_SESSION['cur'] == 'USD') {echo "block";} elseif ($_SESSION['cur'] == 'GRN') {echo "none";}?>">Цена <?php echo $pd_price; ?></div>
                            <div name="price-grn" style="display: <?php if ($_SESSION['cur'] == 'USD') {echo "none";} elseif ($_SESSION['cur'] == 'GRN') {echo "block";}?>">Цена <?php echo sprintf("%.02f",$pd_price*$shopConfig['exch']); ?>грн</div>
                        </span>

                    <?php
                        // if the product is no longer in stock, tell the customer
                        if ($pd_qty < 1) {
                    ?>
                        <span class="btn btn-primary">Под заказ</span>
                    <?php } else { ?>
                        <span class="btn btn-success">В наличии</span>
                    <?php } ?>
                    </span>
                </a>
            </div>
        </div>
    </div>
<?php }} else {?>
    <div class="col-xs-12 col-sm-6 col-md-8 col-lg-9">
        <div class="ks-block-content ks-block-shadow">
            <div style="padding: 0 25px">
                <br/>
                <p class="alert alert-warning">No products in this category <?php echo $catId; ?></p>
            </div>
        </div>
    </div>
<?php } ?>
</div>
<p align="center"><?php echo $pagingLink; ?></p>
