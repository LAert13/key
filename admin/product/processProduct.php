<?php
require_once '../library/config.php';
require_once '../library/functions.php';

checkUser();

$action = isset($_GET['action']) ? $_GET['action'] : '';

switch ($action) {
	
	case 'addProduct' :
		addProduct();
		break;
		
	case 'modifyProduct' :
		modifyProduct();
		break;
		
	case 'deleteProduct' :
		deleteProduct();
		break;

	case 'deleteImage' :
		deleteImage();
		break;

    case 'writeLink' :
        writeLink();
        break;

    case 'addValue' :
        addValue();
        break;

	default :
	    // if action is not defined or unknown
		// move to main product page
		header('Location: index.php');
}


function addProduct()
{
    $catId       = $_POST['cboCategory'];
    $name        = $_POST['txtName'];
	$description = $_POST['mtxDescription'];
	$price       = str_replace(',', '', (double)$_POST['txtPrice']);
	$qty         = (int)$_POST['txtQty'];
	
	$images = uploadProductImage('fleImage', '../../images/product/');

	$mainImage = $images['image'];
	$thumbnail = $images['thumbnail'];
	
	$sql   = "INSERT INTO tbl_product (cat_id, pd_name, pd_description, pd_price, pd_qty, pd_image, pd_thumbnail, pd_date)
	          VALUES ('$catId', '$name', '$description', $price, $qty, '$mainImage', '$thumbnail', NOW())";

	$result = dbQuery($sql);
	
	header("Location: index.php?catId=$catId");	
}

/*
	Upload an image and return the uploaded image name 
*/
function uploadProductImage($inputName, $uploadDir)
{
	$image     = $_FILES[$inputName];
	$imagePath = '';
	$thumbnailPath = '';
	
	// if a file is given
	if (trim($image['tmp_name']) != '') {
		$ext = substr(strrchr($image['name'], "."), 1); //$extensions[$image['type']];

		// generate a random new file name to avoid name conflict
		$imagePath = md5(rand() * time()) . ".$ext";
		
		list($width, $height, $type, $attr) = getimagesize($image['tmp_name']); 

		// make sure the image width does not exceed the
		// maximum allowed width
		if (LIMIT_PRODUCT_WIDTH && $width > MAX_PRODUCT_IMAGE_WIDTH) {
			$result    = createThumbnail($image['tmp_name'], $uploadDir . $imagePath, MAX_PRODUCT_IMAGE_WIDTH);
			$imagePath = $result;
		} else {
			$result = move_uploaded_file($image['tmp_name'], $uploadDir . $imagePath);
		}	
		
		if ($result) {
			// create thumbnail
			$thumbnailPath =  md5(rand() * time()) . ".$ext";
			$result = createThumbnail($uploadDir . $imagePath, $uploadDir . $thumbnailPath, THUMBNAIL_WIDTH);
			
			// create thumbnail failed, delete the image
			if (!$result) {
				unlink($uploadDir . $imagePath);
				$imagePath = $thumbnailPath = '';
			} else {
				$thumbnailPath = $result;
			}	
		} else {
			// the product cannot be upload / resized
			$imagePath = $thumbnailPath = '';
		}
		
	}

	
	return array('image' => $imagePath, 'thumbnail' => $thumbnailPath);
}

/*
	Modify a product
*/
function modifyProduct()
{
	$productId   = (int)$_GET['productId'];	
    $catId       = $_POST['cboCategory'];
    $name        = $_POST['txtName'];
	$description = $_POST['mtxDescription'];
	$price       = str_replace(',', '', $_POST['txtPrice']);
	$qty         = $_POST['txtQty'];
	
	$images = uploadProductImage('fleImage', '../../images/product/');

	$mainImage = $images['image'];
	$thumbnail = $images['thumbnail'];

	// if uploading a new image
	// remove old image
	if ($mainImage != '') {
		_deleteImage($productId);
		
		$mainImage = "'$mainImage'";
		$thumbnail = "'$thumbnail'";
	} else {
		// if we're not updating the image
		// make sure the old path remain the same
		// in the database
		$mainImage = 'pd_image';
		$thumbnail = 'pd_thumbnail';
	}
			
	$sql   = "UPDATE tbl_product 
	          SET cat_id = $catId, pd_name = '$name', pd_description = '$description', pd_price = $price, 
			      pd_qty = $qty, pd_image = $mainImage, pd_thumbnail = $thumbnail
			  WHERE pd_id = $productId";  

	$result = dbQuery($sql);
	
	header('Location: index.php');			  
}

