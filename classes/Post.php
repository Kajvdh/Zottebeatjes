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
    
    public function setTopic($topicId) {
        $this->topic = $topicId;
    }
    public function setAuthor($author) {
        $this->author = $author;
    }
    public function setIsNewTopic($is_new_topic) {
        $this->is_new_topic = $is_new_topic;
    }
    public function setContent($content) {
        $this->content = $content;
    }
    
    public function getId() {
        return $this->id;
    }
    public function getAuthor() {
        return $this->author;
    }
    public function getPostdate() {
        return $this->postdate;
    }
    public function getIsNewTopic() {
        return $this->is_new_topic;
    }
    public function getContent() {
        return $this->content;
    }
    public function getTopic() {
        return $this->topic;
    }
    
    public function available() {
        return true;
    }
    
    public function save() {
        if (!$this->available()) {
            return false;
        }
        else {
            $qry = $this->_db->prepare("INSERT INTO posts(topic,author,postdate,is_new_topic,content) VALUES(:topic,:author,NOW(),:is_new_topic,:content);");
            $data = array(
                ':topic' => $this->topic,
                ':author' => $this->author,
                ':is_new_topic' => $this->is_new_topic,
                ':content' => $this->content
            );
            
            $qry->execute($data);
            if ($qry->rowCount() > '0') {
                return true;
            }
            else {
                return false;
            }
        }
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
        $this->content = nl2br($row['content']);
    }
}

?>
