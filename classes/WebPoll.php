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
    private $_db;
    private $_polls;
    
    public function __construct(PDO $db) {
        $this->_db = $db;
        $this->_polls = array();
    }
    
    public function getAllPolls() {
        $stmt = $this->_db->query("SELECT `id`FROM `polls`;");
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $this->pollIds = array();
        foreach($results as $i => $dataArr) {
            foreach($dataArr as $id) {
                $poll = new Poll($this->_db);
                $poll->getById($id);
                array_push($this->_polls,$poll);
            }
        }
        return $this->_polls;
    }
    
}

?>
