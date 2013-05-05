<?php
session_start();
include 'includes.php';
require_once 'lib/recaptchalib.php';
$database = new Database();
$db = $database->getConnection();

$login = new Login();
if ($login->getSession()) {
    $member = new Member($db);
    $member->getById($login->getSession());
    $smarty->assign('login',$member->getUsername());
}
else {
    $member = new Member($db);
    $member->isGuest(true); //Memberobject als gast aanmaken
}

$smarty->display('header.tpl');
echo PHP_EOL;


$login = new Login();
if (!$login->getSession()) {
    // niet ingelogd
    $smarty->display('not_logged_in.tpl');
}
else {
    if (isset($_POST['newtopic'])) {
        //Form om een nieuw topic te maken is ingevuld
        
        if (!$member->getPermissions()->canPostTopic()) {
            //Gebruiker heeft geen rechten om topics te starten
            $smarty->assign('errors',array("Je hebt niet genoeg rechten om een nieuw topic aan te maken."));
            $smarty->display('error.tpl');
        }
        else {
        
            $errorArr = array();

            if ((!isset($_POST['forumid']))) {
                array_push($errorArr,"Het forum waar je een topic probeert te plaatsen bestaat niet.");
            }
            else {
                $forum = new Forum($db);
                if(!$forum->getById($_POST['forumid'])) {
                    array_push($errorArr,"Het forum waar je een topic probeert te plaatsen bestaat niet.");
                }
            }

            if ((!isset($_POST['topicname'])) || (strlen($_POST['topicname']) < "3")) {
                array_push($errorArr,"Je hebt geen geldige topictitel opgegeven.");
            }
            if ((!isset($_POST['post'])) || (strlen($_POST['post']) < "1")) {
                array_push($errorArr,"Je hebt geen post ingevuld.");
            }

            if (count($errorArr) > "0") {
                $smarty->assign('errors',$errorArr);
                $smarty->display('error.tpl');
            }
            else {
                //Juist ingevuld, post in de database wegschrijven
                $post = new Post($db);
                $topic = new Topic($db);
                /**
                 * @todo: uitlezen wie de poster is uit de sessie
                 */
                $author = $login->getSession();

                $topic->setForum($_POST['forumid']);
                $topic->setTitle($_POST['topicname']);
                $topic->save();

                $post->setTopic($topic->getId());
                $post->setAuthor($author);
                $post->setContent($_POST['post']);
                $post->setIsNewTopic(true);
                $post->save();

                $member = new Member($db);
                $member->getById($author);
                $member->incPosts();
                header("location:board.php?t=".$topic->getId());
            }
        }
    }
    elseif (isset($_POST['newpost'])) {
        //Form om een nieuwe post te plaatsen in een bestaand topic is ingevuld
        if (!$member->getPermissions()->canPostReply()) {
            //Gebruiker heeft geen rechten om te reageren op topics
            $smarty->assign('errors',array("Je hebt niet genoeg rechten te reageren op topics."));
            $smarty->display('error.tpl');
        }
        else {
            $errorArr = array();
        
            if ((!isset($_POST['topicid']))) {
                array_push($errorArr,"Het topic waar je een reactie probeert te plaatsen bestaat niet.");
            }
            else {
                $topic = new Topic($db);
                if (!$topic->getById($_POST['topicid'])) {
                    array_push($errorArr,"Het topic waar je een reactie probeert te plaatsen bestaat niet.");
                }
            }

            if ((!isset($_POST['post'])) || (strlen($_POST['post']) < "1")) {
                array_push($errorArr,"Je hebt geen post ingevuld.");
            }

            if (count($errorArr) > "0") {
                $smarty->assign('errors',$errorArr);
                $smarty->display('error.tpl');
            }
            else {
                //Juist ingevuld, post in de database wegschrijven
                $post = new Post($db);
                /**
                 * @todo: uitlezen wie de poster is uit de sessie
                 */
                $author = $login->getSession();

                $post->setTopic($_POST['topicid']);
                $post->setAuthor($author);
                $post->setContent($_POST['post']);
                $post->setIsNewTopic(false);
                $post->save();

                $member = new Member($db);
                $member->getById($author);
                $member->incPosts();
                header("location:board.php?t=".$post->getTopic());
            }
        }
        
    }
    else {
        //nog geen post geplaatst

        //Ingelogd, gebruiker mag een post plaatsen
        /**
         * @todo: Controle of de gebruiker, opgeslagen in de sessie, wel echt bestaat
         */
        
        if (isset($_GET['t'])) {
            //Reageren op een topic
            if (!$member->getPermissions()->canPostReply()) {
                //Gebruiker heeft geen rechten om te reageren op topics
                $smarty->assign('errors',array("Je hebt niet genoeg rechten te reageren op topics."));
                $smarty->display('error.tpl');
            }
            else {
                $smarty->assign('topicId',$_GET['t']);
                $smarty->display('newpost.tpl');
            }
        }
        elseif (isset($_GET['f'])) {
            //Nieuw topic aanmaken
            if (!$member->getPermissions()->canPostTopic()) {
                //Gebruiker heeft geen rechten om topics te starten
                $smarty->assign('errors',array("Je hebt niet genoeg rechten om een nieuw topic aan te maken."));
                $smarty->display('error.tpl');
            }
            else {
                $smarty->assign('forumId',$_GET['f']);
                $smarty->display('newtopic.tpl');
            }
        }
        else {
            $errorArr = array();
            array_push($errorArr,"Onvolledige link");
            $smarty->assign('errors',$errorArr);
            $smarty->display('error.tpl');
        }
    }
}

echo PHP_EOL;
$smarty->display('footer.tpl');
?>