/*
	Remove a product
*/
function deleteProduct()
{
	if (isset($_GET['productId']) && (int)$_GET['productId'] > 0) {
		$productId = (int)$_GET['productId'];
	} else {
		header('Location: index.php');
	}
	
	// remove any references to this product from
	// tbl_order_item and tbl_cart
	$sql = "DELETE FROM tbl_order_item
	        WHERE pd_id = $productId";
	dbQuery($sql);
			
	$sql = "DELETE FROM tbl_cart
	        WHERE pd_id = $productId";	
	dbQuery($sql);
			
	// get the image name and thumbnail
	$sql = "SELECT pd_image, pd_thumbnail
	        FROM tbl_product
			WHERE pd_id = $productId";
			
	$result = dbQuery($sql);
	$row    = dbFetchAssoc($result);
	
	// remove the product image and thumbnail
	if ($row['pd_image']) {
		unlink('../../images/product/' . $row['pd_image']);
		unlink('../../images/product/' . $row['pd_thumbnail']);
	}
	
	// remove the product from database;
	$sql = "DELETE FROM tbl_product 
	        WHERE pd_id = $productId";
	dbQuery($sql);
	
	header('Location: index.php?catId=' . $_GET['catId']);
}


/*
	Remove a product image
*/
function deleteImage()
{
	if (isset($_GET['productId']) && (int)$_GET['productId'] > 0) {
		$productId = (int)$_GET['productId'];
	} else {
		header('Location: index.php');
	}
	
	$deleted = _deleteImage($productId);

	// update the image and thumbnail name in the database
	$sql = "UPDATE tbl_product
			SET pd_image = '', pd_thumbnail = ''
			WHERE pd_id = $productId";
	dbQuery($sql);		

	header("Location: index.php?view=modify&productId=$productId");
}

function _deleteImage($productId)
{
	// we will return the status
	// whether the image deleted successfully
	$deleted = false;
	
	$sql = "SELECT pd_image, pd_thumbnail 
	        FROM tbl_product
			WHERE pd_id = $productId";
	$result = dbQuery($sql) or die('Не могу удалить изображение товара. ' . mysql_error());
	
	if (dbNumRows($result)) {
		$row = dbFetchAssoc($result);
		extract($row);
		
		if ($pd_image && $pd_thumbnail) {
			// remove the image file
			$deleted = @unlink("../../images/product/$pd_image");
			$deleted = @unlink("../../images/product/$pd_thumbnail");
		}
	}
	
	return $deleted;
}

function writeLink()
{
    if (isset($_GET['pdId']) && (int)$_GET['pdId'] > 0) {
        $pdId = (int)$_GET['pdId'];
    } else {
        header('Location: index.php');
    }
    $n = count($_POST)/2;
    for ($i = 1; $i <= $n; $i++){
        $fltName = $_POST['filter_'.$i];
        $valValue = $_POST['value_'.$i];
        $sql = "SELECT flt_id,val_id FROM tbl_filters,tbl_filter_value WHERE flt_name = '$fltName' AND val_value = '$valValue'";
        $res = mysql_query($sql);
        $row = mysql_fetch_assoc($res);
        $fltId = $row['flt_id'];
        $valId = $row['val_id'];
        if (dbNumRows(mysql_query("SELECT * FROM tbl_product_link WHERE pd_id = '$pdId'")) >= $i){
            $sql = "UPDATE tbl_product_link
			        SET val_id = '$valId'
			        WHERE pd_id = '$pdId' AND flt_id = '$fltId'";
            $result = dbQuery($sql) or die('Не могу обновить связь' . mysql_error());
        }
        else {
            $sql = "INSERT INTO tbl_product_link (pd_id,flt_id,val_id)
                    VALUES ('$pdId','$fltId','$valId')";
            $result = dbQuery($sql) or die('Не могу добавить связь' . mysql_error());
        }
    }
    header("Location: index.php?view=detail&productId=$pdId");
}

/*
    Add a Filter value
*/
function addValue()
{
    $name        = $_POST['fltName'];
    $value        = $_POST['txtValue'];
    $pdId = $_GET['pdId'];

    $sql = "SELECT flt_id
        FROM tbl_filters
		WHERE flt_name = '$name'";
    $result = dbQuery($sql);
    $row = dbFetchAssoc($result);
    $fltId = $row['flt_id'];

    $sql   = "INSERT INTO tbl_filter_value (val_value)
              VALUES ('$value')";
    $result = dbQuery($sql) or die('Не могу добавить значение фильтра' . mysql_error());

    $sql = "SELECT val_id
        FROM tbl_filter_value
		WHERE val_value = '$value'";
    $result = dbQuery($sql);
    $row = dbFetchAssoc($result);
    $valId = $row['val_id'];

    $sql   = "INSERT INTO tbl_filter_link (flt_id, val_id)
              VALUES ('$fltId', '$valId')";
    $result = dbQuery($sql) or die('Не могу добавить связь фильтра' . mysql_error());

    header('Location: index.php?view=modifyFilters&productId='.$pdId);
}
?>