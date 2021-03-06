<?php
ob_start();
require_once 'classes/Config.php';
require_once 'classes/Database.php';
require_once 'classes/Login.php';
require_once 'classes/Member.php';
require_once 'classes/Usergroup.php';
require_once 'classes/Database.php';

require_once 'classes/Board.php';
require_once 'classes/Category.php';
require_once 'classes/Forum.php';
require_once 'classes/Topic.php';
require_once 'classes/Post.php';
require_once 'classes/WebPoll.php';
require_once 'classes/Poll.php';
require_once 'classes/Answer.php';
require_once 'classes/Vote.php';

require 'lib/PHPMailer/class.phpmailer.php';
require 'lib/PHPMarkdownExtra1.2.7/markdown.php';
require_once 'classes/Stream.php';

require_once('smarty.php');
global $config;
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
