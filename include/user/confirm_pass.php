<?PHP
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
			$message = "Ваш новый пароль подтвержен. Вы можете <a href='/user/login'>войти на сайт</a> используя его.";
			}


$sitesettings = getSiteSettings();

?>
	
	<hr/>
				<? if(isset($error))
					{
						echo '<div class="error">' . $error . '</div>' . "\n";
					}
					   else if(isset($message)) {
							echo '<div class="message">' . $message . '</div>' . "\n";
						} 
				?>

