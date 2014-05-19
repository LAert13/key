<?php
require_once('library/config.php');
require_once('library/cart-functions.php');

$action = (isset($_GET['action']) && $_GET['action'] != '') ? $_GET['action'] : 'view';

switch ($action) {
	case 'add' :
		addToCart();
		break;
	case 'update' :
		updateCart();
		break;	
	case 'delete' :
		deleteFromCart();
		break;
	case 'view' :
}

$cartContent = getCartContent();
$numItem = count($cartContent);

require_once('include/header.php');

$pageTitle = 'Корзина';
require_once('include/top.php'); ?>

<div class="container" style="width: 960; padding:0;">
    <div class="panel panel-default" style="margin-bottom:0; margin-top:5; min-height:400">
        <div class="panel-heading">Корзина</div>
        <div class="panel-body"><?php displayError(); ?></div>
        <? if ($numItem > 0 ) { ?>
        <form action="<?php echo "/cart?action=update"; ?>" method="post" name="frmCart" id="frmCart">
            <div class="container" style="width: 940; padding:0;">
                <table class="table table-bordered" border="0" align="center" cellpadding="1" cellspacing="1">
                    <thead>
                        <tr> 
                            <th>Наименование</th>
                            <th>Кол-во</th> 
                            <th>Цена</th>
                            <th>Сумма</th>
                            <th>&nbsp;</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $subTotal = 0;
                        for ($i = 0; $i < $numItem; $i++) {
                          extract($cartContent[$i]);
                          $productUrl = "/shop/product-$pd_id";
                          $subTotal += $pd_price * $ct_qty;
                         ?>
                        <tr> 
                            <td width="45%">
                                <a href="<?php echo $productUrl; ?>"><img src="<?php echo $pd_thumbnail; ?>" border="0"></a>
                                &nbsp;
                                <a href="<?php echo $productUrl; ?>"><?php echo $pd_name;?></a>
                            </td>
                            <td width="10%" align="center">
                                <input name="txtQty[]" type="text" id="txtQty[]" size="5" value="<?php echo $ct_qty; ?>"  class="form-control" onKeyUp="checkNumber(this);">
                                <input name="hidCartId[]" type="hidden" value="<?php echo $ct_id; ?>">
                                <input name="hidProductId[]" type="hidden" value="<?php echo $pd_id; ?>">
                            </td>
                            <td width="15%" align="right"><?php echo displayAmount($pd_price); ?></td>
                            <td width="15%" align="right"><?php echo displayAmount($ct_qty * $pd_price); ?></td>
                            <td width="15%" align="center"><input class="btn btn-primary btn-sm btn-block" name="btnDelete" type="button" id="btnDelete" value="Удалить" onClick="window.location.href='<?php echo "/cart?action=delete&cid=$ct_id"; ?>';"></td>
                        </tr>
                        <?php
                        }
                      ?>
                        <tr> 
                          <td colspan="3" align="right">Сумма за товары</td>
                          <td align="right"><?php echo displayAmount($subTotal); ?></td>
                          <td>&nbsp;</td>
                        </tr>
                        <tr> 
                            <td colspan="3" align="right">Стоимость доставки</td>
                            <td align="right"><?php echo displayAmount($shopConfig['shippingCost']); ?></td>
                            <td>&nbsp;</td>
                        </tr>
                        <tr> 
                          <td colspan="3" align="right"><b>Итого</b></td>
                          <td align="right"><?php echo displayAmount($shopConfig['shippingCost'] + $subTotal); ?></td>
                          <td><input class="btn btn-primary btn-sm btn-block" name="btnUpdate" type="submit" id="btnUpdate" value="Пересчитать"></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </form>
        <?php
        } else {
        ?>
        <p>&nbsp;</p><table width="550" border="0" align="center" cellpadding="10" cellspacing="0">
         <tr>
          <td><p align="center">Ваша корзина пуста</p>
           <p>Если Вы не можете добавить товар в корзину, проверьте включены ли куки и не блокирует ли какое-либо антивирусное програмное обеспечение вашу сессию.</p></td>
         </tr>
        </table>
        <?php } ?>

        <?php $shoppingReturnUrl = isset($_SESSION['shop_return_url']) ? $_SESSION['shop_return_url'] : 'shop'; ?>
        
        <table width="50%" border="0" align="center" cellpadding="10" cellspacing="0">
         <tr align="center"> 
          <td><input class="btn btn-primary btn-block" name="btnContinue" type="button" id="btnContinue" value="Продолжить покупки" onClick="window.location.href='<?php echo $shoppingReturnUrl; ?>';"></td>
        <?php 
        if ($numItem > 0) {
        ?>  
          <td><input class="btn btn-success btn-block" name="btnCheckout" type="button" id="btnCheckout" value="Оформить заказ" onClick="window.location.href='checkout?step=1';"></td>
        <?php
        }
        ?>  
         </tr>
        </table>
    </div>
</div>

<?php require_once('include/footer.php'); ?>