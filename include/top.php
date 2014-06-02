
<!-- ШАПКА -->
<div class="navbar-collapse collapse" style="background:#000; min-height: 80px;">
	<div class="container">
        <ul class="ks-menu">
            <li><a href="/shop/">О магазине</a></li>
            <li><a href="/delivery">Доставка и оплата</a></li>
            <li><a href="#">Помощь</a></li>
            <li><a href="/contacts">Контакты</a></li>
        </ul>
	    <div class="navbar-form navbar-left">
	        <div class="input-group" style="margin-left:220px; margin-right:400px; margin-top:24px;">
	            <input type="text" class="form-control" placeholder="Поиск товара" name="search" id="search" oninput="search()" />
	            <span class="input-group-btn">
	                <button class="btn btn-plink" type="button" onclick="search_list()">Поиск</button>
	            </span>
	        </div>
	        <div class="btn-group open" id="search_drop" style="display:none; margin-left:220px;">
			    <ul class="dropdown-menu" role="menu" id="result" style="position:absolute; z-index:99; padding 10px; top:-2px;"></ul>
			</div>
	    </div>

        <div class="navbar-right">
            <ul class="ks-phones">
                <li>тел. +38 050 ***-**-**</li>
                <li>тел. +38 067 ***-**-**</li>
            </ul>
        </div>
    </div>
