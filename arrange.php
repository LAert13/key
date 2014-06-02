<?php
session_start();
switch ($_POST['arrange']){
    case 1:
        $_SESSION['arrange'] = 1;
        $_SESSION['sort_by'] = ' ORDER BY pd_name';
        break;
    case 2:
        $_SESSION['arrange'] = 2;
        $_SESSION['sort_by'] = ' ORDER BY pd_price ASC';
        break;
    case 3:
        $_SESSION['arrange'] = 3;
        $_SESSION['sort_by'] = ' ORDER BY pd_price DESC';
}
?>