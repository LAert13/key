<?php
if (!defined('WEB_ROOT')) {
	exit;
}

$photosPerRow = 3;

$sql = "SELECT pd_id, pd_img_dir, pd_img_cnt 
		FROM tbl_product
		WHERE pd_id = $pdId";

$photosPerPage = $pd_img_cnt;

$result     = dbQuery(getPagingQuery($sql, $photosPerPage));
$pagingLink = getPagingLink($sql, $reviewsPerPage, "c=$catId");
$numPhotos = dbNumRows($result);

$columnWidth = (int)(775 / $photosPerRow);

if ($numPhotos > 0 ) {
	$i = 0;
	while ($row = dbFetchAssoc($result)) {
		extract($row);
		for ($i = 0; $i < $pd_img_cnt; $i++) { ?>     
			 <a data-toggle="modal" data-target="#modal<?php echo $i?>"><img width="<?php echo $columnWidth?>" align="center" src="./images/<?php echo $pd_img_dir?>/<?php echo $pd_img_dir?>_<?php echo $i?>.jpg"></a>
			 <div class="modal fade" id="modal<?php echo $i?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
				  <div class="modal-dialog modal-lg" align="center" style="width:800">
				    <div class="modal-content">
				      <div class="modal-header">
				        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				        <h4 class="modal-title" id="myModalLabel">Фотография <?php echo $i+1?> из <?php echo $pd_img_cnt?></h4>
				      </div>
				      <div class="modal-body">
				        <img src="./images/<?php echo $pd_img_dir?>/<?php echo $pd_img_dir?>_<?php echo $i?>.jpg">
				      </div>
				    </div>
				  </div>
				</div>
<?php } } } ?>