</div>
<div class="navbar navbar-default ks-navbar" role="navigation" style="z-index:80;">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <div class="navbar-brand">
                <!-- ЛОГОТИП -->
                <?php if ($_SERVER['REQUEST_URI'] == "/") { ?>
                    <h1 class="ks-logo"><span>PLINK</span></h1>
                <?php } else { ?>
                    <div class="ks-logo">
                        <a href="/"><span>PLINK</span></a>
                    </div>
                <?php } ?>
            </div>
        </div>
        <div class="navbar-collapse collapse">
            <ul class="nav navbar-nav ks-nav">
                <li class="ks-nav__elem shop">
                	<img src="/images/weapoon.png" alt="Оружие" class="img-rounded" width="50px" style="background:#fcd03d; margin-left:10px; border-radius: 10px"/>
                    <a href="/shop/">Оружие</a>
                </li><li class="ks-nav__elem">
                    <a href="/delivery">Аксессуары</a>
                </li><li class="ks-nav__elem">
                    <a href="#">Одежда</a>
                </li><li class="ks-nav__elem">
                    <a href="/contacts">Туризм</a>
                </li>
            </ul>
            <div class="nav navbar-nav navbar-right">
                <div class="ks-header-user">
                    <?php
                        include 'library/functions.php';
                        if (!empty($_SESSION['user_id'])) {
                            checkLogin('2');
                            $getuser = getUserRecords($_SESSION['user_id']);
                    ?>
                    <div class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <span class="glyphicon glyphicon-user"></span>
                            <span class="ks-header-user__name"><?php
                            if (empty($getuser[0]['first_name']) || empty($getuser[0]['last_name'])) {
                                echo $getuser[0]['username'];
                            } else {
                                echo $getuser[0]['first_name']." ".$getuser[0]['last_name'];
                            }
                            ?></span>
                            <span class="ks-header-user__cab">Личный кабинет</span></a>
                        <ul class="dropdown-menu">
                            <li><a href="/edit_profile">Редактировать профиль</a></li>
                            <li><a href="/change_pass">Изменить пароль</a></li>
                            <li><a href="/order_list">История заказов</a></li>
                            <li><a href="/review_list">Мои отзывы</a></li>
                            <li class="divider"></li>
                            <li><a href="/submit.php?action=logoff">Выход</a></li>
                        </ul>
                    </div>
                    <?php } else { ?>
	                    <div class="btn-group" style="margin:0px;">
	                    	<a class="ks-header-user__authorization-link btn btn-plink" width="50px" href="/login" style="border-radius: 0 0 0 4px; padding-top: 3px; padding-bottom: 3px;">Вход</a>
	                    	<a class="ks-header-user__authorization-link btn btn-plink" href="/register" style="border-radius: 0 0 4px 0; padding-top: 3px; padding-bottom: 3px;" href="/register">Регистрация</a>
	                    </div>
                    <?php } ?>
                </div>
                <div class="ks-header-cart">
                    <div class="dropdown">
                        <?php
                            $cartContent = getCartContent();
                            $numItem = count($cartContent);
                            if ($numItem > 0) {
                                $subTotal = 0;
                                $qty = 0;
                                for ($i = 0; $i < $numItem; $i++) {
                                    extract($cartContent[$i]);
                                    $subTotal += $pd_price * $ct_qty;
                                    $qty = $qty + $ct_qty;
                                }; // end while
                                //Окончание слова товар
                                if ($qty == 1) { $ending = ''; }
                                elseif ($qty >= 2 and $qty <= 4) { $ending = 'а'; }
                                else { $ending = 'ов'; }
                        ?>
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <span class="ks-header-cart__icon glyphicon glyphicon-shopping-cart"></span>
                            <span class="ks-header-cart__counter"><?php echo $qty == 0 ? '' : ' '.$qty; ?></span>
                        </a>
                        <div class="dropdown-menu">
                        	<div class="btn btn-plink">
	                        	<span class="ks-header-cart__icon glyphicon glyphicon-shopping-cart" style="width: 1em;"></span>
	                            <a href="/cart">В корзине <?php echo $qty; ?> товар<?php echo $ending; ?><br />на сумму <?php echo displayAmount($subTotal); ?></a>
                           	</div>
                        </div>
                            <?php } else { ?>
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <span class="ks-header-cart__icon glyphicon glyphicon-shopping-cart"></span>
                        </a>
                        <div class="dropdown-menu">
                            <div class="ks-header-cart__empty btn btn-plink">
                            	<span class="ks-header-cart__icon glyphicon glyphicon-shopping-cart" style="width: 1em;"></span>
                            	<span>Корзина пуста</span>
                            </div>
                        </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div><!--/.nav-collapse -->
    </div>
</div>

<script>
    (function () {
        var $header = $(".ks-navbar"),
            headerFixed = false,
            fixedHeight = $header.position().top;

        $(document).on("scroll", function () {
            var scroll = $(document).scrollTop();
            if (scroll > fixedHeight) {
                if (!headerFixed) {
                    $header.addClass("navbar-fixed-top");
                    headerFixed = true;
                }
            } else {
                if (headerFixed) {
                    $header.removeClass("navbar-fixed-top");
                    headerFixed = false;
                }
            }
        });
    }());

    $('body').click(function() {
    	document.getElementById("search_drop").style.display = 'none';
    });
    $('#search').click(function(event){
    	event.stopPropagation();
 	});
    $('#search_drop').click(function(event){
    	event.stopPropagation();
 	});

	$("#search").on("keypress", function (event) {
    	if (event.keyCode === 13){
    		search_list();
    	}
	});
</script>
<!-- ТЕЛО СТРАНИЦЫ -->
<div class="ks-page">
    <div class="ks-bread-crumbs ks-block-shadow">
        <?php if ($_SERVER['REQUEST_URI'] != "/") { ?>
        <div class="container">
        <div class="row">
            <ol class="breadcrumb col-md-8">
                <li><span class="glyphicon glyphicon-home"></span></li>
                <?php
                    $self = $_SERVER['PHP_SELF'];
                    $sql = "SELECT * FROM pages WHERE pg_alias = '$self'";
                    $res = mysql_query($sql) or die(mysql_error());
                    $res = mysql_fetch_assoc($res);
                    if (!empty($_GET['p'])) {
                        $pdId = $_GET['p'];
                        $sql = "SELECT cat_id, pd_name FROM tbl_product WHERE pd_id = '$pdId'";
                        $pd = mysql_query($sql) or die(mysql_error());
                        $pd = mysql_fetch_assoc($pd);
                        $catId = $pd['cat_id'];
                        $sql = "SELECT cat_name, cat_parent_id FROM tbl_category WHERE cat_id = '$catId'";
                        $cat = mysql_query($sql) or die(mysql_error());
                        $cat = mysql_fetch_assoc($cat);
                        $parentId = $cat['cat_parent_id'];
                        $sql = "SELECT cat_name FROM tbl_category WHERE cat_id = '$parentId'";
                        $parent = mysql_query($sql) or die(mysql_error());
                        $parent = mysql_fetch_assoc($parent);
                    ?>
                        <li><a href="/shop/category-<?php echo $parentId;?>"><?php echo $parent['cat_name'];?></a></li>
                        <li><a href="/shop/category-<?php echo $catId;?>"><?php echo $cat['cat_name'];?></a></li>
                        <li><?php echo $pd['pd_name'];?></li>
                    <?php
                    }
                    elseif (!empty($_GET['c'])) {
                        $catId = $_GET['c'];
                        $sql = "SELECT cat_name, cat_parent_id FROM tbl_category WHERE cat_id = '$catId'";
                        $cat = mysql_query($sql) or die(mysql_error());
                        $cat = mysql_fetch_assoc($cat);
                        if ($cat['cat_parent_id'] > 0) {
                            $parentId = $cat['cat_parent_id'];
                            $sql = "SELECT cat_name FROM tbl_category WHERE cat_id = '$parentId'";
                            $parent = mysql_query($sql) or die(mysql_error());
                            $parent = mysql_fetch_assoc($parent);
                            ?>
                            <li><a href="/shop/category-<?php echo $parentId;?>"><?php echo $parent['cat_name'];?></a></li>
                            <li><?php echo $cat['cat_name'];?></li>
                        <?php
                        }
                        else {
                        ?>
                            <li><?php echo $cat['cat_name'];?></li>
                    <?php
                        }
                    }
                    elseif ($res['pg_parent'] == 1) {
                    ?>
                        <li><?php echo $res['pg_title'];?></li>
                    <?php
                    }
                ?>
            </ol>
            <?php if (strpos($_SERVER['REQUEST_URI'],'shop')) {
                if (isset($_SESSION['arrange'])){$arrange = $_SESSION['arrange'];}
                ?>
                <div class="col-md-4" style="overflow: hidden; padding-left: 15px; padding-right: 15px; text-align: right">
                    Сортировать по:
                    <select id="arrange" onchange="arrangeProduct(<?php echo $catId ?>);">
                        <option <?php if (isset($arrange)&&($arrange == 1)) { echo 'selected';}?> value="1">наименованию</option>
                        <option <?php if (isset($arrange)&&($arrange == 2)) { echo 'selected';}?> value="2">возрастанию цены</option>
                        <option <?php if (isset($arrange)&&($arrange == 3)) { echo 'selected';}?> value="3">убыванию цены</option>
                    </select>
                </div>
            <?php } ?>
        </div>
        <?php } else { echo "<br>"; } ?>
    </div>
    </div>
    <div class="container">