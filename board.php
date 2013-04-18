<?php
session_start();
include 'includes.php';
$database = new Database();
$db = $database->getConnection();

$login = new Login();
if ($login->getSession()) {
    $member = new Member($db);
    $member->getById($login->getSession());
    $smarty->assign('login',$member->getUsername());
}


$smarty->display('header.tpl');
echo PHP_EOL;


if (isset($_GET['t'])) {
    //Topic id opgegeven
    
    $topic = new Topic($db);
    
    if ($topic->getById($_GET['t'])) {
        //Geldig topic ID
        /**
         * Navigatiemenu data
         */
        $dataArr['topic'] = array(); //Data array voor de navigationmenu template
        $forum = new Forum($db);
        $forum->getById($topic->getForum());
        $category = new Category($db);
        $category->getById($forum->getCategory());

        $dataArr['category']['id'] = $category->getId();
        $dataArr['category']['name'] = $category->getCategoryname();
        $dataArr['forum']['id'] = $forum->getId();
        $dataArr['forum']['name'] = $forum->getForumName();
        $dataArr['topic']['id'] = $topic->getId();
        $dataArr['topic']['name'] = $topic->getTitle();

        $smarty->assign('data',$dataArr);
        $smarty->display('navmenu.tpl');
        /**
         * Topic weergeven
         */
        $posts = $topic->getAllPosts();
        $dataArr = array(); //Data array voor de topic template

        foreach ($posts as $post) {
            $postArr = array();
            $postArr['id'] = $post->getId();
            
            /**
             * Author ophalen
             */
            $authorId = $post->getAuthor();
            $member = new Member($db);
            if ($member->getById($authorId)) {
                $postArr['author'] = $member->getUsername();
                
                if (@is_array(getimagesize($member->getAvatar()))) {
                    $postArr['author_avatar'] = $member->getAvatar();
                }
                if ($member->getSignature() != "") {
                    $postArr['author_signature'] = $member->getSignature();
                }
                if ($member->getPosts()) {
                    $postArr['author_posts'] = $member->getPosts();
                }
            }
            else {
                $postArr['author'] = "Onbekende gebruiker";
            }
                        
            $postArr['content'] = $post->getContent();
            $postArr['postdate'] = $post->getPostdate();
            array_push($dataArr,$postArr);
        }
        $smarty->assign('posts',$dataArr);
        $smarty->assign('topicId',$topic->getId());
        $smarty->display('topic.tpl');
    }
    else {
        //Ongeldig topic ID
        $errorArr = array();
        array_push($errorArr,"Geen geldig topic ID opgegeven.");
        $smarty->assign('errors',$errorArr);
        $smarty->display('error.tpl');
    }
}
elseif (isset($_GET['f'])) {
    //Forum id opgegeven
    
    $forum = new Forum($db);
    
    if ($forum->getById($_GET['f'])) {
        //Geldig forum ID
        /**
         * Navigatiemenu
         */
        $category = new Category($db);
        $category->getById($forum->getCategory());

        $dataArr['category']['id'] = $category->getId();
        $dataArr['category']['name'] = $category->getCategoryname();
        $dataArr['forum']['id'] = $forum->getId();
        $dataArr['forum']['name'] = $forum->getForumName();

        $smarty->assign('data',$dataArr);
        $smarty->display('navmenu.tpl');
        /**
         * Forum weergeven
         */
        $topics = $forum->getAllTopics();
        $dataArr = array(); //Data array voor de forum template

        foreach($topics as $topic) {
            $topicArr = array();
            $topicArr['id'] = $topic->getId();
            $topicArr['title'] = $topic->getTitle();
            array_push($dataArr,$topicArr);
        }

        $smarty->assign('forumId',$forum->getId());
        $smarty->assign('topics',$dataArr);
        $smarty->display('forum.tpl');
    }
    else {
        //Ongeldig forum ID
        $errorArr = array();
        array_push($errorArr,"Geen geldig forum ID opgegeven.");
        $smarty->assign('errors',$errorArr);
        $smarty->display('error.tpl');
    }
}
elseif (isset($_GET['c'])) {
    //Categorie id opgegeven
    
    $category = new Category($db);
    if ($category->getById($_GET['c'])) {
        //Geldig categorie ID
        /**
         * Navigatiemenu
         */
        $dataArr['category']['id'] = $category->getId();
        $dataArr['category']['name'] = $category->getCategoryname();

        $smarty->assign('data',$dataArr);
        $smarty->display('navmenu.tpl');
        /**
         * Categorie weergeven
         */
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
    else {
        //Geen geldig categorie ID
        $errorArr = array();
        array_push($errorArr,"Geen geldig categorie ID opgegeven.");
        $smarty->assign('errors',$errorArr);
        $smarty->display('error.tpl');
    }  
}
else {
    //Geen topic/forum/categorie gespecifierd -> Categorieën en forums weergeven
    
    /**
     * Navigatiemenu
     */
    //Geen data om naar het navigatiemenu te sturen
    $smarty->display('navmenu.tpl');
    
    /**
     * Categoriëen met bijbehorende forums weergeven
     */
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

echo PHP_EOL;
$smarty->display('footer.tpl');
?>