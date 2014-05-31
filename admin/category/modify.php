<?php
if (!defined('WEB_ROOT')) {
	exit;
}

// make sure a category id exists
if (isset($_GET['catId']) && (int)$_GET['catId'] > 0) {
	$catId = (int)$_GET['catId'];
} else {
	header('Location:index.php');
}	
	
$sql = "SELECT cat_id, cat_parent_id, cat_name, cat_description, cat_image
		FROM tbl_category
		WHERE cat_id = $catId";
$result = dbQuery($sql);
$row = dbFetchAssoc($result);
extract($row);

?>
<p>&nbsp;</p>
<form action="processCategory.php?action=modify&catId=<?php echo $catId; ?>" method="post" enctype="multipart/form-data" name="frmCategory" id="frmCategory">
 <table width="100%" border="0" align="center" cellpadding="5" cellspacing="1" class="entryTable">
  <tr> 
   <td width="150" class="label">Имя Категории</td>
   <td class="content"><input name="txtName" type="text" class="box" id="txtName" value="<?php echo $cat_name; ?>" size="30" maxlength="50"></td>
  </tr>
  <tr> 
   <td width="150" class="label">Описание</td>
   <td class="content"> <textarea name="mtxDescription" cols="50" rows="4" class="box" id="mtxDescription"><?php echo $cat_description; ?></textarea></td>
  </tr>
  <tr> 
   <td width="150" class="label">Изображение</td>
   <td class="content"> 
    <input name="fleImage" type="file" id="fleImage" class="box">
<?php
	if ($cat_image != '') {
?>
    <br>
    <img src="/<?php echo CATEGORY_IMAGE_DIR . $cat_image; ?>"> &nbsp;&nbsp;<a href="javascript:deleteCatImage(<?php echo $cat_id; ?>);">Удалить
    Изображение</a> 
    <?php
	}
?>
   </td>
  </tr>

 </table>
 <?php
 if ($cat_parent_id > 0){
 ?>
    <br>
    <table width="100%" border="0" align="center" cellpadding="2" cellspacing="1" class="text">
        <tr align="center" id="listTableHeader">
            <td>Имя Фильтра</td>
        </tr>
        <?php
        $sql = "SELECT flt_name
                FROM tbl_category_link lnk, tbl_filters fl
                WHERE lnk.cat_id = $catId AND fl.flt_id = lnk.flt_id";
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
 <?php
 }
 ?>
 <p align="center">
  <?php
  if ($cat_parent_id > 0){
  ?>
      <input name="btnModifyCatFilters" type="button" id="btnModifyCatFilters" value="Измененить фильтры категории" onClick="changeCatFilters(<?php echo $cat_id;?>);" class="box">
  <?php
  }
  ?>
  <input name="btnModify" type="button" id="btnModify" value="Сохранить Изменения" onClick="checkCategoryForm();" class="box">
  &nbsp;&nbsp;<input name="btnCancel" type="button" id="btnCancel" value="Отмена" onClick="window.location.href='index.php';" class="box">
 </p>
</form>