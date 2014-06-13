<?php
require_once '../library/config.php';
require_once '../library/functions.php';

checkUser();

$action = isset($_GET['action']) ? $_GET['action'] : '';
switch ($action) {
	
    case 'add' :
        addCategory();
        break;
      
    case 'modify' :
        modifyCategory();
        break;

    case 'modifyFilters' :
        modifyFilters();
        break;

    case 'filterSelect' :
        filterSelect();
        break;
        
    case 'delete' :
        deleteCategory();
        break;
    
    case 'deleteImage' :
        deleteImage();
        break;

    case 'writeLink' :
        writeLink();
        break;

    case 'deleteCategoryFilter' :
        deleteCategoryFilter();
        break;

    case 'upCategoryFilter' :
        upCategoryFilter();
        break;

    case 'downCategoryFilter' :
        downCategoryFilter();
        break;

    default :
        // if action is not defined or unknown
        // move to main category page
        header('Location: index.php');
}


/*
    Add a category
*/
function addCategory()
{
    $name        = $_POST['txtName'];
    $description = $_POST['mtxDescription'];
    $image       = $_FILES['fleImage'];
    $parentId    = $_POST['hidParentId'];
    
    $catImage = uploadImage('fleImage', '../../images/category/');
    
    $sql   = "INSERT INTO tbl_category (cat_parent_id, cat_name, cat_description, cat_image) 
              VALUES ($parentId, '$name', '$description', '$catImage')";
    $result = dbQuery($sql) or die('Cannot add category' . mysql_error());
    
    header('Location: index.php?catId=' . $parentId);              
}

/*
    Upload an image and return the uploaded image name 
*/
function uploadImage($inputName, $uploadDir)
{
    $image     = $_FILES[$inputName];
    $imagePath = '';
    
    // if a file is given
    if (trim($image['tmp_name']) != '') {
        // get the image extension
        $ext = substr(strrchr($image['name'], "."), 1); 

        // generate a random new file name to avoid name conflict
        $imagePath = md5(rand() * time()) . ".$ext";
        
		// check the image width. if it exceed the maximum
		// width we must resize it
		$size = getimagesize($image['tmp_name']);
		
		if ($size[0] > MAX_CATEGORY_IMAGE_WIDTH) {
			$imagePath = createThumbnail($image['tmp_name'], $uploadDir . $imagePath, MAX_CATEGORY_IMAGE_WIDTH);
		} else {
			// move the image to category image directory
			// if fail set $imagePath to empty string
			if (!move_uploaded_file($image['tmp_name'], $uploadDir . $imagePath)) {
				$imagePath = '';
			}
		}	
    }

    
    return $imagePath;
}

/*
    Modify a category
*/
function modifyCategory()
{
    $catId       = (int)$_GET['catId'];
    $name        = $_POST['txtName'];
    $description = $_POST['mtxDescription'];
    $image       = $_FILES['fleImage'];
    
    $catImage = uploadImage('fleImage', '../../images/category/');
    
    // if uploading a new image
    // remove old image
    if ($catImage != '') {
        _deleteImage($catId);
		$catImage = "'$catImage'";
    } else {
		// leave the category image as it was
		$catImage = 'cat_image';
	}
     
    $sql    = "UPDATE tbl_category 
               SET cat_name = '$name', cat_description = '$description', cat_image = $catImage
               WHERE cat_id = $catId";
           
    $result = dbQuery($sql) or die('Не могу обновить категорию. ' . mysql_error());
    header('Location: index.php');              
}

