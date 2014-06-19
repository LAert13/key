<?php
require_once('library/config.php');
require_once('library/category-functions.php');
$categories = fetchCategories();
if(!isset($catId)or($catId == 0)) {
    if(!isset($pdId)) {
        $catId = 0;
        $cat_mnu = 0;
    } else {
        $sql = "SELECT cat_mnu FROM tbl_category c, tbl_product p WHERE p.pd_id = $pdId AND c.cat_id = p.cat_id";
        $mnu = mysql_query($sql) or die(mysql_error());
        $mnu = mysql_fetch_assoc($mnu);
        extract($mnu);
    }
} else {
    $sql = "SELECT cat_mnu FROM tbl_category WHERE cat_id = $catId";
    $mnu = mysql_query($sql) or die(mysql_error());
    $mnu = mysql_fetch_assoc($mnu);
    extract($mnu);
}
?>
<style>
    .ks-navbar {
        border-top: 1px solid #a0a0a0;
        border-bottom: 4px solid #fcd03d;
        background: linear-gradient(to bottom, #838383 0%, #a0a0a0 50%, #6b6b6b 100%);
    }
    .element-menu {
        cursor: pointer;
        font-size: 16px;
    }
    .not_last{
        background: url(/images/line.png) no-repeat right center;
    }
    .element-menu > span {
        height: 50px;
        position: relative;
        padding: 12px;
    }
    .element-menu > span > a {
        color: #fff;
    }
    .current-menu > span > a,
    .selected-menu > span > a
    {
        color: #000000;
    }
    .current-menu > span > a:focus,
    .current-menu > span > a:hover,
    .current-menu > span > a:focus,
    .current-menu > span > a:hover,
    .selected-menu > span > a:focus,
    .selected-menu > span > a:hover,
    .selected-menu > span > a:focus,
    .selected-menu > span > a:hover {
        color: #fcd03d;
        text-decoration: none;
    }
    .ks-nav .ks-nav__elem .logo {
        color: #ffffff !important;
    }
    .current-menu,
    .selected-menu {
        background-color: #ffffff;
        color: #000000;
        border: 4px solid #fcd03d;
        border-radius:  10px 10px 0 0;
        border-bottom: 0;
        top: -4px;
        margin-bottom: -4px;
    }
    .current-menu > span,
    .selected-menu > span {
        z-index: 100;
        height: 50px;
        background: #fff;
        color: #000;
        position: relative;
        top: 2px;
        padding: 8px;
        padding-bottom: 19px;
        border-radius: 10px 10px 0 0;
    }
    .current-menu > span {
        z-index: 60;
    }
    .current-menu > a,
    .selected-menu > a{
        color: #000000;
        background-color: #ffffff;
    }
    .current-menu > a:focus,
    .current-menu > a:hover,
    .selected-menu > a:focus,
    .selected-menu > a:hover {
        color: #fcd03d;
    }
    .key-logo {

    }
    .key-logo > a > span {
        font-family: 'Open Sans', sans-serif;
        font-weight: 700;
        font-size: 32px;
        text-transform: uppercase;
        letter-spacing: -2px;
        vertical-align: middle;
        margin-left: -6px;
    }
    .key-logo > a > div {
        background:#fcd03d;
        border-radius: 10px;
        margin: 0;
        cursor: default;
        width: 50px;
        height: 50px;
        white-space: nowrap;
        color: #000000;
        font-family: 'Open Sans', sans-serif;
        font-weight: 700;
        font-size: 32px;
        text-transform: uppercase;
        letter-spacing: -2px;
        vertical-align: middle;
        line-height: 2.9ex;
        display: inline-block;
        overflow: hidden;
        text-indent: -3px;
    }
    .menu-logo {
        width:50px;
        background:#fcd03d;
        border-radius: 10px;
        margin-right: 5px;
    }
    .popup-menu {
        position: absolute;
        display: none;
        padding: 10px;
        border: 4px solid #fcd03d;
        border-radius: 0 0 10px 10px;
        margin-left: -4px;
        z-index: 70 !important;
        top: 100%;
        left: 0;
        float: left;
        min-width: 180px;
        font-size: 14px;
        list-style: none;
        background-color: #ffffff;
        -webkit-box-shadow: 0 6px 12px rgba(0, 0, 0, 0.175);
        box-shadow: 0 6px 12px rgba(0, 0, 0, 0.175);
        background-clip: padding-box;
    }
    .popup-menu > li > a,
    .popup-menu > li > ul > li > a {
        display: block;
        padding: 3px 20px;
        clear: both;
        font-weight: normal;
        line-height: 1.428571429;
        color: #333333;
        white-space: nowrap;
    }
    .popup-menu > li > ul > li > a {
        color: #285e8e;
    }
    .popup-menu > li > a:hover,
    .popup-menu > li > a:focus,
    .popup-menu > li > ul > li > a:hover,
    .popup-menu > li > ul > li > a:focus{
        color: #262626;
        text-decoration: none;
        background-color: #f5f5f5;
    }
    .popup-menu > li > ul > li > a:hover,
    .popup-menu > li > ul > li > a:focus{
        color: #285e8e;
    }
    .popup-menu > .active > a,
    .popup-menu > .active > a:hover,
    .popup-menu > .active > a:focus {
        color: #ffffff;
        text-decoration: none;
        background-color: #428bca;
        outline: 0;
    }
    .popup-menu a {
        height: 30px;
        line-height: 30px !important;
    }
    .popup-menu ul {
        margin-left: 0;
        padding-left: 0;
    }
</style>
<!-- ШАПКА -->
<div class="navbar-collapse collapse" style="background:#000; min-height: 80px;">
	<div class="container">
        <ul class="ks-menu">
            <li><a href="/shop/">О магазине</a></li>
            <li><a href="/info/delivery">Доставка и оплата</a></li>
            <li><a href="/info/help">Помощь</a></li>
            <li><a href="/info/contacts">Контакты</a></li>
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
                <li class="element-menu not_last <?php if ($cat_mnu==10) echo "current-menu";?>">
                    <span class="key-logo">
                        <a href="/shop/category-18">
                            <div>KEY</div>
                            <span>SHOP</span>
                        </a>
                    </span>
                    <ul class="popup-menu">
                        <?php getCategoriesList($categories,18,10);?>
                    </ul>
                </li>
                <li class="element-menu not_last <?php if ($cat_mnu==1) echo "current-menu";?>">
                    <ul class="popup-menu">
                        <?php getCategoriesList($categories,13,1);?>
                    </ul>
                    <span><a href="/shop/category-13"><img src="/images/weapoon.png" alt="Оружие" class="menu-logo"/>Оружие</a></span>
                </li>
                <li class="element-menu not_last <?php if ($cat_mnu==2) echo "current-menu";?>">
                    <span><a href="/shop/category-17"><img src="/images/optics.png" alt="Оптика" class="menu-logo"/>Оптика</a></span>
                    <ul class="popup-menu">
                        <?php getCategoriesList($categories,17,2);?>
                    </ul>
                </li>
                <li class="element-menu not_last <?php if ($cat_mnu==3) echo "current-menu";?>">
                    <span><a href="/shop/category-16"><img src="/images/armor.png" alt="Одежда" class="menu-logo"/>Одежда</a></span>
                    <ul class="popup-menu">
                        <?php getCategoriesList($categories,16,3);?>
                    </ul>
                </li>
                <li class="element-menu not_last <?php if ($cat_mnu==4) echo "current-menu";?>">
                    <span><a href="/shop/category-15"><img src="/images/boots.png" alt="Обувь" class="menu-logo"/>Обувь</a></span>
                    <ul class="popup-menu">
                        <?php getCategoriesList($categories,15,4);?>
                    </ul>
                </li>
                <li class="element-menu <?php if ($cat_mnu==5) echo "current-menu";?>">
                    <span><a href="/shop/category-16"><img src="/images/defence.png" alt="Защита" class="menu-logo"/>Защита</a></span>
                    <ul class="popup-menu">
                        <?php getCategoriesList($categories,14,5);?>
                    </ul>
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
                            <li><a href="/user/edit_profile">Редактировать профиль</a></li>
                            <li><a href="/user/change_pass">Изменить пароль</a></li>
                            <li><a href="/user/order_list">История заказов</a></li>
                            <li><a href="/user/review_list">Мои отзывы</a></li>
                            <li class="divider"></li>
                            <li><a href="/submit.php?action=logoff">Выход</a></li>
                        </ul>
                    </div>
                    <?php } else { ?>
	                    <div class="btn-group" style="margin:0px;">
	                    	<a class="ks-header-user__authorization-link btn btn-plink" width="50px" href="/user/login" style="border-radius: 0 0 0 4px; padding-top: 3px; padding-bottom: 3px;">Вход</a>
	                    	<a class="ks-header-user__authorization-link btn btn-plink" href="/user/register" style="border-radius: 0 0 4px 0; padding-top: 3px; padding-bottom: 3px;">Регистрация</a>
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
	                            <a href="/order/cart" style="display: inherit">В корзине <?php echo $qty; ?> товар<?php echo $ending; ?><br />на сумму <?php echo displayAmount($subTotal); ?></a>
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
    $('.element-menu').mouseover( function(){
        if ($(this).hasClass('current-menu')) {
            $(this).children('span').css('z-index',100);
        } else {
            $(this).addClass('selected-menu');
        }
        $(this).children('ul').css('display','block');
    });
    $('.element-menu').mouseout( function(){
        if ($(this).hasClass('current-menu')) {
            $(this).children('span').css('z-index',60);
        } else {
            $(this).removeClass('selected-menu');
        }
        $(this).children('ul').css('display','none');
    });
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
                    $self=$_SERVER['REQUEST_URI'];
                    $str=strpos($self, "&");
                    if ($str > 0 ) $self=substr($self, 0, $str);
                    $str=strpos($self, "?");
                    if ($str > 0 ) $self=substr($self, 0, $str);

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
            <?php if (strpos($_SERVER['REQUEST_URI'],'category')) {
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