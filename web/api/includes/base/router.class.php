<?php
class Router {

  private static $instance;
  private $routing;

  private function __construct() {
    $requestURI = explode('/', Security::sanitizeURLFull($_SERVER['REQUEST_URI']));
    $scriptName = explode('/', Security::sanitizeURLFull($_SERVER['SCRIPT_NAME']));

    for($i= 0;$i < sizeof($scriptName);$i++)
            {
          if ($requestURI[$i] == $scriptName[$i])
                  {
                    unset($requestURI[$i]);
                }
          }

    $command = array_values($requestURI);
    $this->routing = $command;
    $this->startRouting();
  }

  public function getRouting() {
    return $this->routing;
  }

  public function getController() {
    return $this->routing[0];
  }

  public function startRouting() {
    if(empty($this->routing[0])) {
      if(DEFAULT_PAGE) {
        $file = DEFAULT_PAGE;
      }
    } else {
      $file = $this->routing[0];
    }
    $data = new StdClass;
    $path = "includes/controllers/".$file.".php";
    try {
      if(file_exists($path)) {
        $page = Page::start();
        $autoloader = Autoloader::start();
        require_once($path);
      } else {
        throw new Exception('Controller not found');
      }
    } catch(Exception $e) {
      if(PATH_404) {
        if(file_exists(PATH_404)) {
          include(PATH_404);
        }
      }
    }
  }

  public static function Redirect($location = "") {
    if($location=="") { $location = Security::sanitizeURLFull($_SERVER['HTTP_REFERER']); } else {
      $pos = strpos($location, "http");
      if($pos===false) {
        $location = __ROUTING__.$location;
      }
    }
    header("Location: ". $location);
    die();
  }

  // The start method
  public static function start() {
     if (!isset(self::$instance)) {
         $c = __CLASS__;
         self::$instance = new $c;
     }
       return self::$instance;
  }
}
$router = Router::start();
?>
