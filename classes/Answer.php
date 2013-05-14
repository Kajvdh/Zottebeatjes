<?php

/**
 * Class: Answer
 * 
 * Bevat alle informatie van een antwoord (op een poll)
 *
 * @author Kaj Van der Hallen
 * @author Michael Deboeure
 */

class Answer {
    private $_id;           //Uniek ID van het antwoord
    private $_poll;         //ID van de poll waar dit antwoord toe behoort
    private $_content;      //Inhoud van het antwoord
    private $_scale = 6;    //Schaal voor weergave van poll-votebalk
    private $_db;           //PDO database object voor communicatie met de database
    
    /**
     * Default constructor
     * @param PDO $db: PDO database object voor communicatie met de database
     */
    public function __construct(PDO $db) {
    $this->_db = $db;
    }
    
    /**
     * Getfuncties
     */
    public function getId() {
        return $this->_id;
    }
    public function getPoll() {
        return $this->_poll;
    }
    public function getContent() {
        return $this->_content;
    }
    
    /**
     * Setfuncties
     */
    public function setPoll($pollId) {
        $this->_poll = $pollId;
    }
    
    public function setContent($content) {
        $this->_content = $content;
    }
    
    /**
     * Een antwoord uit de database ophalen op basis van het ID
     * @param type $id: Het ID van het antwoord dat opgehaald moet worden
     * @return boolean: `true` als het antwoord bestaat en is opgehaald
     */
    public function getById($id) {
        $this->_id = $id;
        $stmp = $this->_db->prepare("SELECT * FROM `answers` WHERE `id`= ?;");
        $stmp->execute(array($this->_id));
        if ($stmp->rowCount() > '0') {
            $row = $stmp->fetch(PDO::FETCH_ASSOC);
            $this->_id = $row['id'];
            $this->_poll = $row['poll'];
            $this->_content = $row['content'];
            return true;
        }
        else {
            return false;
        }
    }
    
    /**
     * Nieuw antwoord opslaan
     * @return boolean: `true` wanneer het opslaan gelukt is
     */
    public function save() {
        $qry = $this->_db->prepare("INSERT INTO answers(poll,content) VALUES(:poll,:content);");
        $data = array(
            ':poll' => $this->_poll,
            ':content' => $this->_content
        );
        $qry->execute($data);
        if ($qry->rowCount() > '0') {
            return true;
        }
        else {
            return false;
        }
    }
    
    
    /**
     * Functies voor het opbouwen van het stembalkje dat bij de polls getoond wordt
     */
    public function voteLinePercent($votes,$totalVotes) {
        $votes = isset($votes) ? $votes : 0;
        $totalVotes = isset($totalVotes) ? $totalVotes : 0;
        if ($totalVotes > 0) {
            $percent = round(($votes/$totalVotes)*100);
        }
        else  {
            $percent = 0;
        }
        return $percent;
    }
    
    public function voteLineWidth($votes,$totalVotes) {
        $votes = isset($votes) ? $votes : 0;
        $totalVotes = isset($totalVotes) ? $totalVotes : 0;
        if ($totalVotes > 0) {
            $width = round(($votes/$totalVotes)*100) * $this->_scale;
        }
        else {
            $width = 1;
        }
        return $width;
    }
}

?>