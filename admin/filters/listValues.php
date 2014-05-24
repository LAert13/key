<?php
if (!defined('WEB_ROOT')) {
	exit;
}

if (isset($_GET['flt']) && $_GET['flt'] != '') {
    $fltId = $_GET['flt'];
} else {
   exit;
}

// for paging
// how many rows to show per page
$rowsPerPage = 20;

$sql = "SELECT vl.val_id, val_value, flt_id, lnk.val_id
        FROM tbl_filter_value vl, tbl_filter_link lnk
		WHERE flt_id = '$fltId' AND vl.val_id = lnk.val_id
		ORDER BY val_value";
$result     = dbQuery(getPagingQuery($sql, $rowsPerPage));
$pagingLink = getPagingLink($sql, $rowsPerPage);
$name = dbFetchAssoc(dbQuery("SELECT flt_name FROM tbl_filters WHERE flt_id = '$fltId'"));
?>

<p>Значения фильтра <b><?php echo $name['flt_name']; ?></b></p>
<form action="processFilter.php?action=addFilter" method="post"  name="frmListFilter" id="frmListFilter">

 <table width="100%" border="0" align="center" cellpadding="2" cellspacing="1" class="text">
  <tr align="center" id="listTableHeader"> 
   <td width="50">Номер значения</td>
   <td>Значение</td>
   <td width="70">Изменить</td>
   <td width="70">Удалить</td>
  </tr>
  <?php
$cat_parent_id = 0;
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
   <td><?php echo $val_id; ?></td>
   <td><?php echo $val_value; ?></td>
   <td width="70" align="center"><a href="javascript:modifyValue(<?php echo $val_id; ?>);">Изменить</a></td>
   <td width="70" align="center"><a href="javascript:deleteValue(<?php echo $val_id; ?>);">Удалить</a></td>
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
   <td colspan="5" align="center">Пока нет никаких Значений</td>
  </tr>
  <?php
}
?>
  <tr> 
   <td colspan="5">&nbsp;</td>
  </tr>
  <tr>
     <td colspan="2" align="right"> <input name="btnCancel" type="button" id="btnCancel" value="Отмена" onClick="window.location.href='index.php';" class="box"></td>
     <td colspan="2" align="right"> <input name="btnAddValue" type="button" id="btnAddValue" value="Добавить Значение" class="box" onClick="addValue()">
     </td>
  </tr>
 </table>
</form>