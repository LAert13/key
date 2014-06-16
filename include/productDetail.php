<?php
if (!defined('WEB_ROOT')) {
	exit;
}

$product = getProductDetail($pdId, $catId);
extract($product);
$pd_price = displayAmount($pd_price);
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
        <div class="col-xs-12 col-s-9 col-sm-9 col-md-9 col-lg-9">
            <?php if (!empty($pd_img_dir)) { ?>
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
            <?php } else { ?>
                <div class="gallery__image-container"><a class="gallery__preview-handle" href="<?php echo $pd_image; ?>"><img src="<?php echo $pd_image; ?>" /></a></div>
            <?php }?>
        </div>
        <div class="col-xs-12 col-s-3 col-sm-3 col-md-3 col-lg-3">
            <form action="<?php echo "/cart.php?action=add&p=$pdId" ?>" method="post" name="frmAdd" id="frmAdd">
                <div class="rview" style="border: 3px solid #fcd03d;">
                    <span class="price">
                        <?php echo $pd_price; ?>
                    </span>
                    <br>

                    <?php
                    // if we still have this product in stock
                    // show the 'Add to cart' button
                    if ($pd_qty > 0) {
                        ?>
                        <input type="submit" class="btn btn-success btn-block" name="btnAddToCart" value="Добавить в корзину">
                    <?php
                    } else {
                        ?>
                        <!--<input type="button" class="btn btn-primary btn-block" name="btnAddToOrder" value="Заказать" onClick="window.location.href='<?php echo "/cart.php?action=add&p=$pdId" ?>';" class="addToOrderButton">-->
                        <a data-toggle="modal" data-target="#modal" class="btn btn-primary btn-block" >Заказать</a>
                    <?php } ?>
                </div>
            </form>
            <div class="rview">
                <h4>Доставка заказа</h4>
                — Службой доставки "Новая почта" по Украине<br>
                — Самовывоз в г. Днепропетровск
                <h4>Оплата</h4>
                — Наличными при получении заказа<br>
                — Через систему Privat24 или терминал на карточку ПриватБанка<br>
                — Наложенным платежом через "Новую почту" <b>(для покупателей из Крыма - недоступно!)</b><br>
            </div>
        </div>
    </div>

    <ul class="nav nav-tabs nav-justified">
      <li class="product-tabs active"><a href="#allInfo" data-toggle="tab">Вся информация</a></li>
      <li class="product-tabs"><a href="#descr" data-toggle="tab">Описание</a></li>
      <li class="product-tabs"><a href="#techSpecs" data-toggle="tab">Технические характеристики</a></li>
      <li class="product-tabs"><a href="#review" data-toggle="tab">Отзывы</a></li>
    </ul>

    <div class="tab-content">
        <div class="tab-pane active brd" id="allInfo">
            <div class="row">
                <div class="col-xs-12 col-s-6 col-sm-6 col-md-6 col-lg-6">
                    <?php echo $pd_description; ?>
                    <br>
                    <br>
                    <table width="100%" border="0" cellpadding="2" cellspacing="1" class="text">
                    <?php
                    $sql = "SELECT flt_name, val_value
                            FROM tbl_product_link lnk, tbl_filters fl, tbl_filter_value vl
                            WHERE lnk.pd_id = $pdId AND fl.flt_id = lnk.flt_id AND vl.val_id = lnk.val_id";
                    $result = mysql_query($sql);
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
                                  <td><?php echo $flt_name; ?></td>
                                  <td><?php echo $val_value; ?></td>
                              </tr>
                          <?php
                          }
                    } else { ?>
                    <tr>
                        <td colspan="2" align="center">Пока не добавлено ни одного фильтра</td>
                    </tr>
                    <?php } ?>
                    </table>
                </div>
                <div class="col-xs-12 col-s-6 col-sm-6 col-md-6 col-lg-6">
                    <?php
                        $sql = "SELECT rv_id, rv_pd_id, rv_usr_name, rv_usr_rating, rv_text, rv_valid, rv_date
		                        FROM tbl_review
		                        WHERE rv_pd_id = $pdId
		                        ORDER BY rv_id LIMIT 4";
                    $result     = dbQuery($sql);
                    $numReviews = dbNumRows($result);
                    if ($numReviews > 0 ) {
                        $i = 0;
                        while ($row = dbFetchAssoc($result)) {
                            extract($row);
                            if ($rv_valid == 1) {
                                ?>
                                <div>
                                    <b><?php echo "$rv_usr_name";?></b>&nbsp;>>&nbsp;<?php echo "$rv_date";?><br>Оценка : <?php echo "$rv_usr_rating";?><br>Отзыв: <?php echo "$rv_text";?>
                                </div>
                            <?php } } }
                    else {
                        ?>
                        <div style="text-align: center">Нет пользовательских отзывов об этом товаре</br><a class="review-click" href="<?php echo $_SERVER['REQUEST_URI']?>#review">Ваш отзыв может быть первым</a></div>
                    <?php } ?>
                </div>
            </div>
        </div>
        <div class="tab-pane brd" id="descr">
            <?php echo $pd_description; ?>
        </div>
        <div class="tab-pane brd" id="techSpecs">
            <table width="100%" border="0" cellpadding="2" cellspacing="1" class="text">
                <?php
                $sql = "SELECT flt_name, val_value
                FROM tbl_product_link lnk, tbl_filters fl, tbl_filter_value vl
                WHERE lnk.pd_id = $pdId AND fl.flt_id = lnk.flt_id AND vl.val_id = lnk.val_id";
                $result = mysql_query($sql);

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
                            <td><?php echo $flt_name; ?></td>
                            <td><?php echo $val_value; ?></td>
                        </tr>
                    <?php
                    }
                    ?>
                <?php
                } else {
                    ?>
                    <tr>
                        <td colspan="2" align="center">Пока не добавлено ни одного фильтра</td>
                    </tr>
                <?php
                }
                ?>
            </table>
        </div>
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
                        <form id="orderForm" action="/submit.php?action=order" method="post">
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

<script type="text/javascript">
    $('.review-click').click(function(){
        $(".product-tabs").each(function(){
            if ($(this).hasClass('active')){ $(this).removeClass('active'); }
            if ($(this).html() == '<a href="#review" data-toggle="tab">Отзывы</a>') {
                $(this).addClass('active');
                $(".tab-pane").each(function(){
                    if ($(this).hasClass('active')){ $(this).removeClass('active'); }
                    if ($(this).attr('id') == 'review') {
                        $(this).addClass('active');
                        $(".ks-navbar").addClass('navbar-fixed-top');
                    }
                });
            }
        });
    });
</script>