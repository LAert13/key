<?php
if (!defined('WEB_ROOT')) {
    exit;
}

// make sure a product id exists
if (isset($_GET['catId']) && $_GET['catId'] > 0) {
    $catId = $_GET['catId'];
} else {
    // redirect to index.php if product id is not present
    header('Location: index.php');
}
$sql = "SELECT cat_name
        FROM tbl_category
        WHERE cat_id = $catId";
$result = mysql_query($sql);
$row = dbFetchAssoc($result);
?>

<p align="center" class="formTitle">Изменить Фильтры Категории <?php echo $row['cat_name'];?></p>
<table width="100%" border="0" align="center" cellpadding="2" cellspacing="1" class="text">
    <tr align="center" id="listTableHeader">
        <td>Имя Фильтра</td>
        <!--<td width="70">Изменить</td>-->
        <td width="70">Удалить</td>
    </tr>
    <?php
    $sql = "SELECT fl.flt_id, flt_name
                FROM tbl_category_link lnk, tbl_filters fl
                WHERE lnk.cat_id = $catId AND fl.flt_id = lnk.flt_id";
    $result = mysql_query($sql);

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
            <tr class="<?php echo $class; ?>">
                <td><?php echo $flt_name; ?></td>
                <!--<td width="70" align="center"><a href="javascript:modifyProductFilter(<?php echo $productId; ?>);">Изменить</a></td>-->
                <td width="70" align="center"><a href="javascript:deleteCategoryFilter(<?php echo $catId; ?>,<?php echo $flt_id; ?>);">Удалить</a></td>
            </tr>
        <?php
        } // end while
        ?>
    <?php
    } else {
        ?>
        <tr>
            <td colspan="2" align="center">Пока не добавлено ни одного фильтра</td>
        </tr>
    <?php
    }
    ?>
</table>

<form action="processCategory.php?action=writeLink&catId=<?php echo $catId; ?>" method="post" enctype="multipart/form-data" name="frmAddFilters" id="frmAddFilters">
    <div id="inputi">
        <div>
            <span>Для добавления фильтра нажмите эту кнопку -> </span><input type="button" value="+" onclick="add_filter_input(this.parentNode)">
        </div>
    </div>
    <p align="center">
        <input type="submit" value="Сохранить фильтры" class="box">
        &nbsp;&nbsp;<input name="btnCancel" type="button" id="btnCancel" value="Отмена" onClick="window.location.href='index.php';" class="box">
    </p>
</form>