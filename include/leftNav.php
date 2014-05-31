<?php
if (!defined('WEB_ROOT')) {
	exit;
}

// get all categories
$categories = fetchCategories();

// format the categories for display
$categories = formatCategories($categories, $catId);
?>

    <div class="col-xs-12 col-sm-12 col-md-4 col-lg-3">
        <div class="ks-block-content ks-block-shadow ks-filter__block">
            <div class="ks-block-header">Категории</div>
            <ul style="margin-bottom: 0px; margin-top: 15px">
                <?php
                $isFirst = true;
                $categoryOpened = false;
                foreach ($categories as $category) {
                    extract($category);
                    // now we have $cat_id, $cat_parent_id, $cat_name

                    $level = ($cat_parent_id == 0) ? 1 : 2;
                    $url   = "/shop/category-" . $cat_id;


                    // assign id="current" for the currently selected category
                    // this will highlight the category name
                    $listId = '';
                    if ($cat_id == $catId) {
                        $listId = ' id="current"';
                    }

                    // for second level categories we print extra spaces to give
                    // indentation look
                    if ($level == 1) {
                        echo $isFirst ? '' : $categoryOpened ? '</ul></li>' : '</li>';
                        $categoryOpened = false;
                    ?>
                    <li<?php echo $listId; ?>><a href="<?php echo $url; ?>"><?php echo $cat_name; ?></a>
                    <?php } else {
                        if ($categoryOpened == false) { $categoryOpened = true; ?><ul><?php }?>
                        <li<?php echo $listId; ?>><a href="<?php echo $url; ?>"><?php echo $cat_name; ?></a></li>
                    <?php }



                    $isFirst = false;
                }

                echo $categoryOpened ? '</ul></li>' : '</li>';
                ?>
            </ul>
        </div>
<!-- Здесь временно выключен блок валют
        <div class="ks-block-content ks-block-shadow ks-filter__block">
            <span><br>Курс: 1$ = <?php echo $shopConfig['exch'];?>грн.<br> Обновлен: <?php echo date("d.m.Y");?><br></span>
            <span><br>Отображать цены в<br></span>
            <?php if (empty($_SESSION['cur']))$_SESSION['cur'] = 'USD';?>
            <div class="btn-group" data-toggle="buttons">
              <label class="btn btn-primary <?php if ($_SESSION['cur'] == 'USD') echo "active";?>">
                <input type="radio" name="options" id="USD"> USD
              </label>
              <label class="btn btn-primary <?php if ($_SESSION['cur'] == 'GRN') echo "active";?>">
                <input type="radio" name="options" id="GRN"> ГРН
              </label>
            </div>
        </div>
