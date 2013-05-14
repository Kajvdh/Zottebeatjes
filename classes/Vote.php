<?php

/**
 * Class: Vote
 * 
 * Bevat alle informatie van uitgevoerde stemmen (op polls)
 *
 * @author Kaj Van der Hallen
 * @author Michael Deboeure
 */

class Vote {
    private $_id;       //Uniek ID van de stem
    private $_poll;     //Het ID van de poll waar de stem toe behoort
    private $_answer;   //Het ID van het antwoord waarmee op de poll geantwoord is
    private $_member;   //Het ID van het Member die de stem heeft uitgevoerd
    private $_db;       //PDO database object voor communicatie met de database
    
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
        return $this->_poll;
    }
    public function getPoll() {
        return $this->_poll;
    }
    public function getAnswer() {
        return $this->_answer;
    }
    public function getMember() {
        return $this->_member;
    }
    
    /**
     * Setfuncties
     */
    public function setPoll($pollId) {
        $this->_poll = $pollId;
    }
    public function setAnswer($answerId) {
        $this->_answer = $answerId;
    }
    public function setMember($memberId) {
        $this->_member = $memberId;
    }
    
    /**
     * Stem ophalen op basis van het Member ID en het Poll ID
     * @return boolean: `true`: Als deze stem bestaat en is opgehaald
     */
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
    
    /**
     * Nieuwe stem opslaan
     * @return boolean: `true` wanneer het opslaan gelukt is
     */
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
    
    /**
     * Stem verwijderen
     * @param type $poll: Het ID van de poll waarvan de stem verwijdert moet worden
     * @param type $voter: Het ID van het Member waarvan de stem verwijdert moet worden
     */
    public function delete($poll,$voter) {
        $this->_poll = $poll;
        $this->voter = $voter;
        $qry = $this->_db->prepare("DELETE FROM `votes` WHERE `poll`=:poll AND `member`=:member;");
        $data = array(
                ':poll' => $this->_poll,
                ':member' => $this->voter,);
        $qry->execute($data);
    }
    
    /**
     * Het aantal stemmen ophalen met het opgegeven antwoord
     * @return type: Aantal stemmen met dit antwoord
     */
    public function getVotecountByAnswer() {
        $stmp = $this->_db->prepare("SELECT * FROM `votes` WHERE `answer`= ?;");
        $stmp->execute(array($this->_answer));
        return $stmp->rowCount();
    }
    /**
     * Het aantal stemmen op de opgegeven poll ophalen
     * @return type: Aantal stemmen op deze poll
     */
    public function getVotecountByPoll() {
        $stmp = $this->_db->prepare("SELECT * FROM `votes` WHERE `poll`= ?;");
        $stmp->execute(array($this->_poll));
        return $stmp->rowCount();
    }
}

?>