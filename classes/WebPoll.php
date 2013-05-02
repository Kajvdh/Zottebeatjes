<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of WebPoll
 *
 * @author Michael
 */
class WebPoll {
    const POLL = true;
    const VOTES = false;
    
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
    
    public function getId() {
        return $this->id;
    }
    
    public function getQuestion() {
        return $this->question;
    }
    
    public function save() {
        if (!$this->available()) {
            return false;
        }
        else {
            $qry = $this->_db->prepare("INSERT INTO polls(votes) VALUES(:votes);");
            $data = array(
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
