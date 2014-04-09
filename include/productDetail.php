<?php
if (!defined('WEB_ROOT')) {
	exit;
}

$product = getProductDetail($pdId, $catId);

// we have $pd_name, $pd_price, $pd_description, $pd_image, $cart_url
extract($product);
?> 
		<table width="100%" border="0" cellspacing="0" cellpadding="10">
		 <tr> 
		 	<td colspan="2">
		 		<div class="rview">
		 			<strong><?php echo $pd_name; ?></strong>
		 		</div>
		 	</td>
		 </tr>
		 <tr>
		  	<td align="center">
		  		<!--<img src="<?php echo $pd_image; ?>" border="0" alt="<?php echo $pd_name; ?>">-->
			    <div class="fotorama" data-thumbBorderColor="#FFF" data-background="#FFF" data-thumbBorderWidth="1" data-vertical="true" data-fullscreenIcon="true" data-navPosition="left" data-width="400" data-nav="thumbs" data-thumbwidth="100px">
			        <?php 
			        for ($i = 0; $i < $pd_img_cnt; $i++) { ?>     
			          <a href="./images/<?php echo $pd_img_dir?>/<?php echo $pd_img_dir?>_<?php echo $i?>.jpg"><img src="./images/<?php echo $pd_img_dir?>/<?php echo $pd_img_dir?>_<?php echo $i?>_t.jpg"></a><?php } ?>
			    </div>
		  	</td>
		  	<td valign="center">
			  <form action="<?php echo "cart.php?action=add&p=$pdId" ?>" method="post" name="frmAdd" id="frmAdd">
		  		<div class="rview">
					Цена : <?php echo displayAmount($pd_price); ?><br><br>

					Переключатели<br>
					<?php if ($pd_sw_black == 0 && $pd_sw_brown == 0 && $pd_sw_blue == 0 && $pd_sw_red == 0) { ?>
				    	<select name="sw" class="form-control">
				        	<option value="0">Не доступно</option>
				    	</select>
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
				    	<select name="il" class="form-control">
				        	<option value="0">Отсутствует</option>
				    	</select>
					<?php } 
					elseif ($pd_illum == 1) { ?>					
				    	<select name="il" class="form-control">
				        	<option value="1">Регулируемая</option>
				    	</select>
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
						<input type="button" class="btn btn-primary btn-block" name="btnAddToOrder" value="Под заказ" onClick="window.location.href='<?php echo "cart.php?action=add&p=$pdId" ?>';" class="addToOrderButton">
					<?php } ?>
				</div>
			  </form>
			</td>
		 </tr>
		</table>

<ul class="nav nav-tabs nav-justified">
  <li class="active"><a href="#descr" data-toggle="tab" style="height: 34px; padding-top: 5px; padding-bottom: 5px;">Описание</a></li>
  <li><a href="#review" data-toggle="tab" style="height: 34px; padding-top: 5px; padding-bottom: 5px;">Отзывы</a></li>
  <li><a href="#photos" data-toggle="tab" style="height: 34px; padding-top: 5px; padding-bottom: 5px;">Фотографии</a></li>
</ul>

<div class="tab-content">
  <div class="tab-pane active brd" id="descr"><?php echo $pd_description; ?></div>
  <div class="tab-pane brd" id="review"><?php include('include/reviews.php'); ?></div>
  <div class="tab-pane brd" id="photos"><?php include('include/photos.php'); ?></div>
</div>