/*
    Remove a category
*/
function deleteCategory()
{
    if (isset($_GET['catId']) && (int)$_GET['catId'] > 0) {
        $catId = (int)$_GET['catId'];
    } else {
        header('Location: index.php');
    }
    
	// find all the children categories
	$children = getChildren($catId);
	
	// make an array containing this category and all it's children
	$categories  = array_merge($children, array($catId));
	$numCategory = count($categories);

	// remove all product image & thumbnail 
	// if the product's category is in  $categories
	$sql = "SELECT pd_id, pd_image, pd_thumbnail
	        FROM tbl_product
			WHERE cat_id IN (" . implode(',', $categories) . ")";
	$result = dbQuery($sql);
	
	while ($row = dbFetchAssoc($result)) {
		@unlink(SRV_ROOT . PRODUCT_IMAGE_DIR . $row['pd_image']);	
		@unlink(SRV_ROOT . PRODUCT_IMAGE_DIR . $row['pd_thumbnail']);
	}
	
	// delete the products
	$sql = "DELETE FROM tbl_product
			WHERE cat_id IN (" . implode(',', $categories) . ")";
	dbQuery($sql);
	
	// then remove the categories image
	_deleteImage($categories);

    // finally remove the category from database;
    $sql = "DELETE FROM tbl_category 
            WHERE cat_id IN (" . implode(',', $categories) . ")";
    dbQuery($sql);
    
    header('Location: index.php');
}


/*
	Recursively find all children of $catId
*/
function getChildren($catId)
{
    $sql = "SELECT cat_id ".
           "FROM tbl_category ".
           "WHERE cat_parent_id = $catId ";
    $result = dbQuery($sql);
    
	$cat = array();
	if (dbNumRows($result) > 0) {
		while ($row = dbFetchRow($result)) {
			$cat[] = $row[0];
			
			// call this function again to find the children
			$cat  = array_merge($cat, getChildren($row[0]));
		}
    }

    return $cat;
}


/*
    Remove a category image
*/
function deleteImage()
{
    if (isset($_GET['catId']) && (int)$_GET['catId'] > 0) {
        $catId = (int)$_GET['catId'];
    } else {
        header('Location: index.php');
    }
    
	_deleteImage($catId);
	
	// update the image name in the database
	$sql = "UPDATE tbl_category
			SET cat_image = ''
			WHERE cat_id = $catId";
	dbQuery($sql);        

    header("Location: index.php?view=modify&catId=$catId");
}

/*
	Delete a category image where category = $catId
*/
function _deleteImage($catId)
{
    // we will return the status
    // whether the image deleted successfully
    $deleted = false;

	// get the image(s)
    $sql = "SELECT cat_image 
            FROM tbl_category
            WHERE cat_id ";
	
	if (is_array($catId)) {
		$sql .= " IN (" . implode(',', $catId) . ")";
	} else {
		$sql .= " = $catId";
	}	

    $result = dbQuery($sql);
    
    if (dbNumRows($result)) {
        while ($row = dbFetchAssoc($result)) {
	        // delete the image file
    	    $deleted = @unlink(SRV_ROOT . CATEGORY_IMAGE_DIR . $row['cat_image']);
		}	
    }
    
    return $deleted;
}

function filterSelect()
{
    $num=$_POST['num'];
    $sql = "SELECT flt_name FROM tbl_filters ORDER BY flt_name ASC";
    $res = mysql_query($sql);
    $text = '<select name="filter_'.$num.'" id="filter_'.$num.'">';
    $text .= "<option selected>...</option>";
    while ($row = mysql_fetch_assoc($res)){
        $text .= "<option value=\"".$row['flt_name']."\">".$row['flt_name']."</option>";
    }
    $text .= "</select>";
    echo($text);
}

function writeLink()
{
    if (isset($_GET['catId']) && (int)$_GET['catId'] > 0) {
        $catId = (int)$_GET['catId'];
    } else {
        header('Location: index.php');
    }
    $n = count($_POST);
    for ($i = 1; $i <= $n; $i++){
        $fltName = $_POST['filter_'.$i];
        $sql = "SELECT flt_id FROM tbl_filters WHERE flt_name = '$fltName'";
        $res = mysql_query($sql);
        $row = mysql_fetch_assoc($res);
        $fltId = $row['flt_id'];
        $sql   = "INSERT INTO tbl_category_link (cat_id,flt_id)
              VALUES ('$catId','$fltId')";
        $result = dbQuery($sql) or die('Не могу добавить связь' . mysql_error());
    }
    header("Location: index.php?view=modifyFilters&catId=".$catId);
}

