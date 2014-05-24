<?php
require_once '../library/config.php';
require_once '../library/functions.php';

$fltName = $_POST['flt'];
$sql = "SELECT flt_id FROM tbl_filters WHERE flt_name = '$fltName'";
$res = mysql_query($sql);
$row = mysql_fetch_assoc($res);
$fltId = $row['flt_id'];

$sql = "SELECT vl.val_value FROM tbl_filter_value vl, tbl_filter_link lnk WHERE lnk.flt_id = '$fltId' AND vl.val_id = lnk.val_id ORDER BY vl.val_value ASC";
$res = mysql_query($sql);
$text = "<select name=\"fltValue\" id=\"fltValue\">";
$text .= "<option selected>...</option>";
while ($row = mysql_fetch_assoc($res)){
    $text .= "<option value=\"".$row['val_value']."\">".$row['val_value']."</option>";
}
$text .= "</select>";
echo($text);
?>