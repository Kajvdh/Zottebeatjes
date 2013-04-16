<?php
session_start();
include 'includes.php';

$database = new Database();
$db = $database->getConnection();

$login = new Login();

if (!$login->getSession()) {
    
}
else {
    header("location:index.php");
}

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

        $verify = $member->verify();

        if ($verify != true) {
            echo "De ingegeven logingegevens zijn fout.";
        }
        else {
            echo "De ingegeven logingegevens zijn correct.";
            $login->setSession($username);
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