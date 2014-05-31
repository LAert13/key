<?php
if (!defined('WEB_ROOT')) {
	exit;
}

// make sure a product id exists
if (isset($_GET['productId']) && $_GET['productId'] > 0) {
	$productId = $_GET['productId'];
} else {
	// redirect to index.php if product id is not present
	header('Location: index.php');
}

$sql = "SELECT cat_name, pd_name, pd_description, pd_price, pd_qty, pd_image
        FROM tbl_product pd, tbl_category cat
		WHERE pd.pd_id = $productId AND pd.cat_id = cat.cat_id";
$result = mysql_query($sql) or die('Cannot get product. ' . mysql_error());

$row = mysql_fetch_assoc($result);
extract($row);

if ($pd_image) {
	$pd_image = '../../images/product/' . $pd_image;
} else {
	$pd_image = '../../images/no-image-large.png';
}


?>
<p>&nbsp;</p>
<form action="processProduct.php?action=addProduct" method="post" enctype="multipart/form-data" name="frmAddProduct" id="frmAddProduct">
 <table width="100%" border="0" align="center" cellpadding="5" cellspacing="1" class="entryTable">
  <tr> 
   <td width="150" class="label">Категория</td>
   <td class="content"><?php echo $cat_name; ?></td>
  </tr>
  <tr> 
   <td width="150" class="label">Имя Товара</td>
   <td class="content"> <?php echo $pd_name; ?></td>
  </tr>
  <tr> 
   <td width="150" class="label">Описание</td>
   <td class="content"><?php echo nl2br($pd_description); ?> </td>
  </tr>
  <tr> 
   <td width="150" height="36" class="label">Цена</td>
   <td class="content"><?php echo number_format($pd_price, 2); ?> </td>
  </tr>
  <tr> 
   <td width="150" class="label">Количество</td>
   <td class="content"><?php echo number_format($pd_qty); ?> </td>
  </tr>
  <tr> 
   <td width="150" class="label">Изображение</td>
   <td class="content"><img src="<?php echo $pd_image; ?>"></td>
  </tr>
 </table>

    <br>
    <table width="100%" border="0" align="center" cellpadding="2" cellspacing="1" class="text">
        <tr align="center" id="listTableHeader">
            <td>Имя Фильтра</td>
            <td>Значение Фильтра</td>
        </tr>
        <?php
        $sql = "SELECT flt_name, val_value
                FROM tbl_product_link lnk, tbl_filters fl, tbl_filter_value vl
                WHERE lnk.pd_id = $productId AND fl.flt_id = lnk.flt_id AND vl.val_id = lnk.val_id";
        $result = mysql_query($sql);

        if (dbNumRows($result) > 0) {
            $i = 0;

            while($row = dbFetchAssoc($result)) {
                extract($row);

                if ($i%2) {
                    $class = 'row1';
                } else {
                    $class = 'row2';
                }
                $i += 1;
                ?>
                <tr class="<?php echo $class; ?>">
                    <td><?php echo $flt_name; ?></td>
                    <td><?php echo $val_value; ?></td>
                </tr>
            <?php
            } // end while
            ?>
        <?php
        } else {
            ?>
            <tr>
                <td colspan="2" align="center">Пока не добавлено ни одного фильтра</td>
            </tr>
        <?php
        }
        ?>
    </table>

 <p align="center"> 
  <input name="btnModifyProduct" type="button" id="btnModifyProduct" value="Изменить Товар" onClick="window.location.href='index.php?view=modify&productId=<?php echo $productId; ?>';" class="box">
  &nbsp;&nbsp;
  <input name="btnModifyProductFilters" type="button" id="btnModifyProductFilters" value="Изменить Фильтры" onClick="window.location.href='index.php?view=modifyFilters&productId=<?php echo $productId; ?>';" class="box">
  &nbsp;&nbsp;
  <input name="btnBack" type="button" id="btnBack" value=" Назад " onClick="window.history.back();" class="box">
 </p>
</form>