	<script type="text/javascript">
		$(document).ready(function(){
	
			$('#editprofileForm').submit(function(e) {
				editprofile();
				e.preventDefault();	
			});	
		});
	</script>

<div class="container" style="width: 960; padding:0;">
	<div class="panel panel-default" style="margin-bottom:0; margin-top:5; min-height:400">
		<div class="panel-heading">Редактирование профиля</div>
		<div class="panel-body"><p align="center" class="done">Профиль успешно обновлен</p></div>
		<div class="form">
			<form id="editprofileForm" action="/submit.php?action=editProfile" method="post">
				<table class="searchForm" border="0" align="center">
					<tr>
						<td><label for="first_name" style="margin-right: 5;">Имя</label></td>
						<td><input class="form-control" type="text" name="first_name" value="<? if(isset($getuser[0]['first_name'])){echo $getuser[0]['first_name'];}?>"/></td>
					</tr>
					<tr>
						<td><label for="last_name" style="margin-right: 5;">Фамилия</label></td>
						<td><input class="form-control" type="text" name="last_name" value="<? if(isset($getuser[0]['last_name'])){echo $getuser[0]['last_name'];}?>" /></td>
					</tr>
					<tr>
						<td><label for="email" style="margin-right: 5;">Электронная почта</label></td>
						<td><input class="form-control" type="text" name="email" value="" /><span class="label1">&nbsp;Текущая: <?= $getuser[0]['email'];?></span></td>
					</tr>
					<tr>
						<td><label for="phone" style="margin-right: 5;">Телефон</label></td>
						<td><input class="form-control" type="text" name="phone" value="<? if(isset($getuser[0]['phone'])){echo $getuser[0]['phone'];}?>" /></td>
					</tr>
					<tr>
						<td><label for="city" style="margin-right: 5;">Город</label></td>
						<td><input class="form-control" type="text" name="city" value="<? if(isset($getuser[0]['city'])){echo $getuser[0]['city'];}?>" /></td>
					</tr>
					<tr>
						<td><label for="country" style="margin-right: 5;">Страна</label></td>
						<td><?= get_select_countries($_SESSION['user_id']);?></td>
					</tr>
					<tr>
						<td colspan="2"><input class="btn btn-primary btn-block" type="submit" name="editprofile" value="Обновить данные" /><img id="loading" src="/images/loading.gif" alt="Updating.." /></td>
					</tr>
					<tr>
						<td colspan="2"><div id="error">&nbsp;</div></td>
					</tr>
				</table>
			</form>
		</div><!--close form-->
	</div>
</div>