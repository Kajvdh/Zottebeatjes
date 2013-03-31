<?php
session_start();
include 'includes.php';
?>


<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Home pagina</title>
        <script src="js/jquery/jquery-1.9.1.js"></script>
        <script language="javascript">
            $(document).ready(function() {
                $("#testje").html("HAAAI!");
            });
            
        </script>
            
    </head>
    <body>
        <div id="testje">Hoi</div>
        <?php
        $login = new Login();

        if (!$login->getSession()) {
            // niet ingelogd
            echo "Je bent niet ingelogd. <br />";
            echo "Klik <a href='register.php'>hier</a> om je te registreren. <br />";
            echo "Klik <a href='login.php'>hier</a> om in te loggen. <br />";
        }
        else {
            // wel ingelogd
            echo "Je bent ingelogd.";
            echo "Klik <a href='logout.php'>hier</a> om uit te loggen. <br />";
        }
        ?>
    </body>
</html>