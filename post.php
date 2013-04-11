<?php
session_start();
include 'includes.php';
require_once 'lib/recaptchalib.php';
$database = new Database();
$db = $database->getConnection();
?>

<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Nieuwe post plaatsen</title>
        <script src="js/jquery/jquery-1.9.1.js"></script>
        <script src="js/jquery/jquery.validate.js"></script>
        <script>
            $(document).ready(function() {
                $("#postform").validate({
                    rules: {
                        topicname: {
                            required: true
                        },
                        post: {
                            required: true
                        }
                    },
                    messages: {
                        topicname: {
                            required: "Gelieve een Topic naam in te vullen.",
                        },
                        post: {
                            required: "Gelieve een eerste post aan te maken in de nieuwe topic, waar u mogelijk informatie geeft over de topic.",
                        }
                    }
                
                });
            });
        </script>
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
            
         <form name="TopicMake" id="postform" method="post" action="post.php" >
            <fieldset>
                <legend>Topic aanmaken</legend>
                <input type="hidden" name="regform" value="true" />

                <label for="topicname">Topic naam:</label>
                <input type="text" id="topicname" name="topicname" id="topciname" />
                <br />
                <label for="post">Post:</label>
                <input type="text" id="post" name="email" id="email" />
                <br />

                <input id="postbutton" type="submit" value="Post!" />
            </fieldset>
        </form>
            
            
            
        }
        
        ?>
    </body>
</html>
