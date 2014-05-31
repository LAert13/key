<?php
	$query = $_GET['search'];
  	$query = trim($query); 
    $query = mysql_real_escape_string($query);
    $query = htmlspecialchars($query);
   	$query = explode(" ", $query);

	$sql = "SELECT `pd_id`, `pd_name`, `pd_price`, `pd_image`, `pd_qty`, `pd_description`, `pd_thumbnail`, `pd_price`
	        FROM `tbl_product` 
	        WHERE ";
     	foreach ($query as $key => $value) {
       		$sql .= "(`pd_id` LIKE '%".$value."%' OR `pd_name` LIKE '%".$value."%' OR `pd_description` LIKE '%".$value."%') AND ";
       	}
    $sql = substr($sql, 0, -4);
	$sql .= "ORDER BY `pd_name`";
	
	$productsPerRow = 3;
	$productsPerPage = 9;

	$result     = dbQuery(getPagingQuery($sql, $productsPerPage));
	$pagingLink = getPagingLink($sql, $productsPerPage, "c=$catId");
	$numProduct = dbNumRows($result);
?>
<div class="col-xs-12">
    <div class="ks-block-content ks-block-shadow">
		<h3>Результаты поиска для <b><?php echo($_GET['search']);?></b></h3>
	</div>
</div>

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