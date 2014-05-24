<?php
if (!defined('WEB_ROOT')) {
	exit;
}


?>

<form action="processFilter.php?action=add" method="post" enctype="multipart/form-data" name="frmFilter" id="frmFilter">
 <p align="center" class="formTitle">Добавить Фильтр</p>
 
 <table width="100%" border="0" align="center" cellpadding="5" cellspacing="1" class="entryTable">
  <tr> 
   <td width="150" class="label">Имя Фильтра</td>
   <td class="content"> <input name="txtName" type="text" class="box" id="txtName" size="30" maxlength="50"></td>
  </tr>
 </table>
 <p align="center"> 
  <input name="btnAddFilter" type="button" id="btnAddFilter" value="Добавить Фильтр" onClick="checkFilterForm();" class="box">
  &nbsp;&nbsp;<input name="btnCancel" type="button" id="btnCancel" value="Отмена" onClick="window.location.href='index.php';" class="box">
 </p>
</form>