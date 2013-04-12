<?php
session_start();
include 'includes.php';

$database = new Database();
$db = $database->getConnection();

$login = new Login();

if (!$login->getSession()) {
    // niet ingelogd
    echo "Je bent niet ingelogd.";
}
else {
    // wel ingelogd
    echo "Je bent ingelogd.";
    header("location:index.php");
}

?>


<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title></title>
        <script src="js/jquery/jquery-1.9.1.js"></script>
        <script src="js/jquery/jquery.validate.js"></script>
        <script>
            $(document).ready(function() {
                $("#loginform").validate({
                    rules: {
                        username: {
                            required: true
                        },
                        password: {
                            required: true
                        }
                    },
                    messages: {
                        username: "Gelieve een gebruikersnaam in te vullen.",
                        password1: "Gelieve een wachtwoord in te vullen."
                    }
                
                });
            });
        </script>
    </head>
    <body>
        <?php
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
        ?>
        
        <form name="login" id="loginform" method="post" action="login.php" >
            <fieldset>
                <legend>Registreren</legend>
                <input type="hidden" name="loginform" value="true" />
                
                <label for="username">Gebruikersnaam:</label>
                <input type="text" id="username" name="username" id="username" />
                <br />
                <label for="password1">Wachtwoord:</label>
                <input type="password" id="password" name="password" id="password" />
                <br />
                <input id="submitbutton" type="submit" value="Log in!" />
            </fieldset>
        </form>
        
        <?php
            }
        ?>
    </body>
</html>