<?php
if (!defined('WEB_ROOT')) {
	exit;
}

$product = getProductDetail($pdId, $catId);

// we have $pd_name, $pd_price, $pd_description, $pd_image, $cart_url
extract($product);
?> 

<script type="text/javascript">
		$(document).ready(function(){
	
			$('#orderForm').submit(function(e) {
				order();
				e.preventDefault();	
			});	
		});
</script>

<div class="col-xs-12">
    <div class="ks-block-content ks-block-shadow" style="padding: 0 20px 20px">
    <h1><?php echo $pd_name; ?></strong></h1>

    <div class="row" style="padding-bottom: 30px">
        <div class="col-xs-12 col-s-8 col-sm-8 col-md-8 col-lg-9">
            <ul class="gallery__preview-list col-sm-hide">
                <?php for ($i = 0; $i < $pd_img_cnt; $i++) { ?>
                <li class="gallery__preview-elem">
                    <a class="gallery__preview-handle" href="/images/<?php echo $pd_img_dir?>/<?php echo $pd_img_dir?>_<?php echo $i?>.jpg">
                        <img src="/images/<?php echo $pd_img_dir?>/<?php echo $pd_img_dir?>_<?php echo $i?>.jpg" />
                    </a>
                </li>
                <?php } ?>
            </ul>
            <div class="gallery__image-container"></div>
            <script src="/js/gallery.js"></script>
        </div>
        <div class="col-xs-12 col-s-4 col-sm-4 col-md-4 col-lg-3">
            <form action="<?php echo "cart.php?action=add&p=$pdId" ?>" method="post" name="frmAdd" id="frmAdd">
                <div class="rview">
					Цена : <?php echo displayAmount($pd_price); ?><br><br>

					Переключатели<br>
					<?php if ($pd_sw_black == 0 && $pd_sw_brown == 0 && $pd_sw_blue == 0 && $pd_sw_red == 0) { ?>
				    	<select disabled class="form-control"><option>Не доступно</option></select>
				    	<input name="sw" type="hidden" value="0">
					<?php } 
					else { ?>
						<select name="sw" class="form-control">
							<?php if ($pd_sw_black > 0) { ?> <option value="1">Cherry MX Black</option> <?php } ?>
	          				<?php if ($pd_sw_brown > 0) { ?> <option value="2">Cherry MX Brown</option> <?php } ?>
	          				<?php if ($pd_sw_blue > 0) { ?> <option value="3">Cherry MX Blue</option> <?php } ?>
	          				<?php if ($pd_sw_red > 0) { ?> <option value="4">Cherry MX Red</option> <?php } ?>
	        			</select>
	        		<?php } ?><br>

	        		Подсветка<br>
					<?php if ($pd_illum == 0) { ?>
				    	<select disabled class="form-control"><option>Отсутствует</option></select>
				    	<input name="il" type="hidden" value="0">
					<?php } 
					elseif ($pd_illum == 1) { ?>					
				    	<select disabled class="form-control"><option>Регулируемая</option></select>
				    	<input name="il" type="hidden" value="1">
	        		<?php } 
	        		elseif ($pd_illum == 2) { ?>					
						<select name="il" class="form-control">
							<?php if ($pd_il_blue > 0) { ?> <option value="2">Синяя</option> <?php } ?>
	          				<?php if ($pd_il_orang > 0) { ?> <option value="3">Оранжевая</option> <?php } ?>
	        			</select>
	        		<?php }
	        		?><br>

					<?php
					// if we still have this product in stock
					// show the 'Add to cart' button
					if ($pd_qty > 0) {
					?>
						<input type="submit" class="btn btn-success btn-block" name="btnAddToCart" value="Добавить в корзину">
					<?php
					} else {
					?>
						<!--<input type="button" class="btn btn-primary btn-block" name="btnAddToOrder" value="Заказать" onClick="window.location.href='<?php echo "cart.php?action=add&p=$pdId" ?>';" class="addToOrderButton">-->
						<a data-toggle="modal" data-target="#modal" class="btn btn-primary btn-block" >Заказать</a>
					<?php } ?>
                </div>
            </form>
        </div>
    </div>

    <ul class="nav nav-tabs nav-justified">
      <li class="active"><a href="#descr" data-toggle="tab" style="height: 34px; padding-top: 5px; padding-bottom: 5px;">Описание</a></li>
      <li><a href="#review" data-toggle="tab" style="height: 34px; padding-top: 5px; padding-bottom: 5px;">Отзывы</a></li>
    </ul>

    <div class="tab-content">
      <div class="tab-pane active brd" id="descr"><?php echo $pd_description; ?></div>
      <div class="tab-pane brd" id="review"><?php include('include/reviews.php'); ?></div>
    </div>

    <div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" align="center">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel">Оформление товара "под заказ"</h4>
                </div>
                <div class="modal-body">
                    <div class="rview"><img src="<?php echo "/images/product/"; echo $pd_thumbnail; ?>" border="0">&nbsp;<strong><?php echo $pd_name; ?></strong></div>
                    <p>Введите контактную информацию и мы свяжемся с вами для подготовки следующей поставки товаров</p>
                    <div class="done2">
                        <p>Заказ успешно оформлен! Мы свяжемся с Вами сразу после его обработки.</p>
                        <input class="btn btn-primary" data-dismiss="modal" aria-hidden="true" name="btnBack" type="button" id="btnBack" value="Закрыть" />
                    </div>
                    <div class="form2">
                        <form id="orderForm" action="order_submit.php" method="post">
                            <table align="center" cellspacing="1" cellpadding="1" border="0">
                                <tr>
                                    <td><label for="name" style="margin-right: 5;">Имя</label></td>
                                    <td><input onclick="this.value='';" class="form-control" name="name" id="name" type="text" size="25" maxlength="25" value="<?php if (!empty($_SESSION['user_id'])){
                                                        if(empty($getuser[0]['first_name']) || empty($getuser[0]['last_name'])){
                                                            echo $getuser[0]['username'];}
                                                        else {echo $getuser[0]['first_name']." ".$getuser[0]['last_name'];} } ?>"/></td>
                                  </tr>
                                  <tr>
                                    <td><label for="phone" style="margin-right: 5;">Телефон</label></td>
                                    <td><input onclick="this.value='';" class="form-control" name="phone" id="phone" type="text" size="25" maxlength="25" value="<?php if(isset($getuser[0]['dialing_code'])){
                                                            echo $getuser[0]['dialing_code'];}
                                                        if(isset($getuser[0]['phone'])){ echo $getuser[0]['phone'];} ?>"/></td>
                                  </tr>
                                  <tr>
                                    <td><label for="email" style="margin-right: 5;">Электронная почта</label></td>
                                    <td><input onclick="this.value='';" class="form-control" name="email" id="email" type="text" size="25" maxlength="25" value="<?php if (isset($getuser[0]['email'])){ echo $getuser[0]['email'];} ?>"/></td>
                                  </tr>
                                  <tr>
                                    <td colspan="2"><div id="error2">&nbsp;</div></td>
                                    <input name="pdId" type="hidden" value="<?php echo $pdId ?>">
                                  </tr>
                                  <tr>
                                    <td><input class="btn btn-primary btn-block" data-dismiss="modal" aria-hidden="true" name="btnBack" type="button" id="btnBack" value="Назад" /></td>
                                    <td>
                                        <input class="btn btn-success btn-block" style="margin-top: 15;" type="submit" name="ordersubmit" value="Заказать" /><img id="loading" src="/images/loading.gif" alt="working.." />
                                    </td>
                                  </tr>
                              </table>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>