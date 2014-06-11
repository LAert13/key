<?php
if (!defined('WEB_ROOT')) {
	exit;
}

// get all categories
$categories = fetchCategories();
// format the categories for display
$categories = formatCategories($categories, $catId);

if (isset($_GET['f'])) {
    $filter = ' (';
    $value = ' (';
    $product = ' (';
    $links = explode("|", $_GET['f']);
    $txt = ' ';
    foreach ($links as $lnk) {
        list($val,$flt)=explode("*",$lnk);
        if (mb_substr_count($filter, $flt) == 0) {
            $filter .= $flt.',';
            $txt = substr($txt,0,-1).") | flt_id = ".$flt." AND val_id IN (";
        }
        $value .= $val.',';
        $txt .= $val.",";
    }
    $filter = substr($filter,0,-1).')';
    $value = substr($value,0,-1).')';
    $txt = substr($txt,4,-1).')';
    $links = explode("|", $txt);
    $txt = "SELECT pd_id FROM tbl_product_link WHERE ";
    $sql = $txt;
    foreach ($links as $lnk) {
        $sql .= $lnk." AND pd_id IN (".$txt;
    }
    $pos = strripos($sql,$txt)-15;
    $sql = substr($sql,0,$pos);
    function addClosing($sql){
        if (substr_count($sql, '(') > substr_count($sql, ')')){
            $sql .= ')';
            $sql = addClosing($sql);
        }
        return $sql;
    }
    $sql = addClosing($sql);
    $res = mysql_query($sql);
    while ($row = mysql_fetch_assoc($res)) { if (mb_substr_count($product, $row['pd_id']) == 0) $product .= $row['pd_id'].','; }
    $product = substr($product,0,-1).')';
}

