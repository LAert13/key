<?php
	require_once('library/config.php');
	include('library/functions.php');
	
	$text = '';
	$query = $_POST['search'];
  	$query = trim($query); 
    $query = mysql_real_escape_string($query);
    $query = htmlspecialchars($query);


    if (!empty($query)) 
    { 
        if (strlen($query) < 3) {
            $text = '';
        } else if (strlen($query) > 128) {
            $text = '<li>Слишком длинный поисковый запрос.</li>';
        } else { 
        	$query = explode(" ", $query);
			$q = "SELECT `pd_id`, `pd_name`, `pd_description`, `pd_thumbnail`, `pd_price`
	                  FROM `tbl_product` 
	                  WHERE ";
        	foreach ($query as $key => $value) {
        		$q .= "(`pd_id` LIKE '%".$value."%' OR `pd_name` LIKE '%".$value."%' OR `pd_description` LIKE '%".$value."%') AND ";
        	}
        	$q = substr($q, 0, -4);
	        $q .= "ORDER BY `pd_id`";
	        $result = mysql_query($q);
			if (mysql_affected_rows() > 0) { 
	            $row = mysql_fetch_assoc($result); 
	            $num = mysql_num_rows($result);
	            do {
					if ($_SESSION["cur"] == "USD") 
						{$row['pd_price'] = displayAmount($row['pd_price']);} 
					elseif ($_SESSION["cur"] == "GRN") 
						{$row['pd_price'] = sprintf("%.02f",$row['pd_price']*$shopConfig["exch"])."грн";} 
	                $text .= '<li>
	                			  <a href="/shop/product-'.$row['pd_id'].'" title="'.$row['pd_name'].'">
	                			  <img src="/images/product/'.$row['pd_thumbnail'].'" style="padding-right:20px"/>
	                			  <span>'.$row['pd_name'].'</span>&nbsp;<span style="padding-left:20px;">Цена&nbsp;'.$row['pd_price'].'</span></a>
	                		  </li>';
	            } while ($row = mysql_fetch_assoc($result)); 
		    } else {
	            $text = '<li>По вашему запросу ничего не найдено.</li>';
	        }
        } 
    } else {
        $text = '';
    }
    echo "$text";
?>