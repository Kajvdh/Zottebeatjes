<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Forum
 *
 * @author Kaj
 */
class Forum {
    private $_db;
    private $_topics;
    
    public $id;
    public $category;
    public $forumname;
    
    public function __construct(PDO $db) {
        $this->_db = $db;
        $this->_topics = array();
    }
    
    public function getId() {
        return $this->id;
    }
    
    public function getForumName() {
        return $this->forumname;
    }
    
    public function getAllTopics() {
        $stmt = $this->_db->prepare("SELECT `id`FROM `topics` WHERE `forum`= ?;");
        $stmt->execute(array($this->id));
        
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $this->categoryIds = array();
        foreach($results as $i => $dataArr) {
            foreach($dataArr as $id) {
                $topic = new Topic($this->_db);
                $topic->getById($id);
                array_push($this->_topics,$topic);
            }
        }
        return $this->_topics;
    }
    
    
    public function getById($id) {
        $this->id = $id;
        $stmp = $this->_db->prepare("SELECT * FROM `forums` WHERE `id`= ?;");
        $stmp->execute(array($this->id));
        $row = $stmp->fetch(PDO::FETCH_ASSOC);
        
        $this->id = $row['id'];
        $this->category = $row['category'];
        $this->forumname = $row['forumname'];
    }
    
    
}

?>
