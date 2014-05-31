<?php
if (!defined('WEB_ROOT')) {
    exit;
}

// make sure a product id exists
if (isset($_GET['productId']) && $_GET['productId'] > 0) {
    $productId = $_GET['productId'];
} else {
    // redirect to index.php if product id is not present
    header('Location: index.php');
}

?>

<p align="center" class="formTitle">Изменить Фильтры Товара</p>
<form action="processProduct.php?action=writeLink&pdId=<?php echo $productId; ?>" method="post" enctype="multipart/form-data" name="frmAddFilters" id="frmAddFilters">
    <table width="100%" border="0" align="center" cellpadding="2" cellspacing="1" class="text">
        <tr align="center" id="listTableHeader">
            <td>Имя Фильтра</td>
            <td>Значение Фильтра</td>
        </tr>
        <?php
        $sql = "SELECT flt_id
                FROM tbl_product pd, tbl_category_link ln
                WHERE pd_id = $productId AND pd.cat_id = ln.cat_id";
        $result = mysql_query($sql);

        if (dbNumRows($result) > 0) {
            $i = 0;

            while($row = dbFetchAssoc($result)) {
                $fltId = $row['flt_id'];
                $sql = "SELECT flt_name
                        FROM tbl_filters
                        WHERE flt_id = $fltId";
                $res = dbFetchAssoc(mysql_query($sql));
                extract($res);

                if ($i%2) {
                    $class = 'row1';
                } else {
                    $class = 'row2';
                }
                $i += 1;
                ?>
                <tr class="<?php echo $class; ?>">
                    <td><?php echo '<input name="filter_'.$i.'" value="'.$flt_name.'" hidden />'.$flt_name; ?></td>
                    <td>
                        <?php
                            $sql = "SELECT flt_id FROM tbl_filters WHERE flt_name = '$flt_name'";
                            $res = mysql_query($sql);
                            $row = mysql_fetch_assoc($res);
                            $fltId = $row['flt_id'];
                            $sql = "SELECT vl.val_value, vl.val_id FROM tbl_filter_value vl, tbl_filter_link lnk WHERE lnk.flt_id = '$fltId' AND vl.val_id = lnk.val_id ORDER BY vl.val_value ASC";
                            $res = mysql_query($sql);
                            $text = "<select name=\"value_".$i."\" id=\"value_".$i."\">";
                            $a = mysql_fetch_assoc(mysql_query("SELECT val_id FROM tbl_product_link WHERE pd_id = $productId AND flt_id = $fltId"));
                            if ($a['val_id'] == '') {$text .= "<option selected>...</option>";}
                            while ($row = mysql_fetch_assoc($res)){
                                if ($row['val_id'] == $a['val_id']) {$text .= "<option selected value=\"".$row['val_value']."\">".$row['val_value']."</option>";}
                                else {$text .= "<option value=\"".$row['val_value']."\">".$row['val_value']."</option>";}
                            }
                            $text .= "</select>";
                            echo($text);
                        ?>
                        <input name="btnAddValue" type="button" id="btnAddValue" value="Добавить Значение" class="box" onClick="addFilterValue(<?php echo $fltId?>,<?php echo $productId?>)">
                    </td>
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

    <p align="center">
        <input type="submit" value="Сохранить фильтры" class="box">
        &nbsp;&nbsp;<input name="btnCancel" type="button" id="btnCancel" value="Отмена" onClick="window.location.href='index.php';" class="box">
    </p>
</form>