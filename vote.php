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
    if ($member->getPermissions()->isAdmin()) {
        $smarty->assign('isadmin',true);
    }
}
else {
    $member = new Member($db);
    $member->isGuest(true); //Memberobject als gast aanmaken
}

$smarty->display('header.tpl');
echo PHP_EOL;

if (isset($_POST['newvote'])) {
    $errorArr = array();
    
    if (!$member->getPermissions()->canVote()) {
        array_push($errorArr, "Je hebt niet voldoende access om te kunnen stemmen.");
    }

    if ((!isset($_POST['pollid']))) {
        array_push($errorArr,"De poll waar je op probeert te stemmen bestaat niet.");
    }
    else {
        $poll = new Poll($db);
        if (!$poll->getById($_POST['pollid'])) {
            array_push($errorArr,"De poll waar je op probeert te stemmen bestaat niet.");
        }
    }

    if (count($errorArr) > "0") {
        $smarty->assign('errors',$errorArr);
        $smarty->display('error.tpl');
    }
    else {;
        $vote = new Vote($db);
        $vote->setPoll($_POST['pollid']);
        $vote->setAnswer($_POST['answerid']);
        $vote->setMember($member->getId());
        $vote->save();
        header("location:index.php");
    }
}
elseif (isset($_POST['removevote'])) {
    $errorArr = array();

    if (!$member->getPermissions()->canVote()) {
        array_push($errorArr, "Je hebt niet voldoende access om te kunnen stemmen.");
    }
    if ((!isset($_POST['pollid']))) {
                array_push($errorArr,"De poll waar je een stem van wilt verwijderen bestaat niet.");
    }
    else {
        $poll = new Poll($db);
        if (!$poll->getById($_POST['pollid'])) {
            array_push($errorArr,"De poll waar je een stem van wilt verwijderen bestaat niet.");
        }
    }
    if (count($errorArr) > "0") {
        $smarty->assign('errors',$errorArr);
        $smarty->display('error.tpl');
    }
    else {
        $vote = new Vote($db);
        $vote->delete($_POST['pollid'],$member->getId());
        header("location:index.php");
    }
}

echo PHP_EOL;
$smarty->display('footer.tpl');
?>
