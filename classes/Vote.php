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
    
    public $id;
    public $poll;
    public $answer;
    public $member;
    
    public function __construct(PDO $db) {
        $this->_db = $db;
    }
    
    public function setPoll($pollId) {
        $this->poll = $pollId;
    }
    
    public function setAnswer($answerId) {
        $this->answer = $answerId;
    }
    
    public function setMember($memberId) {
        $this->member = $memberId;
    }
    
    public function getId() {
        return $this->poll;
    }
    
    public function getPoll() {
        return $this->id;
    }
    
    public function getAnswer() {
        return $this->answer;
    }
    
    public function getMember() {
        return $this->member;
    }
    
    public function available() {
        return true;
    }
    
    public function save() {
        if (!$this->available()) {
            return false;
        }
        else {
            
            $qry = $this->_db->prepare("INSERT INTO votes(poll,answer,member) VALUES(:poll,:answer,:member);");
            $data = array(
                ':poll' => $this->poll,
                ':answer' => $this->answer,
                ':member' => $this->member,
            );
            
            $qry->execute($data);
            if ($qry->rowCount() > '0') {
                return true;
            }
            else {
                return false;
            }
        }
    }
    
    public function delete($poll,$member) {
        $this->poll = $poll;
        $this->member = $member;
        $qry = $this->_db->prepare("Delete FROM 'votes' WHERE poll=:poll AND member=:member;");
        $data = array(
                ':poll' => $this->poll,
                ':member' => $this->member,);
            $qry->execute($data);
    }
    
    public function voted($poll) {
        $this->poll = $poll;
        $qry = $this->_db->prepare("SELECT * FROM `votes` WHERE `poll`= ?;");
        $qry->execute(array($this->poll));
        
    }
    
    public function getById($id) {
        $this->id = $id;
        $stmp = $this->_db->prepare("SELECT * FROM `votes` WHERE `id`= ?;");
        $stmp->execute(array($this->id));
        $row = $stmp->fetch(PDO::FETCH_ASSOC);
        
        $this->id = $row['id'];
        $this->poll = $row['poll'];
        $this->answer = $row['answer'];
        $this->member = $row['member'];
    }
}

?>
