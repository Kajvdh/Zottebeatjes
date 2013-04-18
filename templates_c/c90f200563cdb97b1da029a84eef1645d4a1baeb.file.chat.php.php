<?php /* Smarty version Smarty-3.1.13, created on 2013-04-18 17:26:44
         compiled from "chat.php" */ ?>
<?php /*%%SmartyHeaderCode:137445170105dc0d648-56607697%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'c90f200563cdb97b1da029a84eef1645d4a1baeb' => 
    array (
      0 => 'chat.php',
      1 => 1366298796,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '137445170105dc0d648-56607697',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_5170105dc41b74_69746327',
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5170105dc41b74_69746327')) {function content_5170105dc41b74_69746327($_smarty_tpl) {?><<?php ?>?php
session_start();
include 'includes.php';
$database = new Database();
$db = $database->getConnection();

$login = new Login();
if ($login->getSession()) {
    $member = new Member($db);
    $member->getById($login->getSession());
    $smarty->assign('login',$member->getUsername());
}


$smarty->display('header.tpl');
echo PHP_EOL;

$smarty->display('chat.php');

echo PHP_EOL;
$smarty->display('footer.tpl');
?<?php ?>><?php }} ?>