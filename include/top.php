<div id="pageSize" style="
    position: fixed;
    z-index: 100;
    top: 5px;
    right: 5px;
    color: #000;
    background: #fff;
    padding: 0 5px;
    opacity: 0.5
"></div>
<script>
    (function () {
        var $window = $(window), $document = $(document), $placeholder = $("#pageSize");
        $placeholder.text("d" + $document.width() + ' w' + $window.width());
        $window.on("resize", function () {
            $placeholder.text("d" + $document.width() + ' w' + $window.width());
        });
    }());
</script>

<!-- ШАПКА -->
<div class="b-header">
    <div class="b-header__stripe">
        <div class="b-page-middle">

            <!-- ЛОГОТИП -->
            <?php if ($_SERVER['REQUEST_URI'] == "/") { ?>
            <h1 class="b-header__logo"><span>Key</span>Shop</h1>
            <?php } else { ?>
            <div class="b-header__logo"><a href="/"><span>Key</span>Shop</a></div>
            <?php } ?>


            <!-- МЕНЮ -->
            <nav class="b-header__nav">

                <ul class="b-nav">
                    <li class="b-nav__elem">
                        <a href="/">Магазин</a>
                    </li><li class="b-nav__elem">
                        <a href="#">Статьи</a>
                    </li><li class="b-nav__elem">
                        <a href="/delivery.php">Доставка</a>
                    </li><li class="b-nav__elem">
                        <a href="#">Помощь</a>
                    </li><li class="b-nav__elem">
                        <a href="/contacts.php">Контакты</a>
                    </li>
                </ul>

            </nav>


            <!-- ПОЛЬЗОВАТЕЛЬ -->
            <div class="b-header__user">
            <?php
                include 'library/functions.php';
                if (!empty($_SESSION['user_id'])){
                    checkLogin('2');
                    $getuser = getUserRecords($_SESSION['user_id']);
            ?>
                <div class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php
                        if (empty($getuser[0]['first_name']) || empty($getuser[0]['last_name'])) {
                            echo $getuser[0]['username'];
                        } else {
                            echo $getuser[0]['first_name']." ".$getuser[0]['last_name'];
                        }
                    ?><b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li><a href="edit_profile.php">Редактировать профиль</a></li>
                        <li><a href="change_pass.php">Изменить пароль</a></li>
                        <li><a href="order_list.php">История заказов</a></li>
                        <li><a href="review_list.php">Мои отзывы</a></li>
                        <li><a href="log_off.php?action=logoff">Выход</a></li>
                    </ul>
                </div>
            <?php } else { ?>
                <a class="b-header__user-registration-link" href="register.php">Регистрация</a>
                <a class="b-header__user-authorization-link b-button m-yellow" href="login.php">Вход</a>
            <?php } ?>
            </div>


            <!-- КОРЗИНА -->
            <div class="b-header__cart">
                <?php
                $cartContent = getCartContent();
                $numItem = count($cartContent);
                ?>
                <div class="b-cart">
                    <?php if ($numItem > 0) {
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
                        <div>В <a href="cart.php?action=view">корзине</a> <?php echo $qty; ?> товар<?php echo $ending; ?></div>
                        <div>на сумму <?php echo displayAmount($subTotal); ?></div>
                        <div><a href="cart.php?action=view">Оформить заказ</a></div>
                    <?php } else { ?>
                        <div></div>
                        <div>Корзина пуста</div>
                        <div></div>
                    <?php } ?>
                </div>
            </div>
            <!-- КОНТАКТЫ В ШАПКЕ -->
            <div class="b-header__contacts">
                <div>с 8:00 до 23:00, без выходных</div>
                <div>+380 (44) 591-28-28</div>
            </div>
        </div>
    </div>
</div>

<script>
    (function () {
        var $header = $(".b-header"),
            headerFixed = false,
            fixedHeight = $header.height() - $header.children(".b-header__stripe").height();

        $(document).on("scroll", function () {
            var scroll = $(document).scrollTop();
            if (scroll > fixedHeight) {
                if (!headerFixed) {
                    $header.addClass("m-fixed");
                    headerFixed = true;
                }
            } else {
                if (headerFixed) {
                    $header.removeClass("m-fixed");
                    headerFixed = false;
                }
            }
        });

    }());
</script>

<!-- ТЕЛО СТРАНИЦЫ -->
<div class="b-page">