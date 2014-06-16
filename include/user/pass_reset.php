	<script type="text/javascript">
		$(document).ready(function(){
	
			$('#passreset').submit(function(e) {
				passreset();
				e.preventDefault();	
			});	
		});

	</script>

<div class="container" style="width: 960; padding:0;">
	<div class="rview" style="margin-bottom:0; margin-top:5; min-height:400">
		
		  <div class="done"><p>Новый пароль выслан. Проверьте ваш почтовый ящик или папку со спамом.</p></div><!--close done-->
		  <div class="form">
			<form id="passreset" action="/submit.php?action=passReset" method="post">
			<table align="center" width="60%" cellspacing="1" cellpadding="1" border="0">
				<tr>
					<td colspan="2"><h3 align="center">Восстановление пароля</h3></td>
				</tr>
				<tr>
					<td colspan="2"><p>Введите электронную почту, которую вы указывали при регистрации</p></td>
				</tr>
			  <tr>
				<td><label for="email">Электронная почта:</label></td>
				<td><input onclick="this.value='';" name="email" type="text" size="25" maxlength="30" value="<?php if(isset($_POST['email'])){echo $_POST['email'];}?>" /></td>
			  </tr>
			  <tr>
				<td>&nbsp;</td>
				<td>
					<input type="submit" value="Отправить" /><img id="loading" src="/images/loading.gif" alt="Sending.." />
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