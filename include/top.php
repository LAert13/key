<!-- ШАПКА -->
<div class="navbar navbar-default ks-navbar" role="navigation">
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
                    <h1 class="ks-logo"><span>Key</span>Shop</h1>
                <?php } else { ?>
                    <div class="ks-logo"><a href="/"><span>Key</span>Shop</a></div>
                <?php } ?>
            </div>
        </div>
        <div class="navbar-collapse collapse">
            <ul class="nav navbar-nav ks-nav">
                <li class="ks-nav__elem">
                    <a href="/shop/">Магазин</a>
                </li><li class="ks-nav__elem">
                    <a href="#">Статьи</a>
                </li><li class="ks-nav__elem">
                    <a href="/delivery">Доставка</a>
                </li><li class="ks-nav__elem">
                    <a href="#">Помощь</a>
                </li><li class="ks-nav__elem">
                    <a href="/contacts">Контакты</a>
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
                            <li><a href="/log_off.php?action=logoff">Выход</a></li>
                        </ul>
                    </div>
                    <?php } else { ?>
                    	<a class="ks-header-user__registration-link" href="/register">Регистрация</a><a
                        class="ks-header-user__authorization-link btn btn-warning" href="/login">Вход</a>
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
                            <a href="/cart">В корзине <?php echo $qty; ?> товар<?php echo $ending; ?><br />на сумму <?php echo displayAmount($subTotal); ?></a>
                        </div>
                            <?php } else { ?>
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <span class="ks-header-cart__icon glyphicon glyphicon-shopping-cart"></span>
                        </a>
                        <div class="dropdown-menu">
                            <div class="ks-header-cart__empty">Корзина пуста</div>
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
</script>
<!-- ТЕЛО СТРАНИЦЫ -->
<div class="ks-page">
    <div class="ks-bread-crumbs ks-block-shadow">
        <?php if ($_SERVER['REQUEST_URI'] != "/") { ?>
        <div class="container">
            <ol class="breadcrumb">
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
        </div>
        <?php } else { ?>
        <br />
        <?php } ?>
    </div>
    <div class="container">