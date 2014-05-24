<?php
require_once '../library/config.php';
require_once '../library/functions.php';

checkUser();

$action = isset($_GET['action']) ? $_GET['action'] : '';
switch ($action) {
	
    case 'add' :
        addFilter();
        break;

    case 'addValue' :
        addValue();
        break;
      
    case 'modify' :
        modifyFilter();
        break;
        
    case 'delete' :
        deleteFilter();
        break;
    
    default :
        // if action is not defined or unknown
        // move to main page
        header('Location: index.php');
}


/*
    Add a Filter
*/
function addFilter()
{
    $name        = $_POST['txtName'];

    $sql   = "INSERT INTO tbl_filters (flt_name)
              VALUES ('$name')";
    $result = dbQuery($sql) or die('Не могу добавить фильтр' . mysql_error());
    
    header('Location: index.php');
}

/*
    Add a Filter value
*/
function addValue()
{
    $name        = $_POST['fltName'];
    $value        = $_POST['txtValue'];

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

    header('Location: index.php');
}

/*
    Modify a Filter
*/
function modifyFilter()
{
    $fltId       = (int)$_GET['fltId'];
    $name        = $_POST['txtName'];

    $sql    = "UPDATE tbl_filters
               SET flt_name = '$name'
               WHERE flt_id = $fltId";
           
    $result = dbQuery($sql) or die('Не могу обновить фильтр. ' . mysql_error());
    header('Location: index.php');              
}

/*
    Remove a Filter
*/
function deleteFilter()
{
    $fltId = (int)$_GET['fltId'];

	$sql = "DELETE FROM tbl_filters
			WHERE flt_id = $fltId";
	dbQuery($sql);

    header('Location: index.php');
}

?>