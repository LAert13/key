<?php
if (!defined('WEB_ROOT')) {
	exit;
}

// make sure a category id exists
if (isset($_GET['fltId']) && (int)$_GET['fltId'] > 0) {
	$fltId = (int)$_GET['fltId'];
} else {
	header('Location:index.php');
}	
	
$sql = "SELECT flt_id, flt_name
		FROM tbl_filters
		WHERE flt_id = $fltId";
$result = dbQuery($sql);
$row = dbFetchAssoc($result);
extract($row);

?>
<p>&nbsp;</p>
<form action="processFilter.php?action=modify&fltId=<?php echo $fltId; ?>" method="post" enctype="multipart/form-data" name="frmFilter" id="frmFilter">
 <table width="100%" border="0" align="center" cellpadding="5" cellspacing="1" class="entryTable">
  <tr> 
   <td width="150" class="label">Имя Фильтра</td>
   <td class="content"><input name="txtName" type="text" class="box" id="txtName" value="<?php echo $flt_name; ?>" size="30" maxlength="50"></td>
  </tr>
 </table>
 <p align="center"> 
  <input name="btnModify" type="button" id="btnModify" value="Сохранить Изменения" onClick="checkFilterForm();" class="box">
  &nbsp;&nbsp;<input name="btnCancel" type="button" id="btnCancel" value="Отмена" onClick="window.location.href='index.php';" class="box">
 </p>
</form>