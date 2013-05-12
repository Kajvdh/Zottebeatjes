<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Vote
 *
 * @author Michael
 */
class Vote {
    private $_db;
    
    public $_id;
    private $_poll;
    private $_answer;
    private $_member;
    
    public function __construct(PDO $db) {
        $this->_db = $db;
    }
    
    public function getId() {
        return $this->_poll;
    }
    public function getPoll() {
        return $this->_poll;
    }
    public function setPoll($pollId) {
        $this->_poll = $pollId;
    }
    public function getAnswer() {
        return $this->_answer;
    }
    public function setAnswer($answerId) {
        $this->_answer = $answerId;
    }
    public function getMember() {
        return $this->_member;
    }    
    public function setMember($memberId) {
        $this->_member = $memberId;
    }
    
    
    
    public function save() {            
        $qry = $this->_db->prepare("INSERT INTO votes(poll,answer,member) VALUES(:poll,:answer,:member);");
        $data = array(
            ':poll' => $this->_poll,
            ':answer' => $this->_answer,
            ':member' => $this->_member,
        );

        $qry->execute($data);
        if ($qry->rowCount() > '0') {
            return true;
        }
        else {
            return false;
        }
    }
    
    public function delete($poll,$voter) {
        $this->_poll = $poll;
        $this->voter = $voter;
        $qry = $this->_db->prepare("DELETE FROM `votes` WHERE poll=:poll AND member=:member;");
        $data = array(
                ':poll' => $this->_poll,
                ':member' => $this->voter,);
        $qry->execute($data);
    }
       
    
    public function getByMemberAndPoll() {
        $stmp = $this->_db->prepare("SELECT * FROM `votes` WHERE `poll`=:poll AND `member`=:member;");
        $data = array(
                ':poll' => $this->_poll,
                ':member' => $this->_member);
        $stmp->execute($data);
        if ($stmp->rowCount() > '0') {
            $row = $stmp->fetch(PDO::FETCH_ASSOC);
            $this->_id = $row['id'];
            $this->_answer = $row['answer'];
            return true;
        }
        else {
            return false;
        } 
    }
    
    public function getVotecountByAnswer() {
        $stmp = $this->_db->prepare("SELECT * FROM `votes` WHERE `answer`= ?;");
        $stmp->execute(array($this->_answer));
        return $stmp->rowCount();
    }
    public function getVotecountByPoll() {
        $stmp = $this->_db->prepare("SELECT * FROM `votes` WHERE `poll`= ?;");
        $stmp->execute(array($this->_poll));
        return $stmp->rowCount();
    }
}

?>
