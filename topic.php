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
                
                $dataArr = array();
                
                foreach ($posts as $post) {
                    $postArr = array();
                    $postArr['id'] = $post->getId();
                    $postArr['author'] = "naamloos";
                    $postArr['content'] = $post->getContent();
                    $postArr['postdate'] = $post->getPostdate();
                    array_push($dataArr,$postArr);
                }
                
                $smarty->assign('posts',$dataArr);
                $smarty->display('topic.tpl');
            }
        ?>
    </body>
</html>
