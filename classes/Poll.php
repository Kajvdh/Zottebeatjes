<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Poll
 *
 * @author Michael
 */
class Poll {
    private $_db;
    private $_answers;
      
    public $id;
    public $question;
    public $votes;
    public $scale = 2;
    
    public function __construct(PDO $db) {
    $this->_db = $db;
    $this->_answers = array();
    }
    
     public function setQuestion($question) {
        $this->question = $question;
    }
    
    public function getId() {
        return $this->id;
    }
    
    public function getQuestion() {
        return $this->question;
    }
    
    public function getVotes() {
        return $this->votes;
    }
    
    public function available() { //Niet zeker of dit nodig is
        return true;
    }
    
    public function save() {
        if (!$this->available()) {
            return false;
        }
        else {
            $qry = $this->_db->prepare("INSERT INTO polls(question,votes) VALUES(:question,:votes);");
            $data = array(
                ':question' => $this->question,
                ':votes' => $this->votes
            );
            
            $qry->execute($data);
            if ($qry->rowCount() > '0') {
                $this->id = $this->_db->lastInsertId('id');
                return true;
            }
            else {
                return false;
            }
        }   
    }
    
    public function getAllAnswers() {
        $stmt = $this->_db->prepare("SELECT `id`FROM `answers` WHERE `poll`= ? ORDER BY `id` ASC;");
        $stmt->execute(array($this->id));
        
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $this->categoryIds = array();
        foreach($results as $i => $dataArr) {
            foreach($dataArr as $id) {
                $answer = new Answer($this->_db);
                $answer->getById($id);
                array_push($this->_answers,$answer);
            }
        }
        return $this->_answers;
        
    }
    
    public function getById($id) {
        $this->id = $id;
        $stmp = $this->_db->prepare("SELECT * FROM `polls` WHERE `id`= ?;");
        $stmp->execute(array($this->id));
        
        if ($stmp->rowCount() == "1") {
            $row = $stmp->fetch(PDO::FETCH_ASSOC);
            $this->id = $row['id'];
            $this->question = $row['question'];
            $this->votes = $row['votes'];
            return true;
        }
        else {
            return false;
        }
    }
}

?>