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
    public $title;
    
    
    public function __construct(PDO $db) {
        $this->_db = $db;
        $this->_posts = array();
    }
    
    public function getId() {
        return $this->id;
    }
    
    public function getForum() {
        return $this->forum;
    }
    
    public function getTitle() {
        return $this->title;
    }
    
    public function setTitle($title) {
        $this->title = $title;
    }
    public function setForum($forumId) {
        $this->forum = $forumId;
    }
    
    public function available() { //Niet zeker of dit nodig is
        return true;
    }
    
    
    //Gebruiker wegschrijven naar de database
    public function save() {
        if (!$this->available()) {
            return false;
        }
        else {
            $qry = $this->_db->prepare("INSERT INTO topics(forum,title) VALUES(:forum,:title);");
            $data = array(
                ':forum' => $this->forum,
                ':title' => $this->title
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
        
    public function getAllPosts() {
        $stmt = $this->_db->prepare("SELECT `id`FROM `posts` WHERE `topic`= ? ORDER BY `id` ASC;");
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
        
        if ($stmp->rowCount() == "1") {
            $row = $stmp->fetch(PDO::FETCH_ASSOC);
            $this->id = $row['id'];
            $this->forum = $row['forum'];
            $this->title = $row['title'];
            return true;
        }
        else {
            return false;
        }
    }
    
}

?>
