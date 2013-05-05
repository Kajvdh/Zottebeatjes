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


$login = new Login();
if ($login->getSession()) {
    header("location:index.php");
}
elseif (isset($_POST['loginform'])) {
    /**
     * @todo: Asynchrone verificatie via AJAX
     */
    if (!(($_POST['username']) && ($_POST['password']))) {
        $smarty->assign('error',array("Je hebt niet alle benodigde informatie ingevuld"));
        $smarty->display('error.tpl');
    }
    else {
        $username = $_POST['username'];
        $password = md5($_POST['password']);

        $member = new Member($db);
        $member->setUsername($username);
        $member->setPassword($password);

        $memberId = $member->verify();

        if ($memberId == false) {
            $smarty->assign('error',array("De opgegeven gegevens zijn onjuist."));
            $smarty->display('error.tpl');
        }
        else {
            $member->getById($memberId);
            
            if ($member->getPermissions()->canLogin()) {
                //Gebruiker mag inloggen
                $member->setLastloginNow();
                $member->setLastIp($_SERVER['REMOTE_ADDR']);
                $login->setSession($memberId);
                header("location:index.php");
            }
            else {
                $smarty->assign('error',array("Je account is niet geactiveerd."));
                $smarty->display('error.tpl');
            }
        }
    }
}
else {
    $smarty->display('loginform.tpl');
}

echo PHP_EOL;
$smarty->display('footer.tpl');

?>