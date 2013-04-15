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
        <script src="js/jquery/jquery-ui.1.10.2.custom.js"></script>
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
        <script>
            $(function() {
		$( "#post" ).resizable({
			handles: "se"
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
            
            if (isset($_POST['postform'])) {
                //Er is al een post geplaatst
                //Parameters inlezen
                
                $errors = "0";
                $errormsg = "";
                
                if ((!isset($_POST['forumid']))) {
                    $errors++;
                    $errormsg .= "In dit forum kan geen post geplaatst worden.<br />";
                }
                
                if ((!isset($_POST['topicname'])) || (strlen($_POST['topicname']) < "3")) {
                    $errors++;
                    $errormsg .= "Je hebt geen geldige topictitel opgegeven.<br />";
                }
                if ((!isset($_POST['post'])) || (strlen($_POST['post']) < "1")) {
                    $errors++;
                    $errorsmsg .= "Je hebt geen post ingevuld.<br />";
                }
                
                if ($errors > "0") {
                    echo "Je hebt niet alle velden correct ingevuld:<br /><br />";
                    echo $errorsmsg;
                }
                else {
                    //Juist ingevuld, post in de database wegschrijven
                    $post = new Post($db);
                    $topic = new Topic($db);
                    /**
                     * @todo: uitlezen wie de poster is uit de sessie
                     */
                    $author = "4";
                    
                    $topic->setForum($_POST['forumid']);
                    $topic->setTitle($_POST['topicname']);
                    $topic->save();
                    $topicid = $topic->getId();
                    
                    $post->setTopic($topicid);
                    $post->setAuthor($author);
                    $post->setContent($_POST['post']);
                    $post->setIsNewTopic(true);
                    $post->save();
                }
            }
            else {
                //nog geen post geplaatst
            
                //Ingelogd, gebruiker mag een post plaatsen
                /**
                 * @todo: Controle of de gebruiker, opgeslagen in de sessie, wel echt bestaat
                 */
                
                                
                
                ?>


                <form name="TopicMake" id="postform" method="post" action="post.php" >
                   <fieldset>
                       <legend>Topic aanmaken</legend>
                       <input type="hidden" name="postform" value="true" />
                       <input type="hidden" name="forumid" value="<?php echo $_GET['f']; ?>" />

                       <label for="topicname">Topic titel:</label>
                       <input type="text" id="topicname" name="topicname" />
                       <br /><br />

                       <textarea id="post" name="post" rows="10" cols="60"></textarea>
                       <br /><br />

                       <input id="postbutton" type="submit" value="Post!" />
                   </fieldset>
               </form>
        <?php
            }
        }
        ?>
        
    </body>
</html>
