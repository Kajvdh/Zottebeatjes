<?php
session_start();
include 'includes.php';
require_once 'lib/recaptchalib.php';
$login = new Login();
if ($login->getSession()) {
    // ingelogd
    header("location:index.php");
}
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



if ((isset($_GET['uid'])) && (isset($_GET['key']))) {
    $member = new Member($db);
    $member->getById($_GET['uid']);
    if ($member->getUsergroup() != "1") {
        //Gebruiker is al 
        $errors = array();
        array_push($errors, "Dit account is al geactiveerd.");
        $smarty->assign('errors',$errors);
        $smarty->display('error.tpl');
    }
    elseif ($_GET['key'] == $member->getVerificationcode()) {
        //Correcte verificationcode
        $member->activate();
        $smarty->display('activation_succesfull.tpl');
    }
    else {
        $errors = array();
        array_push($errors,"Deze pagina bestaat niet.");
        $smarty->assign('errors',$errors);
        $smarty->display('error.tpl');
    }
    
}
else {
    $errors = array();
    array_push($errors,"Deze pagina bestaat niet.");
    $smarty->assign('errors',$errors);
    $smarty->display('error.tpl');
}




echo PHP_EOL;
$smarty->display('footer.tpl');

?>