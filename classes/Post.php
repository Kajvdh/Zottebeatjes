<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Post
 *
 * @author Kaj
 */
class Post {
    private $_db;
    
    public $id;
    public $topic;
    public $author;
    public $postdate;
    public $is_new_topic;
    public $content;
    
    
    public function __construct(PDO $db) {
        $this->_db = $db;
    }
    
    public function getById($id) {
        $this->id = $id;
        $stmp = $this->_db->prepare("SELECT * FROM `posts` WHERE `id`= ?;");
        $stmp->execute(array($this->id));
        $row = $stmp->fetch(PDO::FETCH_ASSOC);
        
        $this->id = $row['id'];
        $this->topic = $row['topic'];
        $this->author = $row['author'];
        $this->postdate = $row['postdate'];
        $this->is_new_topic = $row['is_new_topic'];
        $this->content = $row['content'];
        
    }
}

?>
