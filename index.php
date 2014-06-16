<?php
require_once('library/config.php');
require_once('library/category-functions.php');
require_once('library/product-functions.php');
require_once('library/cart-functions.php');
require_once('library/checkout-functions.php');

$_SESSION['shop_return_url'] = $_SERVER['REQUEST_URI'];

$catId  = (isset($_GET['c']) && $_GET['c'] != '1') ? $_GET['c'] : 0;
$pdId   = (isset($_GET['p']) && $_GET['p'] != '') ? $_GET['p'] : 0;
$search   = (isset($_GET['search']) && $_GET['search'] != '') ? $_GET['search'] : 0;
$user = (isset($_GET['user']) && $_GET['user'] != '') ? $_GET['user'] : '';
$view = (isset($_GET['view']) && $_GET['view'] != '') ? $_GET['view'] : '';
$order = (isset($_GET['order']) && $_GET['order'] != '') ? $_GET['order'] : '';

switch ($user) {
    case 'login' :
        $content 	= 'include/user/login.php';
        $pageTitle = 'Вход в интернет-магазин';
        break;

    case 'register' :
        $content 	= 'include/user/register.php';
        $pageTitle = 'Регистрация';
        break;

    case 'pass_reset' :
        $content 	= 'include/user/pass_reset.php';
        $pageTitle = 'Восстановление пароля';
        break;

    case 'confirm_pass' :
        $content 	= 'include/user/confirm_pass.php';
        $pageTitle = 'Подтверждение пароля';
        break;

    case 'change_pass' :
        $content 	= 'include/user/change_pass.php';
        $pageTitle = 'Смена пароля';
        break;

    case 'edit_profile' :
        $content 	= 'include/user/edit_profile.php';
        $pageTitle 	= 'Редактирование профиля';
        break;

    case 'order_detail' :
        $content 	= 'include/user/order_detail.php';
        $orderId = (int)$_GET['oid'];
        $pageTitle = 'Заказ №' . $orderId;
        break;

    case 'order_list' :
        $content 	= 'include/user/order_list.php';
        $pageTitle 	= 'История заказов';
        break;

    case 'review_list' :
        $content 	= 'include/user/review_list.php';
        $pageTitle 	= 'Мои отзывы';
        break;

    case '';
        break;

    default:
        $content 	= 'include/404.php';
        $pageTitle 	= '404';
        break;
}

switch ($view) {
    case 'contacts' :
        $content 	= 'include/info/contacts.php';
        $pageTitle = 'Контакты';
        break;

    case 'delivery' :
        $content 	= 'include/info/delivery.php';
        $pageTitle = 'Оплата и доставка';
        break;

    case 'help' :
        $content 	= 'include/info/help.php';
        $pageTitle = 'Помощь и гарантийные обязательства';
        break;

    case '';
        break;

    default:
        $content 	= 'include/404.php';
        $pageTitle 	= '404';
        break;
}

switch ($order) {
    case 'contactInfo' :
        if (isCartEmpty()) {
            header('Location: /cart');
        } else {
            $content 	= 'include/checkout/contactInfo.php';
            $pageTitle = 'Оформление заказа - Контактная информация';
        }
        break;

    case 'confirmation' :
        if (isCartEmpty()) {
            header('Location: /cart');
        } else {
            $content 	= 'include/checkout/confirmation.php';
            $pageTitle = 'Оформление заказа - Подтверждение заказа';
        }
        break;

    case 'success' :
        if (isCartEmpty()) {
            header('Location: /cart');
        } else {
            $orderId     = saveOrder();
            $orderAmount = getOrderAmount($orderId);
            if ($shopConfig['sendOrderEmail'] == 'y') {
                $subject = "[New Order] " . $orderId;
                $email   = 'keyshop.ua@gmail.com';
                $message = "Пришел новый заказ. Проверьте подробности \n http://" . $_SERVER['HTTP_HOST'] . WEB_ROOT . 'admin/order/index.php?view=detail&oid=' . $orderId;
                mail($email, $subject, $message, "From: $email\r\nReturn-path: $email");
            }
            $content 	= 'include/checkout/success.php';
            $pageTitle = 'Заказ успешен';
        }
        break;

    case '';
        break;

    default:
        $content 	= 'include/404.php';
        $pageTitle 	= '404';
        break;
}

require_once('include/header.php');
require_once('include/top.php');
?>


<?php
if ($view || $user || $order) {
    require_once($content);
}
elseif ($catId) {
    require_once('include/categoryList.php');
}
elseif ($pdId) {
    require_once('include/productDetail.php');
}
elseif ($search) {
    require_once('include/leftNav.php');
	require_once('include/search_list.php');
}
else {
    require_once('include/leftNav.php');
	require_once('include/productList.php');
}
?>

<?php
require_once('include/footer.php');
?>
