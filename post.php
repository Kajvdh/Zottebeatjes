<?php
session_start();
include 'includes.php';
$database = new Database();
$db = $database->getConnection();
?>

<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Nieuwe post plaatsen</title>
    </head>
    <body>
        <?php
        $login = new Login();
        if (!$login->getSession()) {
            // niet ingelogd
            echo "Je bent niet ingelogd. <br />";
            echo "Klik <a href='register.php'>hier</a> om je te registreren. <br />";
            echo "Klik <a href='login.php'>hier</a> om in te loggen. <br />";
        }
        else {
            //Ingelogd, gebruiker mag een post plaatsen
            /**
             * @todo: Controle of de gebruiker, opgeslagen in de sessie, wel echt bestaat
             */
            
            
            
            
            
        }
        
        ?>
    </body>
</html>
