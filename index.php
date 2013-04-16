<?php
session_start();
include 'includes.php';
$database = new Database();
$db = $database->getConnection();


$smarty->display('header.tpl');
echo PHP_EOL;

$login = new Login();
if (!$login->getSession()) {
    // niet ingelogd
    echo "Je bent niet ingelogd. <br />";
    echo "Klik <a href='register.php'>hier</a> om je te registreren. <br />";
    echo "Klik <a href='login.php'>hier</a> om in te loggen. <br />";
}
else {
    // wel ingelogd
    echo "Je bent ingelogd. <br />";
    echo "Klik <a href='logout.php'>hier</a> om uit te loggen. <br />";
    echo "Klik <a href='board.php'>hier</a> om naar het forum te gaan. <br />";
}

echo PHP_EOL;
$smarty->display('footer.tpl');
?>