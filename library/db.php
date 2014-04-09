<?PHP
session_start();

$localhost = '127.0.0.1'; //name of server. Usually localhost
$database = 'phpwebco_shop'; //database name.
$username = 'root'; //database username.
$password = ''; //database password.


// setting up the web root and server root for
// this shopping cart application
$thisFile = str_replace('\\', '/', __FILE__);
$docRoot = $_SERVER['DOCUMENT_ROOT'];

$webRoot  = str_replace(array($docRoot, 'library/config.php'), '', $thisFile);
$srvRoot  = str_replace('library/config.php', '', $thisFile);

define('WEB_ROOT', $webRoot);
define('SRV_ROOT', $srvRoot);

// connect to db  
$conn = mysql_connect($localhost, $username, $password) or die('Невозможно присоединиться к серверу');
$db = mysql_select_db($database,$conn) or die('невозможно присоединиться к базе данных!');

?>