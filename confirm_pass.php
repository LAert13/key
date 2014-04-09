<?PHP
DEFINE('INCLUDE_CHECK',1);
require_once('library/config.php');
include('library/functions.php');

$id = '';
if (isset($_GET['id'])){
	if (is_numeric($_GET['id'])){
		$id = secureInput($_GET['id']);}
		}
			
$new = '';
if (isset($_GET['new'])){
	$new = secureInput($_GET['new']);
	}
	
	$res = confirm_pass($id,$new);
		if ($res == 1){
			$error = "Навозможно обновить ваш пароль. Пожалуйста свяжитесь с администрацией сайта.";
			}
		if ($res == 2){
			$error = "Новый пароль уже подтвержен или неправилен!";
			}
		if ($res == 3){
			$error = "Пользователя с таким именем не существует.";
			}
		if ($res == 99){
			$message = "Ваш новый пароль подтвержен. Вы можете <a href='login.php'>войти на сайт</a> используя его.";
			}


$sitesettings = getSiteSettings();

$pageTitle = 'Подтверждение пароля';
require_once('include/head_log.php');
?>
	
</head>
<body>

<?php require_once('include/top.php'); ?>

	<hr/>
				<? if(isset($error))
					{
						echo '<div class="error">' . $error . '</div>' . "\n";
					}
					   else if(isset($message)) {
							echo '<div class="message">' . $message . '</div>' . "\n";
						} 
				?>
</body>
</html>
