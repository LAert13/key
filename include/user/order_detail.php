<?PHP
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

<div class="container" style="width: 960; padding:0;">
  <div class="panel panel-default" style="margin-bottom:0; margin-top:5; min-height:400">
    <div class="panel-heading">Информация о заказе №<?php echo $orderId?></div>
    <div class="panel-body">
        <div class="row">
            <div class="col-md-5">
                <div class="row">
                    <div class="col-xs-6">Дата заказа:</div> 
                    <div class="col-xs-6"><?php echo $od_date; ?></div>
                </div>
                <div class="row">
                    <div class="col-xs-6">Дата обновления:</div> 
                    <div class="col-xs-6"><?php echo $od_last_update; ?></div>
                </div>
                <div class="row">
                    <div class="col-xs-6">Статус заказа:</div> 
                    <div class="col-xs-6"><?php echo $od_status; ?></div>
                </div>
            </div>
            <div class="col-md-2"></div>
            <div class="col-md-5">
                <div class="row">
                    <div class="col-xs-6">ФИО:</div> 
                    <div class="col-xs-6"><?php echo $od_shipping_first_name; ?></div>
                </div>
                <div class="row">
                    <div class="col-xs-6">Телефон:</div> 
                    <div class="col-xs-6"><?php echo $od_shipping_phone; ?></div>
                </div>
                <div class="row">
                    <div class="col-xs-6">Город:</div> 
                    <div class="col-xs-6"><?php echo $od_shipping_city; ?></div>
                </div>
            </div>
        </div>
    </div>
    <div class="container" style="width: 940; padding:0;">
        <table class="table table-bordered" border="0" align="center" cellpadding="1" cellspacing="1">
            <thead>
                <tr> 
                    <th>Наименование</th>
                    <th>Кол-во</th> 
                    <th>Цена</th>
                    <th>Сумма</th>
                </tr>
            </thead>
            <tbody>
            <?php
            $numItem  = count($orderedItem);
            $subTotal = 0;
            for ($i = 0; $i < $numItem; $i++) {
            	extract($orderedItem[$i]);
            	$subTotal += $pd_price * $od_qty;
            ?>
                <tr> 
                    <td width="60%"><?php echo "$pd_name";?></td>
                    <td width="10%" align="center"><?php echo "$od_qty"; ?></td>
                    <td width="15%" align="right"><?php echo displayAmount($pd_price); ?></td>
                    <td width="15%" align="right"><?php echo displayAmount($od_qty * $pd_price); ?></td>
                </tr>
                <?php
            }
            ?>
                <tr> 
                    <td colspan="3" align="right"><b>Итого</b></td>
                    <td align="right"><?php echo displayAmount($subTotal); ?></td>
                </tr>
            </tbody>
        </table>
    </div>
    <?php if (!empty($od_memo)) { ?>
        <table width="940" border="0"  align="center" cellpadding="5" cellspacing="1" class="detailTable">
            <tr><td colspan="2">Заметки:</td></tr>
            <tr> 
                <td colspan="2"><?php echo nl2br($od_memo); ?> </td>
            </tr>
        </table>
    <? } ?>
    <p>&nbsp;</p>
    <p align="center"><input name="btnBack" type="button" id="btnBack" onClick="window.history.back();" class="btn btn-primary"value="Назад к списку" /></p>
  </div>
</div>