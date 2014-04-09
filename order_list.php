<?PHP
$pageTitle = 'История заказов';

require_once 'library/cart-functions.php';
require_once 'include/header_usr.php';

?>

</head>
<body>

<?php require_once('include/top.php');

$queryString = '';
$usrid = $getuser[0]['id'];

// for paging
// how many rows to show per page
$rowsPerPage = 10;


$sql = "SELECT o.od_id, o.od_shipping_first_name, od_date, od_status,
               SUM(pd_price * od_qty) AS od_amount
	    FROM tbl_order o, tbl_order_item oi, tbl_product p 
		WHERE oi.pd_id = p.pd_id and o.od_id = oi.od_id and o.od_user_id = $usrid
		GROUP BY od_id
		ORDER BY od_id DESC";
$result     = dbQuery(getPagingQuery($sql, $rowsPerPage));
$pagingLink = getPagingLink($sql, $rowsPerPage, $queryString);
?> 
<div class="container" style="width: 960; padding:0;">
  <div class="panel panel-default" style="margin-bottom:0; margin-top:5; min-height:400">
    <div class="panel-heading">История заказов</div>
       <table class="table" width="96%" border="0" align="center" cellpadding="2" cellspacing="1" class="text">
        <thead>
          <tr align="center"> 
           <th><p align="center" style="margin-bottom:0;">Номер</p></td>
           <th><p align="center" style="margin-bottom:0;">Сумма</p></td>
           <th><p align="center" style="margin-bottom:0;">Дата и время</p></td>
           <th><p align="center" style="margin-bottom:0;">Статус</p></td>
           <th>&nbsp;</td>
          </tr>
        </thead>
        <tbody>
        <?php
        $parentId = 0;
        if (dbNumRows($result) > 0) {
        	$i = 0;
        	
        	while($row = dbFetchAssoc($result)) {
        		extract($row);
        		if ($i%2) {
        			$class = 'row1';
        		} else {
        			$class = 'row2';
        		}
        		$i += 1;
        ?>
        <tr align="center"> 
         <td width="15%"><?php echo $od_id; ?></td>
         <td width="15%"><?php echo displayAmount($od_amount); ?></td>
         <td width="30%"><?php echo $od_date; ?></td>
         <td width="20%"><?php echo $od_status; ?></td>
         <td width="20%"><a href="order_detail.php?oid=<?php echo $od_id; ?>" class="btn btn-primary btn-sm">Просмотр заказа</a></td>
        </tr>
        <?php
      	   } // end while
        ?>
        <tr> 
         <td colspan="5" align="center">
         <?php 
         echo $pagingLink;
         ?></td>
        </tr>
      <?php
      } else {
      ?>
        <tr> 
         <td colspan="5" align="center">Не найдено заказов</td>
        </tr>
        <?php
      }
      ?>
        </tbody>
      </table>
  </div>
</div>

<?php require_once('include/footer.php'); ?>