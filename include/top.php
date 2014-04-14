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
                    <a href="/">Магазин</a>
                </li><li class="ks-nav__elem">
                    <a href="#">Статьи</a>
                </li><li class="ks-nav__elem">
                    <a href="/delivery.php">Доставка</a>
                </li><li class="ks-nav__elem">
                    <a href="#">Помощь</a>
                </li><li class="ks-nav__elem">
                    <a href="/contacts.php">Контакты</a>
                </li>
            </ul>
            <div class="nav navbar-nav navbar-right">
                <div class="ks-header-user">
                    <?php
                    include 'library/functions.php';
                    if (!empty($_SESSION['user_id'])){
                        checkLogin('2');
                        $getuser = getUserRecords($_SESSION['user_id']);
                        ?>
                    <div class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" style="display: inline-block; text-align: right">
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
                            <li><a href="edit_profile.php">Редактировать профиль</a></li>
                            <li><a href="change_pass.php">Изменить пароль</a></li>
                            <li><a href="order_list.php">История заказов</a></li>
                            <li><a href="review_list.php">Мои отзывы</a></li>
                            <li class="divider"></li>
                            <li><a href="log_off.php?action=logoff">Выход</a></li>
                        </ul>
                    </div>
                    <?php } else { ?>
                        <a class="b-header__user-registration-link " href="register.php">Регистрация</a>
                        <a class="b-header__user-authorization-link btn btn-warning" href="login.php">Вход</a>
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
                            <a href="cart.php?action=view">В корзине <?php echo $qty; ?> товар<?php echo $ending; ?><br />на сумму <?php echo displayAmount($subTotal); ?></a>
                        </div>
                            <?php } else { ?>
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <span class="glyphicon glyphicon-shopping-cart"></span>0<b class="caret"></b>
                        </a>
                        <div class="dropdown-menu ks-cart">
                            <div>Корзина пуста</div>
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
        <div class="container">
            -> <a href="#">Ducky</a> -> <a href="#">Keyboards</a> -> <span>Cool</span>
        </div>
    </div>
    <div class="container">