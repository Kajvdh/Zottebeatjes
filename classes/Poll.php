<?php

/**
 * Class: WebPoll
 * 
 * Bevat alle informatie van een poll
 *
 * @author Kaj Van der Hallen
 * @author Michael Deboeure
 */

class Poll {
    private $_id;            //Uniek ID van de poll
    private $_question;      //Vraag van de poll
    private $_answers;      //Array van de objecten van alle mogelijke antwoorden
    private $_db;           //PDO database object voor communicatie met de database
    
    /**
     * Default constructor
     * @param PDO $db: PDO database object voor communicatie met de database
     */
    public function __construct(PDO $db) {
    $this->_db = $db;
    $this->_answers = array();
    }
    
    /**
     * Getfuncties
     */
    public function getId() {
        return $this->_id;
    }
    public function getQuestion() {
        return $this->_question;
    }
    
    /**
     * Setfuncties
     */
     public function setQuestion($question) {
        $this->_question = $question;
    }
    
    /**
     * Alle antwoorden die tot deze poll behoren ophalen
     * @return type: Array van alle answer objecten die tot deze poll behoren
     */
    public function getAllAnswers() {
        $stmt = $this->_db->prepare("SELECT `id` FROM `answers` WHERE `poll`= ? ORDER BY `id` ASC;");
        $stmt->execute(array($this->_id));
        
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
    
    /**
     * Een poll uit de database ophalen op basis van het ID
     * @param type $id: Het ID van de poll die opgehaald moet worden
     * @return boolean: `true` als de poll bestaat en is opgehaald
     */
    public function getById($id) {
        $this->_id = $id;
        $stmp = $this->_db->prepare("SELECT * FROM `polls` WHERE `id`= ?;");
        $stmp->execute(array($this->_id));
        if ($stmp->rowCount() == "1") {
            $row = $stmp->fetch(PDO::FETCH_ASSOC);
            $this->_id = $row['id'];
            $this->_question = $row['question'];
            return true;
        }
        else {
            return false;
        }
    }
    
    /**
     * Nieuwe poll opslaan
     * @return boolean: `true` wanneer het opslaan gelukt is
     */
    public function save() {
        $qry = $this->_db->prepare("INSERT INTO polls(question) VALUES(:question);");
        $data = array(
            ':question' => $this->_question
        );
        $qry->execute($data);
        if ($qry->rowCount() > '0') {
            $this->_id = $this->_db->lastInsertId('id');
            return true;
        }
        else {
            return false;
        } 
    }
}

?>