<?php require_once("includes/config.php"); ?>
<?php
$requestURI = explode('/', Security::sanitizeURLFull($_SERVER['REQUEST_URI']));
$scriptName = explode('/', Security::sanitizeURLFull($_SERVER['SCRIPT_NAME']));

for($i= 0;$i < sizeof($scriptName);$i++) {
    if ($requestURI[$i] == $scriptName[$i]) {
        unset($requestURI[$i]);
    }
}
$routing = array_values($requestURI);

if($routing[0]) {
  $file = $routing[0];
}

/*$user = Authentication::Verify($token);
if(!$user) {
    API::error("Invalid authentication token", 401);
    die();
}
*/
$request = API::GetInput();
$data = new StdClass;

try {
    if(file_exists(__BASEPATH__."includes/controllers/".$file.".php")) {
        require_once(__BASEPATH__."includes/controllers/".$file.".php");
    } else {
        API::error("No valid route", 404);      
    }
} catch(Exception $e) {
    API::error("No valid route", 404);
}
die();
?>