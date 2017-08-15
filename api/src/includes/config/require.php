<?php
// Load all required files
header("Access-Control-Allow-Origin: *");

// Loading base files
include_once(__BASEPATH__."includes/base/database.class.php");
// include_once(__BASEPATH__."includes/base/databasepdo.class.php");
include_once(__BASEPATH__."includes/base/cookies.class.php");
// include_once(__BASEPATH__."includes/base/session.class.php");
include_once(__BASEPATH__."includes/base/mail.class.php");
include_once(__BASEPATH__."includes/base/api.class.php");
include_once(__BASEPATH__."includes/base/security.class.php");
  include_once(__BASEPATH__."includes/base/class.phpmailer.php");
  include_once(__BASEPATH__."includes/base/class.smtp.php");

include(__BASEPATH__."includes/base/model.php");
include_once(__BASEPATH__."includes/base/helpers.php");

include_once(__BASEPATH__."includes/base/language.class.php");
include_once(__BASEPATH__."includes/base/page.class.php");
include_once(__BASEPATH__."includes/base/autoloader.class.php");
// include_once(__BASEPATH__."includes/base/router.class.php");
?>
