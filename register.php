<?php
$pageTitle = 'Регистрация';

require_once('library/cart-functions.php');
require_once('include/header.php');
?>

	<script type="text/javascript">
		$(document).ready(function(){
	
			$('#regForm').submit(function(e) {
				register();
				e.preventDefault();	
			});	
		});
	</script>

</head>
<body>

<?php require_once('include/top.php'); ?>

<div class="container" style="width: 960; padding:0;">
		<div class="panel panel-default" style="margin-bottom:0; margin-top:5; min-height:400">
		<div class="panel-heading">Регистрация</div>
		<div class="panel-body"><div class="done" style="display: none"><p class="alert alert-success">Регистрация успешна! <a href="login">Нажмите сюда</a> для входа.</p></div></div>
		<div class="form">
			<form id="regForm" action="reg_submit.php" method="post">
				<table align="center" width="40%" cellspacing="1" cellpadding="1" border="0">
				  <tr>
					<td><label for="regname" style="margin-right: 5;">Логин</label></td>
					<td><input onclick="this.value='';" class="form-control" name="regname" type="text" size="25" maxlength="25" value=""/></td>
				  </tr>
				  <tr>
					<td><label for="regpass" style="margin-right: 5;">Пароль</label></td>
					<td><input class="form-control" name="regpass" type="password" size="25" maxlength="25" /></td>
				  </tr>
				  <tr>
					<td><label for="confirmation" style="margin-right: 5;">Подтверждение</label></td>
					<td><input class="form-control" name="confirmation" type="password" size="25" maxlength="25" /></td>
				  </tr>
				  <tr>
					<td><label for="email" style="margin-right: 5;">Электронная&nbsp;почта</label></td>
					<td><input onclick="this.value='';" class="form-control" name="email" type="text" size="25" maxlength="50" value=""/></td>
				  </tr>
				  <tr>
				  	<td colspan="2"><p>Введите текст, который вы видете на картинке:</p></td>
				  </tr>
				  <tr>
				  	<td>
				  		<img src="/kcaptcha/index.php?<? echo session_name() ?>=<?  echo session_id(); ?>">
				  	</td>
				  	<td><input class="form-control" type="text" name="keystring"></td>
				  </tr>
				   <tr>
			        <td colspan="2">
						<input class="btn btn-primary btn-block" style="margin-top: 5;" type="submit" name="register" value="Зарегистрироваться" /><img style="visibility: hidden" id="loading" src="images/loading.gif" alt="working.." />
					</td>
				  </tr>
				  <tr>
					<td colspan="2"><div id="error" class="alert alert-danger" style="visibility: hidden">&nbsp;</div></td>
				  </tr>
				</table>
			</form>
		</div><!--close form-->
	</div>
</div>
<?php require_once('include/footer.php'); ?>