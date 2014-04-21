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
            <h3>Категории</h3>
            <ul>
                <li><a href="/shop/">Все товары</a></li>

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
        <div class="ks-block-content ks-block-shadow ks-filter__block">
            <span><br>Курс: 1$ = <?php echo $shopConfig['exch'];?>грн.<br> Обновлен: <?php echo date("d.m.Y");?><br></span>
            <span><br>Отображать цены в<br></span>
            <div class="btn-group" data-toggle="buttons">
              <label class="btn btn-primary active">
                <input type="radio" name="options" id="USD"> USD
              </label>
              <label class="btn btn-primary">
                <input type="radio" name="options" id="GRN"> ГРН
              </label>
            </div>
        </div>
<!--        <div class="ks-block-content ks-block-shadow ks-filter__block">
            <h3>Цена</h3>
            <div>
                <input type="number" class="form-control ks-filter__price-input" id="min_price" value="0" min="0">
                <span>&nbsp;—&nbsp;</span>
                <input type="number" class="form-control ks-filter__price-input" id="max_price" value="1000" min="10">
                <span>$</span>
            </div>
        </div>-->
    </div>

        <script>
            $(function(){
                $('#USD').change(function(){
                    tagList = document.getElementsByName('price-usd'); 
                    for (var i = 0; i < tagList.length; i++) tagList.item(i).style.display = 'block';
                    tagList = document.getElementsByName('price-grn'); 
                    for (var i = 0; i < tagList.length; i++) tagList.item(i).style.display = 'none';
                });
            });
            $(function(){
                $('#GRN').change(function(){
                    tagList = document.getElementsByName('price-usd'); 
                    for (var i = 0; i < tagList.length; i++) tagList.item(i).style.display = 'none';
                    tagList = document.getElementsByName('price-grn'); 
                    for (var i = 0; i < tagList.length; i++) tagList.item(i).style.display = 'block';
                });
            });
        </script>

    <div style="overflow: hidden">
