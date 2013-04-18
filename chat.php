<?php
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

$smarty->display('chat.tpl');

echo PHP_EOL;
$smarty->display('footer.tpl');
?>