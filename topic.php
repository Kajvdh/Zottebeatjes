<?php
session_start();
include 'includes.php';

$database = new Database();
$db = $database->getConnection();

$smarty->display('header.tpl');
echo PHP_EOL;


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

echo PHP_EOL;
$smarty->display('footer.tpl');

?>