if ($catId >0) {
?>
<style>
    .filters,
    .selectedFilters,
    .selectedFilters > li > ul {
        list-style-type:none;
        margin-left: 0;
        padding-left: 0px;
    }
    .selectedFilters > li {
        padding-top: 5px;
        padding-bottom: 5px;
    }
    .selectedFilters > li > ul {
        padding-left: 20px;
    }
    .selectedFilters > li > ul > li {
        padding-top: 3px;
    }
    .filters > li {
        padding-top: 5px;
    }
    .filters > li > h4 {
        padding-bottom: 5px;
        margin: 0px;
    }
    .filters > li > ul > li > label {
        font-weight: normal;
    }
    .fltValue {
        padding-left: 10px
    }
</style>

    <div class="col-xs-12 col-sm-12 col-md-4 col-lg-3">
        <!--     <div class="ks-block-content ks-block-shadow ks-filter__block">
            <div class="ks-block-header">Категории</div>
            <ul style="margin-bottom: 0px; margin-top: 15px">
                <?php //getCategoriesList($categories,$catId,0); ?>
            </ul>
        </div>-->

       <div class="ks-block-content ks-block-shadow ks-filter__block">
            <div class="ks-block-header">Фильтры</div>
            <h4>Цена</h4>
            <?php
            $r = mysql_fetch_assoc(mysql_query("SELECT MIN( pd_price ) FROM tbl_product"));
            $min = (int)$r['MIN( pd_price )']*$shopConfig['exch'];
            $r = mysql_fetch_assoc(mysql_query("SELECT MAX( pd_price ) FROM tbl_product"));
            $max = (int)$r['MAX( pd_price )']*$shopConfig['exch'];
            ?>
            <div>
                <input type="number" class="form-control ks-filter__price-input" id="min_price" value="<?php echo $min;?>" min="0">
                <span>&nbsp;—&nbsp;</span>
                <input type="number" class="form-control ks-filter__price-input" id="max_price" value="<?php echo $max;?>" min="10">
                <span>грн</span>
                <span id="poss"></span>
            </div>
            <br>
    <!-- Здесь начинается процедура формирования списка фильтров категории -->
           <?php
           $sql = "SELECT cat_parent_id FROM tbl_category WHERE cat_id = $catId";
           $res = mysql_query($sql);
           if (dbNumRows($res) > 0){ extract(dbFetchAssoc($res)); } else {$cat_parent_id = 0 ;}

           if ($cat_parent_id > 0){
               if (isset($_GET['f'])){
                   echo "<ul class='selectedFilters'>";
                   echo "<h4>Выбранные фильтры</h4>";
                   $sql =  "SELECT flt_name, fl.flt_id
                            FROM tbl_category_link lnk, tbl_filters fl
                            WHERE lnk.cat_id = $catId AND fl.flt_id = lnk.flt_id AND fl.flt_id IN $filter";
                   $result = mysql_query($sql);
                   while($row = dbFetchAssoc($result)) {
                       extract($row);
                       echo "<li><b>".$flt_name."</b><ul>";
                       $sql =  "SELECT val_value, vl.val_id
                                FROM tbl_filter_link lnk, tbl_filter_value vl, tbl_filters fl
                                WHERE lnk.val_id = vl.val_id AND fl.flt_id = lnk.flt_id AND fl.flt_name = '$flt_name' AND vl.val_id IN $value";
                       $res1 = mysql_query($sql);
                       while($row1 = dbFetchAssoc($res1)) {
                           extract($row1);
                           $href = $_SERVER['REQUEST_URI'];
                           $val_txt = $val_id.'*'.$flt_id;
                           $pos = strripos($href,$val_txt);
                           $href = str_replace($val_txt,"",$href);
                           if (substr($href,$pos,1)=="|") {
                               $a = substr($href,0,$pos);
                               $b = substr($href,-(strlen($href)-$pos-1));
                           }
                           elseif (substr($href,-1)=="=") {
                               $a = substr($href,0,-3);
                               $b = '';
                           }
                           else {
                               $a = substr($href,0,-1);
                               $b = '';
                           }
                           echo "<li>".$val_value."  <a href='".$a.$b."'>Удалить</a></li>";
                       }
                       echo "</ul></li>";
                   }
                   echo "</ul>";
                   echo '<div style="text-align: right"><input type="button" id="fltClear" value="Сбросить фильтры"/></div><br>';
               }
               if (isset($product)&&($product == " )")) { echo '<h3 style="color: red; text-align: center">Неправильное сочетание фильтров</h3>'; }
               else {
                   echo "<ul class='filters'>";
                   $sql =  "SELECT flt_name, fl.flt_id
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
                           echo "<li><h4><span class='fltName' name='".$flt_id."'>▸ ".$flt_name."</span></h4>";
                           echo "<ul class='fltValue'>";
                           while($row1 = dbFetchAssoc($res1)) {
                               extract($row1);
                               $text = '';
                               if (isset($product)&&mb_substr_count($filter, $flt_id)==0) $text = " AND pd.pd_id IN $product";
                               $sql =  "SELECT pd.pd_id
                                    FROM tbl_product_link ln, tbl_product pd
                                    WHERE val_id = '$val_id' AND cat_id = $catId AND pd.pd_id = ln.pd_id".$text;
                               $res2 = mysql_query($sql);
                               if (dbNumRows($res2) > 0) {
                                   $slct = '';
                                   $stl = 'inline-block';
                                   if (isset($filter))if (mb_substr_count($filter, $flt_id)>0&&mb_substr_count($value, $val_id)>0){ $slct = ' checked'; $stl = 'none';}
                                   echo "<li style='padding-left: 15px; display: ".$stl."'>
                                        <label><input type='checkbox' class='check'".$slct." value='".$val_id."' />
                                        &nbsp;".$val_value." <b>(".dbNumRows($res2).")</b></label></li>";
                               }
                           }
                           echo "</ul>";
                           echo "</li>";
                       }
                   }
                   echo "</ul>";
               }
           }
           ?>
    <!-- Здесь заканчивается процедура формирования списка фильтров категории -->
        </div>
    </div>
<?php } ?>

        <script>
            $(document).ready(function(){
                $(".fltValue").each(function(){
                    $(this).hide();
                    if ($(this).html() == '') {
                        $(this).parent().html('');
                    };
                });
                $(".fltValue:lt(2)").show();
                $(".fltName:lt(2)").each(function() {
                    $(this).html('▾'+$(this).html().substr(1));
                });
            });

            $(".check").on( "click", function() {
                    var text = '';
                    var loc = location.pathname;
                    var catId = loc.substr(loc.indexOf('-')-loc.length+1, loc.length-loc.indexOf('-')-1);
                    $(".check").each(function(){
                        $(this).attr("disabled", true);
                        if ($(this).is(":checked")){
                            text = text + $(this).val() + "*";
                            text = text + $(this).parent().parent().parent().parent().find(':first-child').find(':first-child').attr("name") + "|";
                        }
                    });
                    text = text.slice(0,-1);
                    if (text=='') document.location.replace("/shop/category-"+catId);
                    else  document.location.replace("/shop/category-"+catId+"?f="+text);
            });

            $("#fltClear").click(function(){
                var loc = location.pathname;
                var catId = loc.substr(loc.indexOf('-')-loc.length+1, loc.length-loc.indexOf('-')-1);
                document.location.replace("/shop/category-"+catId);
            });

            $(".fltName").click(function(){
                if ($(this).parent().next().css('display') == "none"){
                    $(this).html('▾'+$(this).html().substr(1));
                }
                else {
                    $(this).html('▸'+$(this).html().substr(1));
                }
                $(this).parent().next().slideToggle(100);
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
