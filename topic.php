<?php
session_start();
include 'includes.php';

$database = new Database();
$db = $database->getConnection();

$smarty->display('header.tpl');
echo PHP_EOL;

$dataArr = array();
if (isset($_GET['t'])) {
    $topic = new Topic($db);
    $topic->getById($_GET['t']);
    
    $dataArr['topic'] = array();
    $dataArr['topic']['id'] = $topic->getId();
    $dataArr['topic']['name'] = $topic->getTitle();
    
    
    $forumId = $topic->getForum();
    $forum = new Forum($db);
    $forum->getById($forumId);
    
    $dataArr['forum'] = array();
    $dataArr['forum']['id'] = $forum->getId();
    $dataArr['forum']['name'] = $forum->getForumName();
    
    $categoryId = $forum->getCategory();
    $category = new Category($db);
    $category->getById($categoryId);
    
    $dataArr['category'] = array();
    $dataArr['category']['id'] = $category->getId();
    $dataArr['category']['name'] = $category->getCategoryname(); 
    
}
$smarty->assign('data',$dataArr);
$smarty->display('navmenu.tpl');


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