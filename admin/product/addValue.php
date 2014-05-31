<?php
if (!defined('WEB_ROOT')) {
	exit;
}

$fltId = $_GET['flt'];
$pdId = $_GET['pdId'];
$sql = "SELECT flt_name FROM tbl_filters WHERE flt_id = $fltId";
$row = mysql_fetch_assoc(mysql_query($sql));
extract($row);
?>

<form action="processProduct.php?action=addValue&pdId=<?php echo $pdId;?>" method="post" enctype="multipart/form-data" name="frmValue" id="frmValue">
 <p align="center" class="formTitle">Добавить Значение</p>
 
 <table width="100%" border="0" align="center" cellpadding="5" cellspacing="1" class="entryTable">
  <tr> 
      <td width="150" class="label">Имя Фильтра</td>
      <td class="content"><input name="fltName" value="<?php echo $flt_name;?>" hidden /><?php echo $flt_name;?></td>
  </tr>
  <tr>
      <td width="150" class="label">Значение Фильтра</td>
      <td class="content"> <input name="txtValue" type="text" class="box" id="txtValue" size="30" maxlength="50"></td>
  </tr>
 </table>
 <p align="center"> 
  <input name="btnAddFilter" type="button" id="btnAddFilter" value="Добавить Значение" onClick="checkValueForm();" class="box">
  &nbsp;&nbsp;<input name="btnCancel" type="button" id="btnCancel" value="Отмена" onClick="window.location.href='index.php';" class="box">
 </p>
</form>