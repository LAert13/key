<?php
/*
Line 1 : Make sure this file is included instead of requested directly
Line 2 : Check if step is defined and the value is two
Line 3 : The POST request must come from this page but the value of step is one
*/
if (!defined('WEB_ROOT')
    || !isset($_GET['step']) || (int)$_GET['step'] != 2
	|| $_SERVER['HTTP_REFERER'] != 'http://' . $_SERVER['HTTP_HOST'] . '/checkout?step=1') {
	exit;
}

$sid = session_id();
$sql = "SELECT * FROM tbl_shipping WHERE sh_session = '$sid' ORDER BY sh_id DESC LIMIT 1";
$res = mysql_query($sql) or die(mysql_error());
extract(mysql_fetch_assoc($res));
$update = mysql_query("UPDATE tbl_shipping SET sh_flag = 1 WHERE sh_id = '$sh_id'");

$errorMessage = '&nbsp;';

$cartContent = getCartContent();

?>
<div class="container" style="width: 960; padding:0;">
    <div class="panel panel-default" style="margin-bottom:0; margin-top:5; min-height:400">
        <div class="panel-heading">Шаг 2 из 2 : Подтверждение заказа</div>
        <div class="panel-body"><p id="errorMessage"><?php echo $errorMessage; ?></p></div>
        <div class="form">
			<form action="/checkout?step=3" method="post" name="frmCheckout" id="frmCheckout">
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
							$numItem  = count($cartContent);
							$subTotal = 0;
							for ($i = 0; $i < $numItem; $i++) {
								extract($cartContent[$i]);
								$subTotal += $pd_price * $ct_qty;
                          switch ($ct_sw) {
                            case 0:
                              $swt = '';
                              break;                            
                            case 1:
                              $swt = ', MX Black';
                              break;
                            case 2:
                              $swt = ', MX Brown';
                              break;
                            case 3:
                              $swt = ', MX Blue';
                              break;
                            case 4:
                              $swt = ', MX Red';
                              break;
                          }
                          switch ($ct_il) {
                            case 0:
                            case 1:
                              $ilu = '';
                              break;
                            case 2:
                              $ilu = ', Blue Led';
                              break;
                            case 3:
                              $ilu = ', Orange Led';
                              break;
                          }
							?>
				            <tr> 
				                <td width="60%"><?php echo "$pd_name"; echo $swt; echo $ilu; ?></td>
				                <td width="10%" align="center"><?php echo "$ct_qty"; ?></td>
				                <td width="15%" align="right"><?php echo displayAmount($pd_price); ?></td>
				                <td width="15%" align="right"><?php echo displayAmount($ct_qty * $pd_price); ?></td>
				            </tr>
				            <?php
					         	}
					        ?>
				            <tr> 
				        	    <td colspan="3" align="right">Сумма за товары</td>
				            	<td align="right"><?php echo displayAmount($subTotal); ?></td>
				            </tr>
				            <tr> 
				                <td colspan="3" align="right">Стоимость доставки</td>
				                <td align="right"><?php echo displayAmount($shopConfig['shippingCost']); ?></td>
				            </tr>
				            <tr> 
				            	<td colspan="3" align="right"><b>Итого</b></td>
				                <td align="right"><?php echo displayAmount($shopConfig['shippingCost'] + $subTotal); ?></td>
				            </tr>
				        </tbody>
				    </table>
				</div>
				<?php if (!empty($od_memo)) { ?>
			        <table width="940" border="0"  align="center" cellpadding="5" cellspacing="1" class="detailTable">
			            <tr><td colspan="2">Заметки:</td></tr>
			            <tr> 
			                <td colspan="2"><?php echo nl2br($od_memo); ?></td>
			            </tr>
				    </table>
				<? } ?>

				<table align="center" width="60%" cellspacing="1" cellpadding="1" border="0">
                  <tr>
                    <td width="150"><label for="name" style="margin-right: 5;">ФИО покупателя</label></td>
                    <td align="center"><?php echo $sh_name; ?>
			                <input name="hidShippingFIO" type="hidden" id="hidShippingFIO" value="<?php echo $sh_name; ?>"></td>
                  </tr>
                  <tr>
                    <td width="150"><label for="phone" style="margin-right: 5;">Номер телефона</label></td>
                    <td align="center"><?php echo $sh_phone;  ?>
			                <input name="hidShippingPhone" type="hidden" id="hidShippingPhone" value="<?php echo $sh_phone; ?>"></td>
                  </tr>
                  <tr>
                    <td width="150"><label for="email" style="margin-right: 5;">Электронная почта</label></td>
                    <td align="center"><?php echo $sh_email; ?>
			                <input name="hidShippingEmail" type="hidden" id="hidShippingEmail" value="<?php echo $sh_email; ?>"></td>
                  </tr>
                  <tr>
                    <td width="150"><label for="city" style="margin-right: 5;">Город</label></td>
                    <td align="center"><?php echo $sh_city; ?>
			                <input name="hidShippingCity" type="hidden" id="hidShippingCity" value="<?php echo $sh_city; ?>" ></td>
                  </tr>
                  <tr>
                    <td width="150"><label for="address" style="margin-right: 5;">Адрес доставки (необязательно)</label></td>
                   	<td align="center"><?php echo $sh_address; ?>
			                <input name="hidShippingAddress" type="hidden" id="hidShippingAddress" value="<?php echo $sh_address; ?>">
			                <input name="hidUserID" type="hidden" id="hidUserID" value="<?php echo $sh_uid; ?>"></td>
                  </tr>
                  <tr>
                    <td width="150"><label>Способ достаки и оплаты</label></td>
                    <td align="center"><?php if ($sh_ship == 'cod') { echo 'Самовывоз'; } else { echo 'Новая почта'; } ?>
			          <input name="hidPaymentMethod" type="hidden" id="hidPaymentMethod" value="<?php echo $sh_ship; ?>" />
			        </td>
                  </tr>
                  <tr>
                    <td><input class="btn btn-primary btn-block" style="margin-top: 5;" name="btnBack" type="button" id="btnBack" onClick="window.location.href='<?php echo "checkout?step=1"; ?>';" value="Назад" /></td>
                    <td>
                        <input class="btn btn-success btn-block" style="margin-top: 5;" type="submit" name="btnConfirm" id="btnConfirm" value="ЗАКАЗАТЬ" />
                    </td>
                  </tr>
                </table>
			</form>
		</div>
	</div>
</div>
