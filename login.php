<?php
session_start();
include 'includes.php';

$database = new Database();
$db = $database->getConnection();


$smarty->display('header.tpl');
echo PHP_EOL;


$login = new Login();
if ($login->getSession()) {
    echo "Je bent ingelogd.";
    header("location:index.php");
}
elseif (isset($_POST['loginform'])) {
    /**
     * @todo: Asynchrone verificatie via AJAX
     */
    if (!(($_POST['username']) && ($_POST['password']))) {
        echo "Je hebt niet alle benodigde informatie ingevuld";
    }
    else {
        $username = $_POST['username'];
        $password = md5($_POST['password']);

        $member = new Member($db);
        $member->setUsername($username);
        $member->setPassword($password);

        $memberId = $member->verify();

        if ($memberId == false) {
            echo "De ingegeven logingegevens zijn fout.";
        }
        else {
            echo "De ingegeven logingegevens zijn correct.";
            $member->getById($memberId);
            $member->setLastloginNow();
            $member->setLastIp($_SERVER['REMOTE_ADDR']);
            $login->setSession($memberId);
            header("location:index.php");
        }
    }



}
else {
    $smarty->display('loginform.tpl');
}

echo PHP_EOL;
$smarty->display('footer.tpl');

?>