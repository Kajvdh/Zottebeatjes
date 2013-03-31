<?php
session_start();
include 'includes.php';
?>

<?php 

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
                    
                    $member = new Member();
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
        
        <form name="login" method="post" action="login.php" >
            <fieldset>
                <legend>Registreren</legend>
                <input type="hidden" name="loginform" value="true" />
                
                <label for="username">Gebruikersnaam:</label>
                <input type="text" name="username" id="username" />
                <br />
                <label for="password1">Wachtwoord:</label>
                <input type="password" name="password" id="password" />
                <br />
            </fieldset>
            <input id="submitbutton" type="submit" value="Log in!" />
        </form>
        
        <?php
            }
        ?>
    </body>
</html>
