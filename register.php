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
        <script src="js/jquery/jquery-1.9.1.js" />
        <script>
            cscsct();
//            var request;
//            $("#username").focusout(function(event) {
//                if (request) {
//                    request.abort();
//                }
//                var data = $(this).val();
//                var request = $.ajax({
//                    url: "ajax/registerValidate",
//                    type: "post",
//                    data: "{username"
//                })
//            });
            
            
            $("#clickhere").click(function() {
                alfert("geklikt!");
            });
        </script>
        
        
    </head>
    <body>
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
            <input id="submitbutton" type="button" value="Registreer!" />
        </form>
        
        
    </body>
</html>