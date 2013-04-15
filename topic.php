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
        <title>Topic</title>
    </head>
    <body>
        <?php
            if (!isset($_GET['t'])) {
                //Geen topic id opgegeven
                /**
                 * @todo: Deze error opvangen
                 */
            }
            else {
                $topic = new Topic($db);
                $topic->getById($_GET['t']);
                
                $posts = $topic->getAllPosts();
                foreach ($posts as $post) {
                    echo "<hr /><br />";
                    echo "ID: " . $post->getId() . "<br />";
                    echo "Content: " . $post->getContent() . "<br />";
                    echo "Postdate: " . $post->getPostdate() . "<br />";
                    echo "<hr /><br />";
                }
                
            }
        ?>
    </body>
</html>
