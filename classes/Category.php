<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Category
 *
 * @author Kaj
 */
class Category {
    private $_db;
    
    public $id;
    public $categoryname;
    
    private $_forums;
    
    public function __construct(PDO $db) {
        $this->_db = $db;
        $this->_forums = array();
    }
    
    public function getAllForums() {
        $stmt = $this->_db->prepare("SELECT `id`FROM `forums` WHERE `category`= ?;");
        $stmt->execute(array($this->id));
        
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $this->categoryIds = array();
        foreach($results as $i => $dataArr) {
            foreach($dataArr as $id) {
                $forum = new Forum($this->_db);
                $forum->getById($id);
                array_push($this->_forums,$forum);
            }
        }
    }
    
    
    
    public function getById($id) {
        $this->id = $id;
        $stmp = $this->_db->prepare("SELECT * FROM `categories` WHERE `id`= ?;");
        $stmp->execute(array($this->id));
        $row = $stmp->fetch(PDO::FETCH_ASSOC);
        
        $this->id = $row['id'];
        $this->categoryname = $row['categoryname'];
    }
    public function getId() {
        return $this->id;
    }
}

?>
