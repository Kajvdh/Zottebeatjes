<?php
session_start();
include 'includes.php';
$database = new Database();
$db = $database->getConnection();

$login = new Login();
$member = new Member($db);
if ($login->getSession()) {
    $member->getById($login->getSession());
    $smarty->assign('login',$member->getUsername());
}
else {
    $member = new Member($db);
    $member->isGuest(true); //Memberobject als gast aanmaken
}

$smarty->display('header.tpl');
echo PHP_EOL;



if ((!$member->getUsername()) || ($member->getPermissions()->isAdmin() < 1)) {
    //gebruiker niet ingelogd
    $smarty->assign('errors',array("Je hebt geen toegang tot deze pagina."));
    $smarty->display('error.tpl');
}
else {
    
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
    $smarty->display('admincp.tpl');
}

echo PHP_EOL;
$smarty->display('footer.tpl');
?>