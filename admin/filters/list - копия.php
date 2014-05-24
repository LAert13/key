<?php
if (!defined('WEB_ROOT')) {
	exit;
}

if (isset($_GET['sort']) && $_GET['sort'] == 'name') {
    $sort = 'fl.flt_name';
} else {
    $sort = 'fl.flt_id';
}
	
// for paging
// how many rows to show per page
$rowsPerPage = 20;

$sql = "SELECT fl.flt_id, flt_name, vl.val_id, val_value, lnk.flt_id, lnk.val_id
        FROM tbl_filters fl, tbl_filter_value vl, tbl_filter_link lnk
		WHERE fl.flt_id = lnk.flt_id AND vl.val_id = lnk.val_id
		ORDER BY $sort";
$result     = dbQuery(getPagingQuery($sql, $rowsPerPage));
$pagingLink = getPagingLink($sql, $rowsPerPage);
?>

<p>&nbsp;</p>
<form action="processFilter.php?action=addFilter" method="post"  name="frmListFilter" id="frmListFilter">
    <table width="100%" border="0" cellspacing="0" cellpadding="2" class="text">
        <tr>
            <td align="right">Сортировка фильтров по :
                <select name="cboFilter" class="box" id="cboFilter" onChange="viewFilter();">
                    <option selected>...</option>
                    <option value="0">Номер фильтра</option>
                    <option value="1">Название фильтра</option>
                </select>
            </td>
        </tr>
    </table>

 <table width="100%" border="0" align="center" cellpadding="2" cellspacing="1" class="text">
  <tr align="center" id="listTableHeader"> 
   <td width="50">Номер фильтра</td>
   <td>Имя Фильтра</td>
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
   <td><?php echo $flt_id; ?></td>
   <td><?php echo $flt_name; ?></td>
   <td><?php echo $val_value; ?></td>
   <td width="70" align="center"><a href="javascript:modifyFilter(<?php echo $flt_id; ?>);">Изменить</a></td>
   <td width="70" align="center"><a href="javascript:deleteFilter(<?php echo $flt_id; ?>);">Удалить</a></td>
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
   <td colspan="5" align="center">Пока нет никаких Фильтров со Значениями</td>
  </tr>
  <?php
}
?>
  <tr> 
   <td colspan="5">&nbsp;</td>
  </tr>
  <tr> 
     <td colspan="5" align="right"> <input name="btnAddFilter" type="button" id="btnAddFilter" value="Добавить Фильтр" class="box" onClick="addFilter()">
     </td>
  </tr>
  <tr>
     <td colspan="5" align="right"> <input name="btnAddValue" type="button" id="btnAddValue" value="Добавить Значение" class="box" onClick="addValue()">
     </td>
  </tr>
 </table>
</form>

<table width="100%" border="0" align="center" cellpadding="5" cellspacing="1" class="entryTable">
    <tr>
        <td width="150" class="label">Имя Фильтра</td>
        <td class="content"><?php get_select_filters()?></td>
        <td width="150" class="label">Значение Фильтра</td>
        <td class="content"><span id="result"></span></td>
    </tr>
</table>