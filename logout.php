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
    if ($member->getPermissions()->isAdmin()) {
        $smarty->assign('isadmin',true);
    }
}


$smarty->display('header.tpl');
echo PHP_EOL;

session_destroy();
echo "Je bent uitgelogd.";
header("location:index.php");

echo PHP_EOL;
$smarty->display('footer.tpl');

?>
