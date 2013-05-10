<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Answers
 *
 * @author Michael
 */
class Answer {
    private $_db;
    
    public $id;
    public $poll;
    public $content;
    public $votes;
    
    public $scale = 2;
    public $totalVotes;
    public $percent;
    public $width;
    
    public function __construct(PDO $db) {
    $this->_db = $db;
    }
    
    public function setPoll($pollId) {
        $this->poll = $pollId;
    }
    
    public function setContent($content) {
        $this->content = $content;
    }
    
    public function setVotes($votes) {
        $this->votes = $votes;
    }
    
    public function getId() {
        return $this->id;
    }
    
    public function getPoll() {
        return $this->poll;
    }
    
    public function getContent() {
        return $this->content;
    }
    
    public function getVotes() {
        return $this->votes;
    }
    
    public function available() {
        return true;
    }
    
    public function save() {
        if (!$this->available()) {
            return false;
        }
        else {
            $qry = $this->_db->prepare("INSERT INTO answers(poll,content,votes) VALUES(:poll,:content,:votes);");
            $data = array(
                ':poll' => $this->poll,
                ':content' => $this->content,
                ':votes' => $this->votes,
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
    
    public function voteLinePercent($votes,$totalVotes) {
        $votes = isset($votes) ? $votes : 0;
        $totalVotes = isset($totalVotes) ? $totalVotes : 0;
        if ($totalVotes > 0) {
        $percent = round(($votes/$totalVotes)*100);
        }
        else
        {
            $percent = 0;
        }
        
        return $this->percent;
    }
    
    public function voteLineWidth($votes,$totalVotes) {
        $votes = isset($votes) ? $votes : 0;
        $totalVotes = isset($totalVotes) ? $totalVotes : 0;
        if ($totalVotes > 0) {
        $width = round(($votes/$totalVotes)*100) * $this->scale;
        }
        else {
            $width = 0;
        }
      
        return $this->width;
    }
    
    public function getById($id) {
        $this->id = $id;
        $stmp = $this->_db->prepare("SELECT * FROM `answers` WHERE `id`= ?;");
        $stmp->execute(array($this->id));
        $row = $stmp->fetch(PDO::FETCH_ASSOC);
        
        $this->id = $row['id'];
        $this->poll = $row['poll'];
        $this->content = $row['content'];
        $this->votes = $row['votes'];
    }
}

?>
