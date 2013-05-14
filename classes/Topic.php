<?php

/**
 * Class: Topic
 * 
 * Bevat alle informatie van een topic
 * Deze klasse zorgt voor het ophalen van de nodige informatie van een topic
 *
 * @author Kaj Van der Hallen
 * @author Michael Deboeure
 */

class Topic {
    private $_id;       //Uniek ID van het topic
    private $_title;    //Titel van het toic
    private $_forum;    //ID van het forum waar dit topic toe behoort
    private $_posts;    //Array van objecten van alle posts die tot dit topic behoren
    private $_db;       //PDO database object voor communicatie met de database
    
    /**
     * Default constructor
     * @param PDO $db: PDO database object voor communicatie met de database
     */
    public function __construct(PDO $db) {
        $this->_db = $db;
        $this->_posts = array();
    }
    
    /**
     * Getfuncties
     */
    public function getId() {
        return $this->_id;
    }
    public function getTitle() {
        return $this->_title;
    }
    public function getForum() {
        return $this->_forum;
    }
    
    /**
     * Setfuncties
     */
    public function setTitle($title) {
        $this->_title = $title;
    }
    public function setForum($forumId) {
        $this->_forum = $forumId;
    }
    
    /**
     * Alle posts die tot dit topic behoren ophalen
     * @return type: Array van alle post objecten die tot dit topic behoren
     */
    public function getAllPosts() {
        $stmt = $this->_db->prepare("SELECT `id` FROM `posts` WHERE `topic`= ? ORDER BY `id` ASC;");
        $stmt->execute(array($this->_id));
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
    
    /**
     * Een topic uit de database ophalen op basis van het ID
     * @param type $id: Het ID van het topic dat opgehaald moet worden
     * @return boolean: `true` als het topic bestaat en is opgehaald
     */
    public function getById($id) {
        $this->_id = $id;
        $stmp = $this->_db->prepare("SELECT * FROM `topics` WHERE `id`= ?;");
        $stmp->execute(array($this->_id));
        
        if ($stmp->rowCount() == "1") {
            $row = $stmp->fetch(PDO::FETCH_ASSOC);
            $this->_id = $row['id'];
            $this->_forum = $row['forum'];
            $this->_title = $row['title'];
            return true;
        }
        else {
            return false;
        }
    }
    
    /**
     * Nieuw topic opslaan
     * @return boolean: `true` wanneer het opslaan gelukt is
     */
    public function save() {
        $qry = $this->_db->prepare("INSERT INTO topics(forum,title) VALUES(:forum,:title);");
        $data = array(
            ':forum' => $this->_forum,
            ':title' => $this->_title
        );

        $qry->execute($data);
        if ($qry->rowCount() > '0') {
            $this->_id = $this->_db->lastInsertId('id');
            return true;
        }
        else {
            return false;
        }
    }
}

?>