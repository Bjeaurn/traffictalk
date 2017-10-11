<?php
declare(strict_types = 1);
error_reporting(E_ALL ^ E_NOTICE);
ini_set('display_errors', '1');

// error handler function
function myErrorHandler($errno, $errstr, $errfile, $errline)
{
    if (!(error_reporting() & $errno)) {
        // This error code is not included in error_reporting, so let it fall
        // through to the standard PHP error handler
        return false;
    }

echo "<pre>";
    switch ($errno) {
    case E_USER_ERROR:
        echo "<b>My ERROR</b> [$errno] $errstr<br />\n";
        echo "  Fatal error on line $errline in file $errfile";
        echo ", PHP " . PHP_VERSION . " (" . PHP_OS . ")<br />\n";
        echo "Aborting...<br />\n";
        
        break;

    case E_USER_WARNING:
        echo "<b>My WARNING</b> [$errno] $errstr<br />\n";
        break;

    case E_USER_NOTICE:
    case E_NOTICE:
        echo "<b>My NOTICE</b> [$errno] $errstr<br />\n";
        break;

    default:
        echo "Unknown error type: [$errno] $errstr<br />\n";
        break;
    }
echo "</pre>";
exit(1);
    /* Don't execute PHP internal error handler */
    return true;
}
set_error_handler(myErrorHandler);


$database_url = getenv("DATABASE_URL"); // Doesn't work... stupid docker env. 

define('DB_HOST', 'database'); // Check docker-compose.yml, use the link!
define('DB_DATABASE', 'postgres');
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