/*
	Remove a category filter
*/
function deleteCategoryFilter()
{
    if (isset($_GET['catId']) && (int)$_GET['catId'] > 0) {
        $catId = (int)$_GET['catId'];
    } else {
        header('Location: index.php');
    }

    if (isset($_GET['filterId']) && (int)$_GET['filterId'] > 0) {
        $filterId = (int)$_GET['filterId'];
    } else {
        header('Location: index.php');
    }

    // remove the product filter from database;
    $sql = "DELETE FROM tbl_category_link
	        WHERE cat_id = $catId AND flt_id = $filterId";
    dbQuery($sql);

    header('Location: index.php?view=modifyFilters&catId='.$catId);
}

/*
	Moves UP category filter
*/
function upCategoryFilter()
{
    if (isset($_GET['catId']) && (int)$_GET['catId'] > 0) {
        $catId = (int)$_GET['catId'];
    } else {
        header('Location: index.php');
    }

    if (isset($_GET['filterId']) && (int)$_GET['filterId'] > 0) {
        $fltId = (int)$_GET['filterId'];
    } else {
        header('Location: index.php');
    }
    $sql = "SELECT lnk_id FROM `tbl_category_link` WHERE cat_id = $catId AND flt_id = $fltId";
    $row = mysql_fetch_assoc(mysql_query($sql));
    $lnkId = $row['lnk_id'];

    $sql = "SELECT flt_id, lnk_id FROM `tbl_category_link`
            WHERE cat_id = $catId LIMIT 1";
    $row = mysql_fetch_assoc(mysql_query($sql));
    $lnkUp = $row['lnk_id'];
    $fltUp = $row['flt_id'];

    $sql = "SELECT flt_id, lnk_id FROM tbl_category_link
	        WHERE cat_id = $catId";
    $res = mysql_query($sql);
    while ($row = mysql_fetch_assoc($res)){
        extract($row);
        if ($flt_id == $fltId) {
            $sql = "UPDATE tbl_category_link
			   SET flt_id = '$fltId'
			 WHERE cat_id = '$catId' AND lnk_id = '$lnkUp'";
            dbQuery($sql);
            $sql = "UPDATE tbl_category_link
			   SET flt_id = '$fltUp'
			 WHERE cat_id = '$catId' AND lnk_id = '$lnkId'";
            dbQuery($sql);
            break;
        }
        else {
            $lnkUp = $lnk_id;
            $fltUp = $flt_id;
        }
    }
    header('Location: index.php?view=modifyFilters&catId='.$catId);
}

/*
	Moves DOWN category filter
*/
function downCategoryFilter()
{
    if (isset($_GET['catId']) && (int)$_GET['catId'] > 0) {
        $catId = (int)$_GET['catId'];
    } else {
        header('Location: index.php');
    }

    if (isset($_GET['filterId']) && (int)$_GET['filterId'] > 0) {
        $fltId = (int)$_GET['filterId'];
    } else {
        header('Location: index.php');
    }
    $sql = "SELECT lnk_id FROM `tbl_category_link` WHERE cat_id = $catId AND flt_id = $fltId";
    $row = mysql_fetch_assoc(mysql_query($sql));
    $lnkId = $row['lnk_id'];

    $sql = "SELECT flt_id, lnk_id FROM `tbl_category_link`
            WHERE cat_id = $catId ORDER BY lnk_id DESC LIMIT 1";
    $row = mysql_fetch_assoc(mysql_query($sql));
    $lnkDown = $row['lnk_id'];
    $fltDown = $row['flt_id'];

    $sql = "SELECT flt_id, lnk_id FROM tbl_category_link
	        WHERE cat_id = $catId ORDER BY lnk_id DESC";
    $res = mysql_query($sql);
    while ($row = mysql_fetch_assoc($res)){
        extract($row);
        if ($flt_id == $fltId) {
            $sql = "UPDATE tbl_category_link
			   SET flt_id = '$fltId'
			 WHERE cat_id = '$catId' AND lnk_id = '$lnkDown'";
            dbQuery($sql);
            $sql = "UPDATE tbl_category_link
			   SET flt_id = '$fltDown'
			 WHERE cat_id = '$catId' AND lnk_id = '$lnkId'";
            dbQuery($sql);
            break;
        }
        else {
            $lnkDown = $lnk_id;
            $fltDown = $flt_id;
        }
    }
    header('Location: index.php?view=modifyFilters&catId='.$catId);
}
?>