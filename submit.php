<?php
require_once('library/config.php');
include('library/functions.php');

$action = isset($_GET['action']) ? $_GET['action'] : '';

switch ($action) {
	
    case 'login' :
        doLogin();
        break;
    
    case 'register' :
        doRegister();
    	break;
    
    case 'editProfile' :
        editProfile();
    	break;  
	
	case 'changePass' :
    	changePass();
    	break;

    case 'search' :
    	doSearch();
    	break;

	case 'shipping' :
    	doShipping();
    	break;

	case 'order' :
    	doOrder();
    	break;

	case 'review' :
    	doReview();
    	break;

    case 'contact' :
    	doContact();
    	break;
    
    case 'passReset' :
    	doPassReset();
    	break;

    case 'logoff' :
    	logoff();
    	break;

    case 'arrange' :
        doArrange();
        break;

    default :
        // if action is not defined or unknown
        // move to main category page
        header('Location: index.php');
}

function msg($status,$txt) {
	return '{"status":'.$status.',"txt":"'.$txt.'"}';
}

function doLogin(){
	$returnURL = "/";

	if(!$_POST['username'] || !$_POST['password']) {
		die(msg(0,"Не введен логин / пароль."));
	}

	else {
		$res = login($_POST['username'],$_POST['password']);
		if ($res == 1){
			die(msg(0,"Логин или пароль введен неправильно!"));
		}
		if ($res == 2){
			die(msg(0,"Извените, но ваш аккаунт заблокирован."));
		}
		if ($res == 99){
			echo(msg(1,$returnURL));
		}
	}
}

function doRegister(){
	$sitesettings = getSiteSettings();
	$site_url = $sitesettings[0]['site_url'];

	if(!(isset($_SESSION['captcha_keystring']) && $_SESSION['captcha_keystring'] === $_POST['keystring'])) {
		die(msg(0,"<p>Неверно указан текст на картинке.</p>"));
	}
	if(!$_POST['regname']) {
		die(msg(0,"<p>Пожалуйста укажите логин.</p>"));
	}
	if(strlen($_POST['regname'])<3 || strlen($_POST['regname'])>15)	{
		die(msg(0,"<p>Длинна логина должна быть от 3 до 15 символов.</p>"));
	}
	if(uniqueUser($_POST['regname'])) {
		die(msg(0,"Выбранный логин уже занят."));
	}
	if(!$_POST['regpass']) {
		die(msg(0,"<p>Пожалуйста введите пароль.</p>"));
	}
	if(strlen($_POST['regpass'])<5)	{
		die(msg(0,"<p>Длинна пароля должна быть как минимум 5 символов.</p>"));
	}
	if($_POST['regpass']!=$_POST['confirmation']) {
		die(msg(0,"Введенный пароль не совпадает с его подтвержением."));
	}
	if(!$_POST['email']) {
		die(msg(0,"<p>Пожалуйста укажите электронную почту.</p>"));
	}
    if(validateEmail($_POST['email'])) {
		die(msg(0,"<p>Неправильный адрес электронной почты.</p>"));
	}
	if(uniqueEmail($_POST['email'])) {
		die(msg(0,"<p>Указанный адрес электронной почты уже занят - укажите другой адрес.</p>"));
	}

	else {
		$res = addUser($_POST['regname'],$_POST['regpass'],$_POST['email'],$site_url);
		if ($res == 2){
			die(msg(0,"Произошла ошибка при обработке регистрационных данных. Пожалуйста свяжитесь с администрацией сайта."));
		}
		if ($res == 99){
			die(msg(1,"<p>Регистрация успешна! <a href='/user/login'>Нажмите сюда</a> для входа.</p>"));
		}
	}
}

function editProfile(){
	checkLogin('2');	
	if($_POST['phone'] && !validateNumeric($_POST['phone'])) {
		die(msg(0,"Номер телефона может содержать только цифры."));
	}
	if($_POST['email'] && validateEmail($_POST['email'])) {
		die(msg(0,"Неправильная электронная почта!"));
	}
	if($_POST['email'] && uniqueEmail($_POST['email']))	{
		die(msg(0,"Этот адрес электронной почты уже присутствует в базе. Пожалуйста введите другую электронную почту."));
	}
	
	$res = editUser($_SESSION['user_id'],$_POST['email'],$_POST['first_name'],$_POST['last_name'],0,$_POST['phone'],$_POST['city'],$_POST['country']);
	if($res == 4){
		die(msg(0,"Внутренняя ошибка. Свяжитесь со службой поддержки!"));
	}
	if($res == 99){
		die(msg(1,"Профиль обновлен успешно!"));
	}
}

