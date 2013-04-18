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



if (!isset($_POST['regform'])) {
    $config = new Config();
    $publickey = $config->getCaptchaPublicKey();

    $smarty->assign('recaptcha',recaptcha_get_html($publickey));
    $smarty->display('registerform.tpl');
}
else {
    //Controle velden
    /**
     * @todo: Controle van de velden verbeteren
     * + Asynchrone controle via AJAX bij het invullen van het form.
     */
    $errorArr = array();

    if ((!isset($_POST["username"]) || strlen($_POST["username"] < "3"))) {
        array_push($errorArr,"Je hebt geen geldige gebruikersnaam opgegeven.");
    }
    if ((!isset($_POST["password1"]) || (!isset($_POST["password2"]) || strlen($_POST["password1"] < "8")))) {
        array_push($errorArr,"Je hebt geen geldig wachtwoord opgegeven.");
    }
    if ((!isset($_POST["email"]))) {
        array_push($errorArr,"Je hebt geen geldig emailadres opgegeven.");
    }
    if ((!isset($_POST['recaptcha_challenge_field'])) || (!isset($_POST['recaptcha_response_field']))) {
        array_push($errorArr,"CAPTCHA fout, contacteer een administrator als deze fout zich blijft voordoen.");
    }
    else {
        //reCAPTCHA controle
        $Config = new Config();
        $captcha = recaptcha_check_answer ($Config->getCaptchaPrivateKey(),
            $_SERVER["REMOTE_ADDR"],
            $_POST["recaptcha_challenge_field"],
            $_POST["recaptcha_response_field"]);

        if (!$captcha->is_valid) {
            array_push($errorArr,"De CAPTCHA is niet juist ingevuld.");
        }
    }


    //Encryptie wachtwoorden
    $password1md5 = md5($_POST["password1"]);
    $password2md5 = md5($_POST["password2"]);

    if ($password1md5 != $password2md5) {
        array_push($errorArr,"De twee opgegeven wachtwoorden komen niet overeen.");
    }

    if (count($errorArr) > "0") {
        $smarty->assign('errors',$errorArr);
        $smarty->display('registration_failed.tpl');
    }
    else {
        $newuser = new Member($db);
        $newuser->setUsername($_POST["username"]);
        $newuser->setEmail($_POST["email"]);
        $newuser->setPassword($password1md5);

        if (!$newuser->available()) {
            //Gebruikersnaam of emailadres wordt al gebruikt
            $smarty->assign('errors',"Deze gebruikersnaam of dit e-mailadres is al in gebruik.");
            $smarty->display('registration_failed.tpl');
        }
        elseif ($newuser->save()) {
            $smarty->display('registration_succesfull.tpl');
        }
        else {
            //Registratie mislukt
            $smarty->assign('errors',"Door technische problemen kon het account niet worden geregistreerd, als deze fout zich blijft voortdoen contacteer dan een administrator.");
            $smarty->display('registration_failed.tpl');
        }
    }
}

echo PHP_EOL;
$smarty->display('footer.tpl');

?>