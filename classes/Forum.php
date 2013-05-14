<?php

/**
 * Class: Forum
 * 
 * Bevat alle informatie van een forum
 * Deze klasse zorgt voor het ophalen van de nodige informatie van een forum
 *
 * @author Kaj Van der Hallen
 * @author Michael Deboeure
 */

class Forum {
    private $_id;               //Uniek ID van het forum
    private $_forumname;        //Naam van het forum
    private $_order;            //Volgorde van het forum t.o.v. alle andere fora binnen dezelfde categorie
    private $_category;         //ID van de categorie waartoe dit forum behoort
    private $_topics;           //Array van objecten van alle topics die tot dit forum behoren
    private $_db;               //PDO database object voor communicatie met de database
    
    /**
     * Default constructor
     * @param PDO $db: PDO database object voor communicatie met de database
     */
    public function __construct(PDO $db) {
        $this->_db = $db;
        $this->_topics = array();
    }
    
    /**
     * Getfuncties
     */
    public function getId() {
        return $this->_id;
    }
    public function getForumName() {
        return $this->_forumname;
    }
    public function getOrder() {
        return $this->_order;
    }
    public function getCategory() {
        return $this->_category;
    }
    
    /**
     * Setfuncties
     */
    public function setForumName($forumname) {
        $this->_forumname = $forumname;
    }
    public function setOrder($order) {
        $this->_order = $order;
    }    
    public function setCategory($category) {
        $this->_category = $category;
    }
    
    /**
     * Alle topics die tot dit forum behoren ophalen
     * @return type: Array van alle topic objecten die tot dit forum behoren
     */
    public function getAllTopics() {
        $stmt = $this->_db->prepare("SELECT `id`FROM `topics` WHERE `forum`= ?;");
        $stmt->execute(array($this->_id));
        
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
    
    /**
     * Een forum uit de database ophalen op basis van het ID
     * @param type $id: Het ID van het forum dat opgehaald moet worden
     * @return boolean: `true` als het forum bestaat en is opgehaald
     */
    public function getById($id) {
        $this->_id = $id;
        $stmp = $this->_db->prepare("SELECT * FROM `forums` WHERE `id`= ?;");
        $stmp->execute(array($this->_id));
        
        if ($stmp->rowCount() == "1") {
            $row = $stmp->fetch(PDO::FETCH_ASSOC);
            $this->_id = $row['id'];
            $this->_category = $row['category'];
            $this->_forumname = $row['forumname'];
            $this->_order = $row['order'];
            return true;
        }
        else {
            return false;
        }
    }
    
    /**
     * Nieuw forum opslaan
     * @return boolean: `true` wanneer het opslaan gelukt is
     */
    public function save() {
        /**
         * Laatst `order` ophalen -> +1
         */
        $gid = $this->_db->prepare("SELECT MAX(`order`) FROM `forums`");
        $gid->execute();
        $this->_order = $gid->fetchColumn() +1;
        /**
         * Nieuw forum toevoegen
         */
        $qry = $this->_db->prepare("INSERT INTO forums(forumname,category,`order`) VALUES (:forumname,:category,:order);");
        $data = array(
            ':forumname' => $this->_forumname,
            ':category' => $this->_category,
            ':order' => $this->_order
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
    
    /**
     * Gegevens van het forum aanpassen in de database
     * @return boolean: `true` als het aanpassen is gelukt
     */
    public function update() {
        $qry = $this->_db->prepare("UPDATE forums SET category=?,forumname=?,`order`=? WHERE id=?");
        $qry->execute(array($this->_category,$this->_forumname,$this->_order,$this->_id));
        if ($qry->rowCount() > '0') {
            return true;
        }
        else {
            return false;
        }
    }
}

?>