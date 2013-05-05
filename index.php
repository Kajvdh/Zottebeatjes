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

$smarty->display('index.tpl');

$webpoll = new WebPoll($db);
$polls = $webpoll->getAllPolls();

$dataArr = array();
        
//Lus door alle Antwoorden
foreach ($polls as $poll) {
    $pollArr = array();
    
    $pollArr['id'] = $poll->getId();
    $pollArr['question'] = $poll->getQuestion();
    $pollArr['answers'] = array();
    //$pollArr['votes'] = $poll->getVotes();
    
    $answers = $poll->getAllAnswers();
    
    foreach ($answers as $answer) {
        $answerArr = array();
        $answerArr['id'] = $answer->getId();
        $answerArr['poll'] = $answer->getPoll();
        $answerArr['content'] = $answer->getContent();
        //$answerArr['votes'] = $answer->getVotes();

        array_push($pollArr['answers'],$answerArr);
    }
    array_push($dataArr,$pollArr);
}

$smarty->assign('answers',$dataArr);
$smarty->display('poll.tpl');

echo PHP_EOL;
$smarty->display('footer.tpl');
?>