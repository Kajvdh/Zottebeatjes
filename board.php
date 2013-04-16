<?php
session_start();
include 'includes.php';
$database = new Database();
$db = $database->getConnection();

$smarty->display('header.tpl');
echo PHP_EOL;

$dataArr = array();
if (isset($_GET['c'])) {
    $category = new Category($db);
    $category->getById($_GET['c']);
    
    $dataArr['category'] = array();
    $dataArr['category']['id'] = $category->getId();
    $dataArr['category']['name'] = $category->getCategoryname();
}
    
if (isset($_GET['f'])) {
    $forum = new Forum($db);
    $forum->getById($_GET['f']);
    
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


if ((!isset($_GET['c'])) && (!isset($_GET['f']))) {
    //Alle categoriën met hun forum laten zien
    $board = new Board($db);
    $categories = $board->getAllCategories();

    $dataArr = array();

    //Lus door alle Categoriëen
    foreach($categories as $category) {
        $categoryArr = array();

        $categoryArr['id'] = $category->getId();
        $categoryArr['name'] = $category->getCategoryname();
        $categoryArr['forums'] = array();


        $forums = $category->getAllForums();

        foreach($forums as $forum) {
            $forumArr = array();
            $forumArr['id'] = $forum->getId();
            $forumArr['name'] = $forum->getForumName();

            array_push($categoryArr['forums'],$forumArr);
        }
        array_push($dataArr,$categoryArr);
    }
    $smarty->assign('categories',$dataArr);
    $smarty->display('board.tpl');
}
elseif (isset($_GET['f'])) {
    //Forum laden
    $forumId = $_GET['f'];

    $forum = new Forum($db);
    $forum->getById($forumId);
    $topics = $forum->getAllTopics();

    $dataArr = array();

    foreach($topics as $topic) {
        $topicArr = array();
        $topicArr['id'] = $topic->getId();
        $topicArr['title'] = $topic->getTitle();
        array_push($dataArr,$topicArr);
    }

    $smarty->assign('forumId',$forumId);

    $smarty->assign('topics',$dataArr);
    $smarty->display('forum.tpl');

}
elseif (isset($_GET['c'])) {
    //Categorie laden
    $categoryId = $_GET['c'];
    $category = new Category($db);
    $category->getById($categoryId);

    $forums = $category->getAllForums();

    $dataArr = array();
    foreach($forums as $forum) {
        $forumArr = array();
        $forumArr['id'] = $forum->getId();
        $forumArr['name'] = $forum->getForumName();
        array_push($dataArr,$forumArr);
    }

    $smarty->assign('forums',$dataArr);
    $smarty->display('category.tpl');
}

echo PHP_EOL;
$smarty->display('footer.tpl');

?>