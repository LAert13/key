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
$reviewsPerPage = 10;

$sql = "SELECT rv_id, rv_pd_id, pd_id, pd_name, rv_usr_id, rv_usr_name, rv_usr_rating, rv_text, rv_date 
    FROM tbl_review r, tbl_product p
    WHERE r.rv_usr_id = $usrid and p.pd_id = r.rv_pd_id
    ORDER BY rv_id";
$result     = dbQuery(getPagingQuery($sql, $reviewsPerPage));
$pagingLink = getPagingLink($sql, $reviewsPerPage);
$numReviews = dbNumRows($result);

?>
<div class="container" style="width: 960; padding:0;">
  <div class="panel panel-default" align="center" style="margin-bottom:0; margin-top:5; min-height:400">
    <div class="panel-heading" align="left"style="margin-bottom:5;">Мои отзывы</div>
    <?php
    if ($numReviews > 0 ) {
      $i = 0;
      while ($row = dbFetchAssoc($result)) {
        extract($row);
        ?>
            <div class="rview" align="left" style="width: 98%">
              <b><?php echo "$pd_name";?></b>&nbsp;>>&nbsp;<?php echo "$rv_date";?><br>Оценка : <?php echo "$rv_usr_rating";?><br>Отзыв: <?php echo "$rv_text";?>
            </div>
    <?php } }
    else {
    ?>
              <div class="rview">Нет пользовательских отзывов</div>
    <?php 
    } 
    ?>
  </div>
</div>
<? require_once('include/footer.php'); ?>