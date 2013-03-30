<?php
require_once 'classes/Config.php';
require_once 'classes/Database.php';
require_once 'classes/Login.php';
require_once 'classes/Member.php';


$config = new Config();
if ($config->getErrorMode() == "dev") {
    error_reporting(E_ALL);
    ini_set('display_errors', '1');
}
else {
    error_reporting(0);
    ini_set('display_errors', '0');
}
?>
