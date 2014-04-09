<?PHP
require_once('library/db.php');
include('library/functions.php');

$action='';
	if (isset($_GET['action'])){
		$action = strip_tags($_GET['action']);}
	if ($action == 'logoff'){
		logoff();
	}
?>