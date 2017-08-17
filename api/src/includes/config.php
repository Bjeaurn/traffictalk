<?php
error_reporting(E_ALL ^ E_NOTICE);
ini_set('display_errors', '1');

$database_url = getenv("DATABASE_URL"); // Doesn't work... stupid docker env. 

define('DB_HOST', 'database'); // Check docker-compose.yml, use the link!
define('DB_DATABASE', 'traffictalk');
define('DB_USER', 'postgres');
define('DB_PASSWORD', 'postgres');
define('DB_PORT', '5432');

if(!defined(__BASEPATH__)) {
  define('__BASEPATH__', '');
}
define('PATH_404', 'includes/controllers/404.php');

date_default_timezone_set('Europe/Amsterdam');

require_once(__BASEPATH__."includes/config/require.php");
?>
