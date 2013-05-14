<?php

/**
 * Class: WebPoll
 * 
 * Bevat alle informatie van de polls die op de pollpagina getoond worden
 *
 * @author Kaj Van der Hallen
 * @author Michael Deboeure
 */

class WebPoll {
    private $_polls;    //Array van de objecten van de polls
    private $_db;       //PDO database object voor communicatie met de database
    
    /**
     * Default constructor
     * @param PDO $db: PDO database object voor communicatie met de database
     */
    public function __construct(PDO $db) {
        $this->_db = $db;
        $this->_polls = array(); //Array voor objecten van de polls declareren
    }
    
    /**
     * Alle polls ophalen
     * @return type: Array van alle poll objecten
     */
    public function getAllPolls() {
        $stmt = $this->_db->query("SELECT `id` FROM `polls`;");
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $this->pollIds = array();
        foreach($results as $i => $dataArr) {
            foreach($dataArr as $id) {
                $poll = new Poll($this->_db);       //Nieuw Poll object aanmaken
                $poll->getById($id);                //Poll ophalen op basis van ID
                array_push($this->_polls,$poll);    //Object van de poll toevoegen aan het objecten-array
            }
        }
        return $this->_polls;
    }
}

?>