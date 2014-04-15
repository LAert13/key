<?php
if (!defined('WEB_ROOT')) {
	exit;
}

$reviewsPerRow = 1;
$reviewsPerPage = 9;

//$productList    = getProductList($catId);
//$children = array_merge(array($catId), getChildCategories(NULL, $catId));
//$children = ' (' . implode(', ', $children) . ')';

$sql = "SELECT rv_id, rv_pd_id, rv_usr_name, rv_usr_rating, rv_text, rv_valid, rv_date 
		FROM tbl_review
		WHERE rv_pd_id = $pdId 
		ORDER BY rv_id";
$result     = dbQuery(getPagingQuery($sql, $reviewsPerPage));
$pagingLink = getPagingLink($sql, $reviewsPerPage, "c=$catId");
$numReviews = dbNumRows($result);


if ($numReviews > 0 ) {

	$i = 0;
	while ($row = dbFetchAssoc($result)) {
	
		extract($row);
		if ($rv_valid == 1) {
		?>
		<div class="rview">
			<b><?php echo "$rv_usr_name";?></b>&nbsp;>>&nbsp;<?php echo "$rv_date";?><br>Оценка : <?php echo "$rv_usr_rating";?><br>Отзыв: <?php echo "$rv_text";?>
		</div>
<?php } } }
else {
?>
		<div class="rview">Нет пользовательских отзывов об этом товаре</br>Ваш отзыв может быть первым</div>
<?php	
}	
?>
    
	<script type="text/javascript">
		$(document).ready(function(){
	
			$('#reviewForm').submit(function(e) {
				review();
				e.preventDefault();	
			});	
		});
	</script>
	
<div class="done"><p>Ваш отзыв успешно отправлен! <a href="/shop">Нажмите сюда</a> для продолжения покупок.</p></div><!--close done-->
<p align="center"><?php echo $pagingLink; ?></p>

<div class="form">
  <form id="reviewForm" action="/review_submit.php" method="post">
	<table align="center" width="60%" cellspacing="1" cellpadding="1" border="0">
		<tr>
			<td>&nbsp;</td>
			<td><p>Добавить свой отзыв</p></td>
		</tr>
		<tr>
			<td><label for="username">Имя:</label></td>
			<td>
				<input class="form-control" onclick="this.value='';" name="username" type="text" size="25" maxlength="25" value="<?php if (!empty($_SESSION['user_id'])){if(empty($getuser[0]['first_name']) || empty($getuser[0]['last_name'])){echo $getuser[0]['username'];} else {echo $getuser[0]['first_name']." ".$getuser[0]['last_name'];} } ?>"/>
			</td>
		</tr>
		<tr>
			<td><label for="rating">Оценка товара:</label></td>
			<td>
   			   <input type="radio" name="rating" value="1"> 1
			   <input type="radio" name="rating" value="2"> 2
			   <input type="radio" name="rating" value="3"> 3
			   <input type="radio" name="rating" value="4"> 4
			   <input type="radio" name="rating" value="5" checked> 5
			</td>
		</tr>
		<tr>
			<td><label for="email">Электронная&nbsp;почта:</label></td>
			<td>
				<input class="form-control" onclick="this.value='';" name="email" type="text" size="25" maxlength="50" value="<?php 
					   if (!empty($_SESSION['user_id'])){
						if(!empty($getuser[0]['email'])){echo $getuser[0]['email'];}
						}
					 ?>"/>
				<input name="pdid" type="hidden" value="<?php echo $pdId;?>"/>
				<input name="usrid" type="hidden" value="<?php if (!empty($_SESSION['user_id'])){echo $getuser[0]['id'];}?>"/>
			</td>
		</tr>
 		<tr>
			<td><label for="rvtext">Текст отзыва:</label></td>
			<td><textarea name="rvtext" class="form-control" type="text" cols="40" rows="5"></textarea></td>
		</tr>
		<?php if (empty($_SESSION['user_id'])){ ?>
		<tr>
		  	<td colspan="2"><p>Введите текст, который вы видете на картинке:</p></td>
		</tr>
		<tr>
		  	<td>
		  		<img src="/kcaptcha/index.php?<? echo session_name() ?>=<?  echo session_id(); ?>">
		  	</td>
		  	<td><input class="form-control" type="text" name="keystring"></td>
		</tr>
		<?php } ?>
		<tr>
			<td>&nbsp;</td>
			<td><input class="btn btn-primary btn-block" type="submit" value="Отправить отзыв" /><img id="loading" src="images/loading.gif" alt="Отправляю..." /></td>
		</tr>
		<tr><td colspan="2"><div id="error">&nbsp;</div></td></tr>
	</table>
  </form>
</div>
