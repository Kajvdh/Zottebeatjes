<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Topic
 *
 * @author Kaj
 */
class Topic {
    private $_db;
    private $_posts;
    
    public $id;
    public $forum;
    public $firstpost;
    public $title;
    
    
    public function __construct(PDO $db) {
        $this->_db = $db;
        $this->_posts = array();
    }
    
    public function getId() {
        return $this->id;
    }
    
    public function getTitle() {
        return $this->title;
    }
    
    
    public function getAllTopics() {
        $stmt = $this->_db->prepare("SELECT `id`FROM `posts` WHERE `topic`= ?;");
        $stmt->execute(array($this->id));
        
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $this->categoryIds = array();
        foreach($results as $i => $dataArr) {
            foreach($dataArr as $id) {
                $post = new Post($this->_db);
                $post->getById($id);
                array_push($this->_posts,$post);
            }
        }
        return $this->_posts;
    }
    
    public function getById($id) {
        $this->id = $id;
        $stmp = $this->_db->prepare("SELECT * FROM `topics` WHERE `id`= ?;");
        $stmp->execute(array($this->id));
        $row = $stmp->fetch(PDO::FETCH_ASSOC);
        
        $this->id = $row['id'];
        $this->forum = $row['forum'];
        $this->firstpost = $row['firstpost'];
        $this->title = $row['title'];
    }
    
}

?>
