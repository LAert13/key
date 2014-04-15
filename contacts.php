<?php
require_once('library/config.php');
require_once('library/cart-functions.php');
$pageTitle = 'Контакты';
require_once('include/header.php');?>

	<script type="text/javascript">
		$(document).ready(function(){
	
			$('#ContactUsForm').submit(function(e) {
				 contactus();
				e.preventDefault();	
			});	
		});
	</script>

<?php require_once('include/top.php');?>

<div class="container" style="width: 960; padding:0;">
<div class="panel panel-default" style="margin-bottom:0; margin-top:5; min-height:400">
	<div class="panel-heading">Контакты</div>
		<div class="panel-body">
		  <div class="row">
			<div class="col-md-6">
				<p>Телефоны: 050 922 15 71, 068 293 82 08</p>
				<p>email: <a href="mailto:keyshop.ua@gmail.com">keyshop.ua@gmail.com</a></p>
			</div>
			<div class="col-md-6">
				<h4 align="center">Форма обратной связи</h4>
				<div class="done"><p>Ваше сообщение успешно отправлено! Мы рассмотрим его как можно быстрее.</p></div>
				<div class="form">
					<form id="ContactUsForm" action="contact_submit.php" method="post"> <!--class="mc-active">-->
						<table align="center" width="90%" cellspacing="1" cellpadding="1" border="0">
						  <tr>
							<td><label for="username" style="margin-right: 5;">Имя</label></td>
							<td><input onclick="this.value='';" class="form-control" name="username" type="text" size="25" maxlength="25" value="<?php if (!empty($_SESSION['user_id'])){if(empty($getuser[0]['first_name']) || empty($getuser[0]['last_name'])){echo $getuser[0]['username'];} else {echo $getuser[0]['first_name']." ".$getuser[0]['last_name'];} } ?>"/></td>
						  </tr>
						  <tr>
							<td><label for="email" style="margin-right: 5;">Электронная&nbsp;почта</label></td>
							<td><input onclick="this.value='';" class="form-control" name="email" type="text" size="25" maxlength="50" value="<?php if (!empty($_SESSION['user_id'])){ if(!empty($getuser[0]['email'])){echo $getuser[0]['email']; } } ?>"/></td>
						  </tr>
						  <tr>
							<td><label for="message">Текст сообщения</label></td>
							<td><textarea name="message" class="form-control" type="text" cols="40" rows="5"></textarea></td>
						  </tr>
						  <?php if (empty($_SESSION['user_id'])){ ?>
					  	  <tr><td colspan="2"><p>Введите текст, который вы видете на картинке:</p></td></tr>
						  <tr>
						  	<td>
						 		<img src="/kcaptcha/index.php?<? echo session_name() ?>=<?  echo session_id(); ?>">
						  	</td>
						  	<td><input class="form-control" type="text" name="keystring"></td>
						  </tr>
						  <?php } ?>
						  <tr>
						    <td colspan="2">
								<input class="btn btn-primary btn-block" style="margin-top: 5;" type="submit" name="submit" value="Отправить" /><img id="loading" src="images/loading.gif" alt="Отправляю..." />
							</td>
						  </tr>
						  <tr>
							<td colspan="2"><div id="error">&nbsp;</div></td>
						  </tr>
						</table>
					</form>
				</div><!--close form-->
			</div>
		</div>
	</div>
</div>
</div>

<?php require_once('include/footer.php'); ?>