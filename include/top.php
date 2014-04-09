<div class="container" style="width: 960; padding:0;">
	<div class="navbar navbar-default" role="navigation" style="min-height: 34;">
        <div class="container-fluid">
          <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="/">KEYSHOP</a>
          </div>
          <div class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
              <li><a href="#">Link</a></li>
              <li><a href="#">Link</a></li>
              <li><a href="#">Link</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
	    <?php
			include 'library/functions.php';
			if (!empty($_SESSION['user_id'])){
				checkLogin('2');
				$getuser = getUserRecords($_SESSION['user_id']);
		?>
              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php if(empty($getuser[0]['first_name']) || empty($getuser[0]['last_name'])){echo $getuser[0]['username'];} else {echo $getuser[0]['first_name']." ".$getuser[0]['last_name'];} ?><b class="caret"></b></a>
                <ul class="dropdown-menu">
                  <li><a href="edit_profile.php">Редактировать профиль</a></li>
                  <li><a href="change_pass.php">Изменить пароль</a></li>
                  <li><a href="order_list.php">История заказов</a></li>
                  <li><a href="review_list.php">Мои отзывы</a></li>
                </ul>
              </li>
              <li><a href="log_off.php?action=logoff">Выход</a></li>
	    <?php
			}
			else {
		?>
				<li><a href="login.php">Вход</a></li>
				<li><a href="register.php">Регистрация</a></li>
		<?php
			}
		?>
            </ul>
          </div>
        </div>
    </div>
	<div class="row" style="margin-bottom: 5;">
  		<div class="col-md-10"></div>
  		<div class="col-md-2">
			<?php
			$cartContent = getCartContent();
			$numItem = count($cartContent);	
			?>
			<table width="100%" border="0" cellspacing="0" cellpadding="2" id="minicart">
			<?php
			if ($numItem > 0) {
				$subTotal = 0;
				$qty = 0;
				for ($i = 0; $i < $numItem; $i++) {
					extract($cartContent[$i]);
					$subTotal += $pd_price * $ct_qty;
					$qty = $qty + $ct_qty;
				}; // end while
				//Окончание слова товар
				if ($qty == 1) { $ending = ''; }
				elseif ($qty >= 2 and $qty <= 4) { $ending = 'а'; }
				else { $ending = 'ов'; }
			?>
			 <tr>
			  <td align="center">В <a href="cart.php?action=view">корзине</a> <?php echo $qty; ?> товар<?php echo $ending; ?></td>
			 </tr>
			 <tr>
			  <td align="center"> на сумму <?php echo displayAmount($subTotal); ?></td>
			 </tr>
			  <tr>
			  <td align="center"><a href="cart.php?action=view"> Оформить заказ </a></td>
			 </tr>  
			<?php	
			} else {
			?>
			  <tr><td>&nbsp;</td></tr>
			  <tr><td colspan="2" align="center" valign="middle">Корзина пуста</td></tr>
			  <tr><td>&nbsp;</td></tr>
			<?php
			}
			?> 
			</table>
  		</div>
	</div>
	<div class="navbar navbar-default" role="navigation" style="min-height: 34;">
        <div class="container-fluid">
          <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
          </div>
          <div class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
              <li><a href="/">Домой</a></li>
              <li><a href="#">Доставка и оплата</a></li>
              <li><a href="#">Статьи</a></li>
              <li><a href="#">Помощь</a></li>
              <li><a href="contacts.php">Контакты</a></li>
            </ul>
           </div>
        </div>
      </div>
</div>