function changePass(){
	checkLogin('2');
	if (empty($_POST['oldpassword']) || empty($_POST['newpassword1']) || empty($_POST['newpassword2'])) {
		die(msg(0,"Не введен старый или новый пароли."));
	}
	if(strlen($_POST['newpassword1'])<5) {
		die(msg(0,"Пароль должен состоять из более чем пяти символов."));
	}
	if($_POST['newpassword1']!=$_POST['newpassword2'] )	{
		die(msg(0,"Новый пароль не совпадает с его подтвержением."));
	}

	$res = updatePass($_SESSION['user_id'], $_POST['oldpassword'], $_POST['newpassword1']);
	if($res == 2){
		die(msg(0,"Неверно указан старый пароль!"));
	}
	if($res == 3){
		die(msg(0,"Возникла ошибка при обновлении пароля. Свяжитесь со службой поддержки."));
	}
	if($res == 99){
		die(msg(1,"Новый пароль успешно установлен."));
	}
}

function doSearch() {
    $shopConfig = getShopConfig();
	$text = '';
	$query = $_POST['search'];
  	$query = trim($query); 
    $query = mysql_real_escape_string($query);
    $query = htmlspecialchars($query);

    if (!empty($query)) { 
        if (strlen($query) < 3) {
            $text = '';
        } else if (strlen($query) > 128) {
            $text = '<li>Слишком длинный поисковый запрос.</li>';
        } else { 
        	$query = explode(" ", $query);
			$q = "SELECT `pd_id`, `pd_name`, `pd_description`, `pd_thumbnail`, `pd_price`
	                  FROM `tbl_product` 
	                  WHERE ";
        	foreach ($query as $key => $value) {
        		$q .= "(`pd_id` LIKE '%".$value."%' OR `pd_name` LIKE '%".$value."%' OR `pd_description` LIKE '%".$value."%') AND ";
        	}
        	$q = substr($q, 0, -4);
	        $q .= "ORDER BY `pd_id` LIMIT 8";
	        $result = mysql_query($q);
			if (mysql_affected_rows() > 0) { 
	            $row = mysql_fetch_assoc($result); 
	            $num = mysql_num_rows($result);
	            do {
					$row['pd_price'] = sprintf("%.02f",$row['pd_price']*$shopConfig["exch"])."грн";
	                $text .= '<li>
	                			  <a href="/shop/product-'.$row['pd_id'].'" title="'.$row['pd_name'].'">
	                			  <img src="/images/product/'.$row['pd_thumbnail'].'" style="padding-right:20px"/>
	                			  <span>'.$row['pd_name'].'</span>&nbsp;<span style="padding-left:20px;">Цена&nbsp;'.$row['pd_price'].'</span></a>
	                		  </li>';
	            } while ($row = mysql_fetch_assoc($result)); 
	            if (mysql_affected_rows() == 8) {
	            	$text .= '<li><a href="/search/'.$_POST['search'].'" title="'.$row['pd_name'].'">Просмотреть все результаты поиска -></a></li>';
	            }
		    } else {
	            $text = '<li>По вашему запросу ничего не найдено.</li>';
	        }
        } 
    } else {
        $text = '';
    }
    echo "$text";
}

function doShipping() {
	$returnURL = "/checkout?step=2";
	if(!$_POST['name'])	{
		die(msg(0,"<p>Пожалуйста укажите имя.</p>"));
	}
	if(!$_POST['phone']) {
		die(msg(0,"<p>Пожалуйста укажите номер телефона.</p>"));
	}
	elseif($_POST['phone'] && !validateNumeric($_POST['phone'])) {
			die(msg(0,"Номер телефона может содержать только цифры."));
		}
	if(!$_POST['email']) {
		die(msg(0,"<p>Пожалуйста укажите адрес электронной почты.</p>"));
	}
	elseif($_POST['email'] && validateEmail($_POST['email'])) {
			die(msg(0,"Неправильная электронная почта!"));
		}
	if(!$_POST['city'])	{
		die(msg(0,"<p>Пожалуйста укажите город.</p>"));
	}
	
	$res = addShipping($_POST['name'],$_POST['phone'],$_POST['email'],$_POST['city'],$_POST['address'],$_POST['optPayment']);
	if($res == 1){
		die(msg(0,"Внутренняя ошибка. Свяжитесь со службой поддержки!"));
	}
	if($res == 99){
		echo(msg(1,$returnURL));
	}
}

function doOrder() {
	require_once('library/checkout-functions.php');
	if(!$_POST['name'])	{
		die(msg(0,"<p>Пожалуйста укажите имя.</p>"));
	}
	if(!$_POST['phone']) {
		die(msg(0,"<p>Пожалуйста укажите номер телефона.</p>"));
	}
	elseif($_POST['phone'] && !validateNumeric($_POST['phone'])) {
			die(msg(0,"Номер телефона может содержать только цифры."));
		}
	if(!$_POST['email']) {
		die(msg(0,"<p>Пожалуйста укажите адрес электронной почты.</p>"));
	}
	elseif($_POST['email'] && validateEmail($_POST['email'])) {
			die(msg(0,"Неправильная электронная почта!"));
	}
	
	if (!empty($_SESSION['user_id'])) { $usID = $_SESSION['user_id']; }	else { $usID = 0; }

	$res = addOrder($_POST['name'],$_POST['phone'],$_POST['email'],$_POST['pdId'],$usID);
	if($res == 1){
		die(msg(0,"Внутренняя ошибка. Свяжитесь со службой поддержки!"));
	}
	if($res == 99){
		die(msg(1,"Заказ оформлен успешно!"));
	}
}

