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
        <title>Board</title>
    </head>
    <body>
        <?php
        
        if ((!isset($_GET['c'])) && (!isset($_GET['f']))) {
            //Alle categoriën met hun forum laten zien
            $board = new Board($db);
            $categories = $board->getAllCategories();

            //Lus door alle Categoriëen
            foreach($categories as $category) {
                $url = '?c='.$category->getId();
                echo "<hr /><center><b><a href='".$url."'>".$category->getCategoryname()."</a></b></center><hr />";


                echo "<ul>";
                $forums = $category->getAllForums();
                //Lus door alle forums
                foreach($forums as $forum) {
                    $url = '?f='.$forum->getId();
                    echo "<li><a href='".$url."'>".$forum->getForumname()."</a></li><br />";

    //                $topics = $forum->getAllTopics();
    //                //Lus door alle topics
    //                foreach($topics as $topic) {
    //                    echo "Topic: ".$topic->getTitle()."<br />";
    //                }
                }
                echo "</ul>";
            }
        }
        elseif (isset($_GET['f'])) {
            //Forum laden
            $id = $_GET['f'];
            echo "<a href='post.php?f=".$id."'>Topic aanmaken</a><br />";
            
            
            
            
            
            
        }
        elseif (isset($_GET['c'])) {
            //Categorie laden
            $id = $_GET['c'];
            $category = new Category($db);
            $category->getById($id);
            
            echo "<ul>";
            $forums = $category->getAllForums();
            //Lus door alle forums
            foreach($forums as $forum) {
                $url = '?f='.$forum->getId();
                echo "<li><a href='".$url."'>".$forum->getForumname()."</a></li><br />";
            }
            echo "</ul>";
        }
        ?>
    </body>
</html>