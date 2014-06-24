<?php
if (!defined('WEB_ROOT')) {
	exit;
}


if (isset($_GET['catId']) && (int)$_GET['catId'] > 0) {
	$catId = (int)$_GET['catId'];
	$sql2 = " AND p.cat_id = $catId";
	$queryString = "catId=$catId";
} else {
	$catId = 0;
	$sql2  = '';
	$queryString = '';
}

// for paging
// how many rows to show per page
$rowsPerPage = 10;

$sql = "SELECT pd_id, c.cat_id, cat_name, pd_name, pd_thumbnail
        FROM tbl_product p, tbl_category c
		WHERE p.cat_id = c.cat_id $sql2
		ORDER BY pd_name";
$result     = dbQuery(getPagingQuery($sql, $rowsPerPage));
$pagingLink = getPagingLink($sql, $rowsPerPage, $queryString);

$categoryList = buildCategoryOptions($catId);

?> 
<p>&nbsp;</p>
<form action="processProduct.php?action=addProduct" method="post"  name="frmListProduct" id="frmListProduct">
 <table width="100%" border="0" cellspacing="0" cellpadding="2" class="text">
  <tr>
   <td align="right">Просмотр товаров из категории : 
    <select name="cboCategory" class="box" id="cboCategory" onChange="viewProduct();">
     <option selected>Все Категории</option>
	<?php echo $categoryList; ?>
   </select>
 </td>
 </tr>
</table>
<br>
 <table width="100%" border="0" align="center" cellpadding="2" cellspacing="1" class="text">
  <tr align="center" id="listTableHeader"> 
   <td>Имя Товара</td>
   <td width="75">Миниатюра</td>
   <td width="75">Категория</td>
   <td width="70">Изменить</td>
   <td width="70">Удалить</td>
  </tr>
  <?php
$parentId = 0;
if (dbNumRows($result) > 0) {
	$i = 0;
	
	while($row = dbFetchAssoc($result)) {
		extract($row);
		
		if ($pd_thumbnail) {
			$pd_thumbnail = '../../images/product/' . $pd_thumbnail;
		} else {
			$pd_thumbnail = '../../images/no-image-small.png';
		}	
		
		
		
		if ($i%2) {
			$class = 'row1';
		} else {
			$class = 'row2';
		}
		
		$i += 1;
?>
  <tr class="<?php echo $class; ?>"> 
   <td><a href="index.php?view=detail&productId=<?php echo $pd_id; ?>"><?php echo $pd_name; ?></a></td>
   <td width="75" align="center"><img src="<?php echo $pd_thumbnail; ?>"></td>
   <td width="75" align="center"><a href="?catId=<?php echo $cat_id; ?>"><?php echo $cat_name; ?></a></td>
   <td width="70" align="center"><a href="javascript:modifyProduct(<?php echo $pd_id; ?>);">Изменить</a></td>
   <td width="70" align="center"><a href="javascript:deleteProduct(<?php echo $pd_id; ?>, <?php echo $catId; ?>);">Удалить</a></td>
  </tr>
  <?php
	} // end while
?>
  <tr> 
   <td colspan="5" align="center">
   <?php 
echo $pagingLink;
   ?></td>
  </tr>
<?php	
} else {
?>
  <tr> 
   <td colspan="5" align="center">Пока не добавлено ни одного товара</td>
  </tr>
  <?php
}
?>
  <tr> 
   <td colspan="5">&nbsp;</td>
  </tr>
  <tr> 
   <td colspan="5" align="right"><input name="btnAddProduct" type="button" id="btnAddProduct" value="Добавить Товар" class="box" onClick="addProduct(<?php echo $catId; ?>)"></td>
  </tr>
 </table>
</form>