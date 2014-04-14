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
                <li><a href="<?php echo $_SERVER['PHP_SELF']; ?>">Все товары</a></li>

                <?php foreach ($categories as $category) {
                    extract($category);
                    // now we have $cat_id, $cat_parent_id, $cat_name

                    $level = ($cat_parent_id == 0) ? 1 : 2;
                    $url   = $_SERVER['PHP_SELF'] . "?c=$cat_id";

                    // for second level categories we print extra spaces to give
                    // indentation look
                    if ($level == 2) {
                        $cat_name = '&nbsp; &nbsp; &raquo;&nbsp;' . $cat_name;
                    }

                    // assign id="current" for the currently selected category
                    // this will highlight the category name
                    $listId = '';
                    if ($cat_id == $catId) {
                        $listId = ' id="current"';
                    }
                ?>
                <li<?php echo $listId; ?>><a href="<?php echo $url; ?>"><?php echo $cat_name; ?></a></li>
                <?php } ?>
            </ul>
        </div>

        <div class="ks-block-content ks-block-shadow ks-filter__block">
            <h3>Цена</h3>
            <div>
                <input class="form-control ks-filter__price-input" type="number" placeholder="0" min="0">
                <span>&nbsp;—&nbsp;</span>
                <input type="number" class="form-control ks-filter__price-input" placeholder="100500" min="1">
                <span>$</span>
            </div>
        </div>
    </div>
    <div style="overflow: hidden">
