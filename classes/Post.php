<?php

/**
 * Class: Post
 * 
 * Bevat alle informatie van een post
 * Deze klasse zorgt voor het ophalen van de nodige informatie van een post
 *
 * @author Kaj Van der Hallen
 * @author Michael Deboeure
 */

class Post {
    public $_id;        //Uniek ID van de post
    public $_author;    //ID van de het Member dat deze post geplaatst heeft
    public $_postdate;  //Datum en tijd van wanneer de post geplaatst is
    public $_topic;     //ID van het topic waar de post geplaatst is
    public $_content;   //Inhoud van de post
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
        return $this->_id;
    }
    public function getAuthor() {
        return $this->_author;
    }
    public function getPostdate() {
        return $this->_postdate;
    }
    public function getTopic() {
        return $this->_topic;
    }
    public function getContent() {
        return $this->_content;
    }
    
    /**
     * Setfuncties
     */
    public function setAuthor($author) {
        $this->_author = $author;
    }
    public function setTopic($topicId) {
        $this->_topic = $topicId;
    }
    public function setContent($content) {
        $this->_content = $content;
    }
    
    /**
     * Een post uit de database ophalen op basis van het ID
     * @param type $id: Het ID van de post die opgehaald moet worden
     * @return boolean: `true` als de post bestaat en is opgehaald
     */
    public function getById($id) {
        $this->_id = $id;
        $stmp = $this->_db->prepare("SELECT * FROM `posts` WHERE `id`= ?;");
        $stmp->execute(array($this->_id));
        if ($stmp->rowCount() > '0') {
            $row = $stmp->fetch(PDO::FETCH_ASSOC);
            $this->_id = $row['id'];
            $this->_topic = $row['topic'];
            $this->_author = $row['author'];
            $this->_postdate = $row['postdate'];
            $this->is_new_topic = $row['is_new_topic'];
            $this->_content = strip_tags($row['content']);
            return true;
        }
        else {
            return false;
        }
    }
    
    /**
     * Nieuwe post opslaan
     * @return boolean: `true` wanneer het opslaan gelukt is
     */
    public function save() {
        $qry = $this->_db->prepare("INSERT INTO posts(topic,author,postdate,content) VALUES(:topic,:author,NOW(),:content);");
        $data = array(
            ':topic' => $this->_topic,
            ':author' => $this->_author,
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
}

?>