function doReview() {
	if(empty($_SESSION['user_id'])) {
		if(!(isset($_SESSION['captcha_keystring']) && $_SESSION['captcha_keystring'] === $_POST['keystring'])) {
			die(msg(0,"<p>Неверно указан текст на картинке.</p>"));
		} 
	}
	if(strlen($_POST['username'])<1) {
		die(msg(0,"<p>Пожалуйста введите имя.</p>"));
	}
	/*elseif(strlen($_POST['username'])<3 || strlen($_POST['username'])>25) {
		die(msg(0,"<p>Имя должно быть как минимум ТРИ символа длинной.</p>"));
	}*/
	if(!$_POST['email']) {
		die(msg(0,"<p>Пожалуйста введите почтовый адрес.</p>"));
	}
	elseif(validateEmail($_POST['email'])) {
		die(msg(0,"<p>Неправильный адрес электронной почты.</p>"));
	}
	if(!$_POST['rvtext']) {
		die(msg(0,"<p>Пожалуйста введите текст отзыва/вопроса.</p>"));
	}
	/*elseif(uniqueEmail($_POST['email']))
	{
		die(msg(0,"<p>На этот товар вы уже отправляли свой отзыв.</p>"));
	}*/

	$res = addReview($_POST['username'],$_POST['rating'],$_POST['email'],$_POST['rvtext'],$_POST['pdid'],$_POST['usrid']);
	if ($res == 1){
		die(msg(0,"<p>Произошла ошибка при регистрации. Пожалуйста свяжитесь с администрацией сайта.</p>"));
	}
	if ($res == 99){
		die(msg(1,"Отзыв успешно отправлен!"));
	}
}

function doContact() {
	$sitesettings = getSiteSettings();
	$site_email = $sitesettings[0]['site_email'];
	$find = "/(content-type|bcc:|cc:)/i";

	if(empty($_SESSION['user_id'])){
		if(!(isset($_SESSION['captcha_keystring']) && $_SESSION['captcha_keystring'] === $_POST['keystring'])) {
			die(msg(0,"<p>Неверно указан текст на картинке.</p>"));
		} 
	}
	if(!$_POST['username'])	{
		die(msg(0,"Введите ваше имя."));
	}
	elseif(preg_match($find, $_POST['username'])) {
		die(msg(0,"В имени присутствуют запрещенные к использованию символы."));
	}
	if(!$_POST['email'] || validateEmail($_POST['email']) || preg_match($find, $_POST['email'])) {
		die(msg(0,"Неправильно введен адрес электронной почты."));
	}
	if(!$_POST['message']) {
		die(msg(0,"Введите текст сообщения."));
	}
	elseif(preg_match($find, $_POST['message']) || strpos($_POST['message'], "&") !== false || strlen(strip_tags($_POST['message'])) < strlen($_POST['message'])) {
		die(msg(0,"В сообщении присутствуют запрещенные к использованию символы."));
	}

	$res = contactUs($_POST['username'],$_POST['email'],$_POST['message'],$site_email);
	if ($res == 1){
		die(msg(0,"При отправке вашего запроса произошла ошибка. Пожалуйста попробуйте позднее."));
	}
	if ($res == 99){
		die(msg(1,"Спасибо за ваше обращение. Мы рассмотрим его как можно быстрее"));
	}
}

function doPassReset() {
	$sitesettings = getSiteSettings();
	$site_url = $sitesettings[0]['site_url'];

	if(!$_POST['email']) {
		die(msg(0,"Пожалуйста введите ваш адрес электронной почты."));
	}
	if(validateEmail($_POST['email'])) {
		die(msg(0,"Неправильно введен адрес электронной почты!"));
	}
	
	$res = pass_recovery($_POST['email'],$site_url);
	if($res == 1){
		die(msg(0,"Произошла ошибка при восстановлении пароля. Пожалуйста свяжитесь с администрацией сайта."));
	}
	if($res == 2){
		die(msg(0,"Произошла ошибка базы данных. Пожалуйста свяжитесь с администрацией сайта."));
	}
	if($res == 3){
		die(msg(0,"Введенный адрес электронной почты не совпадает ни с одним адресом в базе данных. Пожалуйста <a href='/user/register'>нажмите здесь</a> для регистрации."));
	}
	if($res == 99){
		die(msg(1,"Временный пароль выслан. Проверьте ваш почтовый ящик для дальнейших инструкций."));
	}
}

function doArrange() {
    switch ($_POST['arrange']){
        case 1:
            $_SESSION['arrange'] = 1;
            $_SESSION['sort_by'] = ' ORDER BY pd_name';
            break;
        case 2:
            $_SESSION['arrange'] = 2;
            $_SESSION['sort_by'] = ' ORDER BY pd_price ASC';
            break;
        case 3:
            $_SESSION['arrange'] = 3;
            $_SESSION['sort_by'] = ' ORDER BY pd_price DESC';
    }
}
?>