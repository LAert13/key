<?php
$sid = session_id();
$sql = "SELECT * FROM tbl_shipping WHERE sh_session = '$sid' ORDER BY sh_id DESC LIMIT 1";
$res = mysql_query($sql) or die(mysql_error());
$res = mysql_fetch_assoc($res);
if ($res['sh_flag'] == 1) {
  extract($res);
}
?>

  <script type="text/javascript">
    $(document).ready(function(){
  
      $('#frmCheckout').submit(function(e) {
        shipping();
        e.preventDefault(); 
      }); 
    });
  </script>

<div class="container" style="width: 960; padding:0;">
    <div class="panel panel-default" style="margin-bottom:0; margin-top:5; min-height:400">
        <div class="panel-heading">Шаг 1 из 2 : Контактная информация</div>
        <div class="panel-body"><div id="error">&nbsp;</div><div class="done"><p>Ваш отзыв успешно отправлен! <a href="shop">Нажмите сюда</a> для продолжения покупок.</p></div></div>
        <div class="form">
            <form action="/submit.php?action=shipping" method="post" name="frmCheckout" id="frmCheckout">
                <table align="center" width="60%" cellspacing="1" cellpadding="1" border="0">
                  <tr> 
                    <td colspan="2"><label>Контактная информация</label></td>
                  </tr>
                  <tr>
                    <td><label for="name" style="margin-right: 5;">ФИО покупателя</label></td>
                    <td><input onclick="this.value='';" class="form-control" name="name" id="name" type="text" size="25" maxlength="25" value="<?php if(!empty($sh_name)){ 
                                    echo $sh_name; } 
                              else { 
                                    if (!empty($_SESSION['user_id'])){
                                        if(empty($getuser[0]['first_name']) || empty($getuser[0]['last_name'])){
                                            echo $getuser[0]['username'];} 
                                        else {echo $getuser[0]['first_name']." ".$getuser[0]['last_name'];} } } ?>"/></td>
                  </tr>
                  <tr>
                    <td><label for="phone" style="margin-right: 5;">Номер телефона</label></td>
                    <td><input onclick="this.value='';" class="form-control" name="phone" id="phone" type="text" size="25" maxlength="25" value="<?php if(!empty($sh_phone)){ 
                                        echo $sh_phone; } 
                                 else { 
                                        if(isset($getuser[0]['dialing_code'])){
                                            echo $getuser[0]['dialing_code'];} 
                                        if(isset($getuser[0]['phone'])){ echo $getuser[0]['phone'];} } ?>"/></td>
                  </tr>
                  <tr>
                    <td><label for="email" style="margin-right: 5;">Электронная почта</label></td>
                    <td><input onclick="this.value='';" class="form-control" name="email" id="email" type="text" size="25" maxlength="25" value="<?php if(!empty($sh_email)){ 
                                        echo $sh_email; } 
                                 else { if (isset($getuser[0]['email'])){ echo $getuser[0]['email'];} } ?>"/></td>
                  </tr>
                  <tr>
                    <td><label for="city" style="margin-right: 5;">Город</label></td>
                    <td><input onclick="this.value='';" class="form-control" name="city" id="city" type="text" size="25" maxlength="25" value="<?php if(!empty($sh_city)){ 
                                        echo $sh_city; } 
                                 else { if (isset($getuser[0]['city'])){ echo $getuser[0]['city'];} } ?>"/></td>
                  </tr>
                  <tr>
                    <td><label for="address" style="margin-right: 5;">Адрес доставки (необязательно)</label></td>
                    <td><input onclick="this.value='';" class="form-control" name="address" id="address" type="text" size="50" maxlength="100" value="<?php if(!empty($sh_address)){ echo $sh_address; } ?>"/></td>
                    <input name="userid" type="hidden" class="box" id="userid" size="30" maxlength="32" value="<?php if(isset($getuser[0]['id'])){echo $getuser[0]['id'];} else {echo '0';}?>">
                  </tr>
                  <tr>
                    <td width="150"><label>Способ достаки и оплаты</label></td>
                    <td class="content">
                        <input name="optPayment" type="radio" id="optCour" value="cour"/>
                        <label for="optCour" style="cursor:pointer">Новая почта</label>
                        <input name="optPayment" type="radio" value="cod" id="optCod" checked="checked" />
                        <label for="optCod" style="cursor:pointer">Самовывоз</label>
                    </td>
                  </tr>
                  <tr>
                    <td>
                        <input class="btn btn-primary btn-block" style="margin-top: 5;" name="btnBack" type="button" id="btnBack" onClick="window.location.href='/order/cart';" value="Назад" />
                    </td>
                    <td>
                        <input class="btn btn-success btn-block" style="margin-top: 5;" type="submit" name="btnStep1" id="btnStep1" value="Далее" />
                    </td>
                  </tr>
                </table>
            </form>
        </div><!--close form-->
    </div>
</div>