Здесь временно выключен блок валют -->
       <div class="ks-block-content ks-block-shadow ks-filter__block">
            <div class="ks-block-header">Фильтры</div>
            <h4>Цена&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <?php if (empty($_SESSION['cur']))$_SESSION['cur'] = 'USD';?>
                <div class="btn-group" data-toggle="buttons">
                    <label class="btn btn-primary <?php if ($_SESSION['cur'] == 'USD') echo "active";?>">
                        <input type="radio" name="options" id="USD"> USD
                    </label>
                    <label class="btn btn-primary <?php if ($_SESSION['cur'] == 'GRN') echo "active";?>">
                        <input type="radio" name="options" id="GRN"> ГРН
                    </label>
                </div>
            </h4>
            <div>
                <input type="number" class="form-control ks-filter__price-input" id="min_price" value="0" min="0">
                <span>&nbsp;—&nbsp;</span>
                <input type="number" class="form-control ks-filter__price-input" id="max_price" value="400" min="10">
                <span>$</span>
                <span id="poss"></span>
            </div>
            <br>
    <!-- Здесь начинается процедура формирования списка фильтров категории -->
           <?php

           $sql = "SELECT cat_parent_id FROM tbl_category WHERE cat_id = $catId";
           $res = mysql_query($sql);
           if (dbNumRows($res) > 0){ extract(dbFetchAssoc($res)); }

           if ($cat_parent_id > 0){
               echo "<table>";
                   $sql =  "SELECT flt_name
                            FROM tbl_category_link lnk, tbl_filters fl
                            WHERE lnk.cat_id = $catId AND fl.flt_id = lnk.flt_id";
                   $result = mysql_query($sql);

                   if (dbNumRows($result) > 0) {
                       while($row = dbFetchAssoc($result)) {
                           extract($row);
                           $sql =  "SELECT val_value, vl.val_id
                                    FROM tbl_filter_link lnk, tbl_filter_value vl, tbl_filters fl
                                    WHERE lnk.val_id = vl.val_id AND fl.flt_id = lnk.flt_id AND fl.flt_name = '$flt_name'";
                           $res1 = mysql_query($sql);
                           echo "<tr><td><h4 style='margin:0px'>".$flt_name."</h4>";
                           echo "<ul class='flt' style='padding-left: 10px'>";
                           while($row1 = dbFetchAssoc($res1)) {
                               extract($row1);
                               $sql =  "SELECT ln.pd_id
                                    FROM tbl_product_link ln, tbl_product pd
                                    WHERE val_id = '$val_id' AND cat_id = $catId AND pd.pd_id = ln.pd_id";
                               $res2 = mysql_query($sql);
                               if (dbNumRows($res2) > 0) {
                                    echo "<li style='padding-left: 15px; display: inline-block'>
                                            <input type='checkbox' name='filter' value='".$val_id."' />
                                            &nbsp;".$val_value." (".dbNumRows($res2).")</li>";
                               } else {

                               }
                           }
                           echo "</ul>";
                           echo "</td></tr>";
                       }
                   }
               echo "</table>";
           }
           ?>
    <!-- Здесь заканчивается процедура формирования списка фильтров категории -->
        </div>
    </div>

        <script>
            $(document).ready(function(){
                $(".flt").each(function(){
                    if ($(this).html() == '') {
                        $(this).parent().parent().html('');
                    };
                });
            });
            $(function(){
                $('#USD').change(function(){
                    var cur = "USD";
                    var xmlhttp = getXmlHttp();
                    xmlhttp.open('POST', '/include/currency.php', true);
                    xmlhttp.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                    xmlhttp.send("cur=" + encodeURIComponent(cur));
                    tagList = document.getElementsByName('price-usd'); 
                    for (var i = 0; i < tagList.length; i++) tagList.item(i).style.display = 'block';
                    tagList = document.getElementsByName('price-grn'); 
                    for (var i = 0; i < tagList.length; i++) tagList.item(i).style.display = 'none';
                });
            });
            $(function(){
                $('#GRN').change(function(){
                    var cur = "GRN";
                    var xmlhttp = getXmlHttp();
                    xmlhttp.open('POST', '/include/currency.php', true);
                    xmlhttp.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                    xmlhttp.send("cur=" + encodeURIComponent(cur));
                    tagList = document.getElementsByName('price-usd'); 
                    for (var i = 0; i < tagList.length; i++) tagList.item(i).style.display = 'none';
                    tagList = document.getElementsByName('price-grn'); 
                    for (var i = 0; i < tagList.length; i++) tagList.item(i).style.display = 'block';
                });
            });
            $(function(){
                var inputmin = document.getElementById('min_price');
                var inputmax = document.getElementById('max_price');
                var tagList1 = document.getElementsByName('price');
                var tagList2 = document.getElementsByName('pos');
                inputmin.oninput = function(){
                    for (var i = 0; i < tagList1.length; i++) 
                        if (tagList1.item(i).value - inputmin.value < 0 || tagList1.item(i).value - inputmax.value > 0) {tagList2.item(i).style.display = 'none';} else {tagList2.item(i).style.display = '';};
                };
                inputmax.oninput = function(){
                    for (var i = 0; i < tagList1.length; i++) 
                        if (tagList1.item(i).value - inputmin.value < 0 || tagList1.item(i).value - inputmax.value > 0) {tagList2.item(i).style.display = 'none';} else {tagList2.item(i).style.display = '';};
                };
            });
        </script>

    <div style="overflow: hidden">
