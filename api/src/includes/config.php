<?php
error_reporting(E_ALL ^ E_NOTICE);
ini_set('display_errors', '1');


define('DB_HOST', getenv('DATABASE_URL')); // Check docker-compose.yml, use the link!
define('DB_DATABASE', 'autos');
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
