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

$smarty->display('index.tpl');

$webpoll = new WebPoll($db);
$polls = $webpoll->getAllPolls();
$voter = $login->getSession();

$dataArr = array();
        

foreach ($polls as $poll) { //Lus door alle polls
    $pollArr = array(); //Id met alle polls in opbouwen
    $pollArr['id'] = $poll->getId();
    $pollArr['question'] = $poll->getQuestion();
    
    $vote = new Vote($db);
    $vote->setPoll($poll->getId());
    $pollArr['votes'] = $vote->getVotecountByPoll();
    //$pollArr['votes'] = $poll->getVotes();
    //$pollArr['votes'] = isset($pollArr['votes']) ? $pollArr['votes'] : 0; //Mocht deze waarde null zijn -> 0
    
    $pollArr['voted'] = $poll->voted($pollArr['id'],$voter);
    
    
    $answers = $poll->getAllAnswers(); //Alle antwoorden op deze poll ophalen
    $pollArr['answers'] = array(); //Array opbouwen van alle antwoorden van deze poll
    foreach ($answers as $answer) { //Lus door alle antwoorden
        $answerArr = array(); //Array voor informatie antwoorden
        
        $answerArr['id'] = $answer->getId(); //Id van de antwoord
        $answerArr['content'] = $answer->getContent(); //Inhoud antwoord
        
        $vote = new Vote($db);
        $vote->setAnswer($answer->getId());
        
        
        
        $answerArr['votes'] = $vote->getVotecountByAnswer(); //Aantal stemmen op dit antwoord ophalen
        
        $answerArr['percent'] = $answer->voteLinePercent($answerArr['votes'],$pollArr['votes']);
        $answerArr['width'] = $answer->voteLineWidth($answerArr['votes'],$pollArr['votes']);
        array_push($pollArr['answers'],$answerArr);
    }
    array_push($dataArr,$pollArr);
}


$smarty->assign('polls',$dataArr);
$smarty->display('poll.tpl');

echo PHP_EOL;
$smarty->display('footer.tpl');
?>