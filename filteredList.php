<?php
session_start();
$flt_id = array();
$val_id = array();
$i = 0;
$n = 0;
$sql = "SELECT pd_id
		FROM tbl_product_link
		WHERE ";
$links = explode("|", $_POST['text']);
foreach ($links as $value) {
	list($val,$flt)=explode("*",$value);
	if (!($flt_id[$n-1] == $flt)) {
		$flt_id[$n] = $flt; $n++;
		if ($n == 1) { $sql .= "flt_id = ".$flt." AND ( val_id = ".$val." OR "; }
				else { $sql = substr($sql, 0, -3).") AND flt_id = ".$flt." AND ( val_id = ".$val." OR "; }
	} else {
		$sql .= "val_id = ".$val." OR ";
	}
	$val_id[$i] = $val;

	$i++;
}
$text = '';
$sql = substr($sql, 0, -4)." )";
//$res = mysql_query($sql);
/*if (mysql_num_rows($res) > 0) {
	while ($row = mysql_fetch_assoc($res)){
		extract($row);	
		$text .= $pd_id." ";
	}
}*/
echo $sql;
?>