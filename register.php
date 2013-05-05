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
        //UPDATE: Gebeurt nu clientside via AJAX voor submit
//        $Config = new Config();
//        $captcha = recaptcha_check_answer ($Config->getCaptchaPrivateKey(),
//            $_SERVER["REMOTE_ADDR"],
//            $_POST["recaptcha_challenge_field"],
//            $_POST["recaptcha_response_field"]);
//
//        if (!$captcha->is_valid) {
//            array_push($errorArr,"De CAPTCHA is niet juist ingevuld.");
//        }
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
        $newuser->setVerificationcode(md5(uniqid(rand(),true)));
        $newuser->setUsergroup("1");
        if (!$newuser->available()) {
            //Gebruikersnaam of emailadres wordt al gebruikt
            $smarty->assign('errors',"Deze gebruikersnaam of dit e-mailadres is al in gebruik.");
            $smarty->display('registration_failed.tpl');
        }
        elseif ($newuser->save()) {            
            $mail = new PHPMailer();
            $mail->IsSMTP();
            $mail->Host = $config->getSmtpHost();
            $mail->SMTPAuth = true;
            $mail->Username = $config->getSmtpLogin();
            $mail->Password = $config->getSmtpPassword();
            $mail->SMTPSecure = 'tls'; 
            $mail->From = $config->getSmtpFrom();
            $mail->FromName = $config->getSmtpFromName();
            $mail->AddAddress($newuser->getEmail());
            $mail->AddReplyTo($config->getSmtpFrom());
            $mail->IsHTML(true);
            $mail->Subject = 'Here is the subject';
            $mail->Subject = 'Welkom op Zottebeatjes.be!';
            $url = $config->getRootDirectory() . 'activate.php?uid=' . $newuser->getId() . '&key=' .$newuser->getVerificationcode();
            $htmlbody = "Hey, ".$newuser->getUsername()."!<br /><br />";
            $htmlbody.= "Welkom op Zottebeatjes.be, het muziekforum voor de allerzotste beatjes!<br />";
            $htmlbody.= "Om je registratie te vervolledigen moet je je e-mailadres nog verifi&#235;ren, dit doe je door op onderstaande link te klikken:<br />";
            $htmlbody.= "<a href='".$url."'>".$url."</a><br /><br />";
            $htmlbody.= "Alvast veel forumplezier!<br /><br />";
            $htmlbody.= "~Het Zottebeatjes Team";
            $plainbody = "Hey, ".$newuser->getUsername()."!\n\n";
            $plainbody.= "Welkom op Zottebeatjes.be, het muziekforum voor de allerzotste beatjes!\n";
            $plainbody.= "Om je registratie te vervolledigen moet je je e-mailadres nog verifiëren, dit doe je door op onderstaande link te klikken:\n";
            $plainbody.= $url . "\n\n";
            $plainbody.= "Alvast veel forumplezier!\n\n";
            $plainbody.= "~Het Zottebeatjes Team";
            $mail->Body    = $htmlbody;
            $mail->AltBody = $plainbody;
            
            if(!$mail->Send()) {
                //Emailsysteem faalt --> Gebruiker voordeel van twijfel geven en account activeren
                $newuser->activate();
                die($newuser->getId());
             }
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