<?php
if (!defined('WEB_ROOT')) {
	exit;
}

if (!isset($_GET['oid']) || (int)$_GET['oid'] <= 0) {
	header('Location: index.php');
}

$orderId = (int)$_GET['oid'];

// get ordered items
$sql = "SELECT pd_name, pd_price, od_qty
	    FROM tbl_order_item oi, tbl_product p 
		WHERE oi.pd_id = p.pd_id and oi.od_id = $orderId
		ORDER BY od_id ASC";

$result = dbQuery($sql);
$orderedItem = array();
while ($row = dbFetchAssoc($result)) {
	$orderedItem[] = $row;
}


// get order information
$sql = "SELECT od_date, od_last_update, od_status, od_shipping_first_name, od_shipping_address1, 
               od_shipping_phone, od_shipping_city, od_shipping_cost, od_memo
	    FROM tbl_order 
		WHERE od_id = $orderId";

$result = dbQuery($sql);
extract(dbFetchAssoc($result));

$orderStatus = array('New', 'Paid', 'Shipped', 'Completed', 'Cancelled');
$orderOption = '';
foreach ($orderStatus as $status) {
	$orderOption .= "<option value=\"$status\"";
	if ($status == $od_status) {
		$orderOption .= " selected";
	}
	
	$orderOption .= ">$status</option>\r\n";
}
?>
<p>&nbsp;</p>
<form action="" method="get" name="frmOrder" id="frmOrder">
    <table width="550" border="0"  align="center" cellpadding="5" cellspacing="1" class="detailTable">
        <tr> 
            <td colspan="2" align="center" id="infoTableHeader">Подробности Заказа</td>
        </tr>
        <tr> 
            <td width="150" class="label">Номер Заказа</td>
            <td class="content"><?php echo $orderId; ?></td>
        </tr>
        <tr> 
            <td width="150" class="label">Время Заказа</td>
            <td class="content"><?php echo $od_date; ?></td>
        </tr>
        <tr> 
            <td width="150" class="label">Последнее Обновление</td>
            <td class="content"><?php echo $od_last_update; ?></td>
        </tr>
        <tr> 
            <td class="label">Статус Заказа</td>
            <td class="content"> <select name="cboOrderStatus" id="cboOrderStatus" class="box">
                    <?php echo $orderOption; ?> </select> <input name="btnModify" type="button" id="btnModify" value="Изменить Статус" class="box" onClick="modifyOrderStatus(<?php echo $orderId; ?>);"></td>
        </tr>
    </table>
</form>
<p>&nbsp;</p>
<table width="550" border="0"  align="center" cellpadding="5" cellspacing="1" class="detailTable">
    <tr id="infoTableHeader"> 
        <td colspan="3">Заказаный Товар</td>
    </tr>
    <tr align="center" class="label"> 
        <td>Товар</td>
        <td>Цена</td>
        <td>Сумма</td>
    </tr>
    <?php
$numItem  = count($orderedItem);
$subTotal = 0;
for ($i = 0; $i < $numItem; $i++) {
	extract($orderedItem[$i]);
	$subTotal += $pd_price * $od_qty;
?>
    <tr class="content"> 
        <td><?php echo "$od_qty X $pd_name"; ?></td>
        <td align="right"><?php echo displayAmount($pd_price); ?></td>
        <td align="right"><?php echo displayAmount($od_qty * $pd_price); ?></td>
    </tr>
    <?php
}
?>
    <tr class="content"> 
        <td colspan="2" align="right">Сумма за Товары</td>
        <td align="right"><?php echo displayAmount($subTotal); ?></td>
    </tr>
    <tr class="content"> 
        <td colspan="2" align="right">Стоимость Доставки</td>
        <td align="right"><?php echo displayAmount($od_shipping_cost); ?></td>
    </tr>
    <tr class="content"> 
        <td colspan="2" align="right">Итого</td>
        <td align="right"><?php echo displayAmount($od_shipping_cost + $subTotal); ?></td>
    </tr>
</table>
<p>&nbsp;</p>
<table width="550" border="0"  align="center" cellpadding="5" cellspacing="1" class="detailTable">
    <tr id="infoTableHeader"> 
        <td colspan="2">Контактная Информация</td>
    </tr>
    <tr> 
        <td width="150" class="label">ФИО</td>
        <td class="content"><?php echo $od_shipping_first_name; ?> </td>
    </tr>
    <tr> 
        <td width="150" class="label">Адрес</td>
        <td class="content"><?php echo $od_shipping_address1; ?> </td>
    </tr>
    <tr> 
        <td width="150" class="label">Телефон</td>
        <td class="content"><?php echo $od_shipping_phone; ?> </td>
    </tr>
    <tr> 
        <td width="150" class="label">Город</td>
        <td class="content"><?php echo $od_shipping_city; ?> </td>
    </tr>
</table>
<p>&nbsp;</p>
<table width="550" border="0"  align="center" cellpadding="5" cellspacing="1" class="detailTable">
    <tr id="infoTableHeader"> 
        <td colspan="2">Заметки</td>
    </tr>
    <tr> 
        <td colspan="2" class="label"><?php echo nl2br($od_memo); ?> </td>
    </tr>
</table>
<p>&nbsp;</p>
<p align="center"> 
    <input name="btnBack" type="button" id="btnBack" value="Назад" class="box" onClick="window.history.back();">
</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
