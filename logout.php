<?php
session_start();
include 'includes.php';

$smarty->display('header.tpl');
echo PHP_EOL;

session_destroy();
echo "Je bent uitgelogd.";
header("location:index.php");

echo PHP_EOL;
$smarty->display('footer.tpl');

?>
