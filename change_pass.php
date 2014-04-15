<?PHP
$pageTitle = 'Смена пароля';

require_once 'library/cart-functions.php';
require_once 'include/header.php';

?>
		<script type="text/javascript">
			$(document).ready(function(){
		
				$('#updatepassForm').submit(function(e) {
					updatepass();
					e.preventDefault();	
				});	
			});

		</script>
</head>
<body>

<?php require_once('include/top.php'); ?>

<div class="container" style="width: 960; padding:0;">
	<div class="panel panel-default" style="margin-bottom:0; margin-top:5; min-height:400">
		<div class="panel-heading">Смена пароля</div>
		<div class="panel-body"><p align="center" class="done">Пароль изменен успешно</p></div>
		<div class="form">
			<table class="searchForm" border="0" align="center">
				<form id="updatepassForm" action="/change_pass_submit.php" method="post">
					<tr>
						<td><label for="oldpassword" style="margin-right: 5;">Старый пароль</label></td>
						<td><input class="form-control" name="oldpassword" type="password"/></td>
					</tr>
					<tr>
						<td><label for="newpassword1" style="margin-right: 5;">Новый пароль</label></td>
						<td><input class="form-control" name="newpassword1" type="password"/></td>
					</tr>
					<tr>
						<td><label for="newpassword2" style="margin-right: 5;">Подтверждение пароля</label></td>
						<td><input class="form-control" name="newpassword2" type="password"/></td>
					</tr>
					<tr>
						<td colspan="2" align="center"><input class="btn btn-primary btn-block" type="submit" name="submit" value="Сменить пароль" style="margin-top: 5;" /><img id="loading" src="../images/loading.gif" alt="Обновляю..." /></td>
					</tr>
					<tr>
						<td colspan="2"><div id="error">&nbsp;</div></td>
					</tr>
				</form>
			</table>
		</div><!--close form-->
	</div>
</div>

<?php require_once('include/footer.php'); ?>