<?php
  session_start();
  extract($_POST);
  if ($cur == 'USD') $_SESSION['cur'] = 'USD';
  elseif ($cur == 'GRN') $_SESSION['cur'] = 'GRN';
  echo $_SESSION['cur'];
?>