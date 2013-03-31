<?php
session_start();
include 'includes.php';
require_once 'lib/recaptchalib.php';
$login = new Login();
if ($login->getSession()) {
    // ingelogd
    header("location:index.php");
}
?>


<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Registreren</title>
        <script src="js/jquery/jquery-1.9.1.js"></script>
    </head>
    <body>
        <?php
        if (!isset($_POST['regform'])) {
        ?>
        
        <form name="register" method="post" action="register.php" >
            <fieldset>
                <legend>Registreren</legend>
                <input type="hidden" name="regform" value="true" />
                
                <label for="username">Gebruikersnaam:</label>
                <input type="text" name="username" id="username" />
                <br />
                <label for="email">Emailadres:</label>
                <input type="text" name="email" id="email" />
                <br />
                <label for="password1">Wachtwoord:</label>
                <input type="password" name="password1" id="password1" />
                <br />
                <label for="password2">Wachtwoord (nogmaals):</label>
                <input type="password" name="password2" id="password2" />
                <br />
                
                <?php
                $config = new Config();
                $publickey = $config->getCaptchaPublicKey();


                echo recaptcha_get_html($publickey);

                ?>
                
            </fieldset>
            <input id="submitbutton" type="submit" value="Registreer!" />
        </form>
        <?php
        }
        else {
            //Controle velden
            /**
             * @todo: Controle van de velden verbeteren
             * + Asynchrone controle via AJAX bij het invullen van het form.
             */
            $errors = "0";
            $errormsg = "";
            
            if ((!isset($_POST["username"]) || strlen($_POST["username"] < "3"))) {
                $errors++;
                $errormsg .= "Je hebt geen geldige gebruikersnaam opgegeven.<br />";
            }
            if ((!isset($_POST["password1"]) || (!isset($_POST["password2"]) || strlen($_POST["password1"] < "8")))) {
                $errors++;
                $errormsg .= "Je hebt geen geldig wachtwoord opgegeven.<br />";
            }
            if ((!isset($_POST["email"]))) {
                $errors++;
                $errormsg .= "Je hebt geen geldig emailadres opgegeven.<br />";
            }
            if ((!isset($_POST['recaptcha_challenge_field'])) || (!isset($_POST['recaptcha_response_field']))) {
                $errors++;
                $errormsg .= "CAPTCHA fout, contacteer een als deze fout zich voordoet.";
            }
            else {
                //reCAPTCHA controle
                $Config = new Config();
                $captcha = recaptcha_check_answer ($Config->getCaptchaPrivateKey(),
                    $_SERVER["REMOTE_ADDR"],
                    $_POST["recaptcha_challenge_field"],
                    $_POST["recaptcha_response_field"]);

                if (!$captcha->is_valid) {
                    $errors++;
                    $errormsg .= "De CAPTCHA niet juist ingevuld.";
                }
            }
            
            
            
            
            //Encryptie wachtwoorden
            $password1md5 = md5($_POST["password1"]);
            $password2md5 = md5($_POST["password2"]);
            
            if ($password1md5 != $password2md5) {
                $errors++;
                $errormsg .= "De twee wachtwoorden die je hebt opgegeven zijn niet gelijk.<br />";
            }
            
            if ($errors > "0") {
                echo "Je hebt niet alle velden juist ingevuld:<br /><br />";
                echo $errormsg;
            }
            else {
                $newuser = new Member();
                $newuser->setUsername($_POST["username"]);
                $newuser->setEmail($_POST["email"]);
                $newuser->setPassword($password1md5);
                $result = $newuser->available();

                if ($result == true) {
                    echo "Account kan worden geregistreerd.";
                    $newuser->save();
                }
                else {
                    echo "Dit account bestaat al, registratie mislukt.";
                }
            }
        }
        ?>
        
        
    </body>
</html>