<?php
$pageTitle = 'Вход в интернет-магазин';

require_once('library/cart-functions.php');
require_once('include/header.php');
?>
		
	<script type="text/javascript">
		$(document).ready(function(){
	
			$('#loginForm').submit(function(e) {
				login();
				e.preventDefault();	
			});	
		});
	</script>

</head>
<body>

<?php require_once('include/top.php'); ?>

<div class="container" style="width: 960; padding:0;">
	<div class="panel panel-default" style="margin-bottom:0; margin-top:5; min-height:400">
		<div class="panel-heading">Вход в интернет-магазин</div>
		<div class="panel-body">&nbsp;</div>
		<form id="loginForm" method="post" action="/submit.php?action=login">
			<table align="center" width="35%" cellspacing="1" cellpadding="1" border="0">
			  <tr>
				<td><label for="username" style="margin-right: 5;">Логин</label></td>
				<td><input onclick="this.value='';" class="form-control" name="username" type="text" size="25" maxlength="25"/></td>
			  </tr>
			  <tr>
				<td><label for="password" style="margin-right: 5;">Пароль</label></td>
				<td><input class="form-control" name="password" type="password" size="25" maxlength="15"/></td>
			  </tr>
			  <tr>
			  	<td colspan="2">&nbsp;</td>
			  </tr>
			  <tr>
			  	<td colspan="2">
				  	<div class="row">
				  		<div class="col-xs-6">
							<input class="btn btn-success btn-block" type="submit" name="submit" value="Войти" /><img style="visibility: hidden" id="loading" src="images/loading.gif" alt="Logging in.." />
						</div>
						<div class="col-xs-6"><a class="btn btn-primary btn-block" id="fgtpass" href="pass_reset">Забыли пароль?</a></div>
					</div>
				</td>
			  </tr>
			  <tr>
			  	<td colspan="2"><div id="error">&nbsp;</div></td>
			  </tr>
			  <tr>
			  	<td colspan="2">
					<label for="regusr" style="margin-top: 10;">Нет учетной записи?</label>
					<a class="btn btn-primary btn-block" style="color: #fff" id="regusr" name="regusr" href="register">Зарегистрироваться.</a>
                    <br />
				</td>
			  </tr>
			</table>
		</form>
	</div>
</div>
<?php require_once('include/footer.php'); ?>