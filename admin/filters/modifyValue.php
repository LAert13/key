<?php
if (!defined('WEB_ROOT')) {
	exit;
}

// make sure a category id exists
if (isset($_GET['valId']) && (int)$_GET['valId'] > 0) {
	$valId = (int)$_GET['valId'];
} else {
	header('Location:index.php');
}	
	
$sql = "SELECT val_id, val_value
		FROM tbl_filter_value
		WHERE val_id = $valId";
$result = dbQuery($sql);
$row = dbFetchAssoc($result);
extract($row);

?>
<p>&nbsp;</p>
<form action="processFilter.php?action=modifyValue&valId=<?php echo $valId; ?>" method="post" enctype="multipart/form-data" name="frmValue" id="frmValue">
 <table width="100%" border="0" align="center" cellpadding="5" cellspacing="1" class="entryTable">
  <tr> 
   <td width="150" class="label">Значение Фильтра</td>
   <td class="content"><input name="txtValue" type="text" class="box" id="txtValue" value="<?php echo $val_value; ?>" size="30" maxlength="50"></td>
  </tr>
 </table>
 <p align="center"> 
  <input name="btnModify" type="button" id="btnModify" value="Сохранить Изменения" onClick="checkValueForm();" class="box">
  &nbsp;&nbsp;<input name="btnCancel" type="button" id="btnCancel" value="Отмена" onClick="window.location.href='index.php';" class="box">
 </p>
</form>