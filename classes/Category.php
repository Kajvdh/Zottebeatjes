<?php

/**
 * Class: Category
 * 
 * Bevat alle informatie van een categorie
 * Deze klasse zorgt voor het ophalen van de nodige informatie van een categorie
 *
 * @author Kaj Van der Hallen
 * @author Michael Deboeure
 */

class Category {
    private $_id;               //Uniek ID
    private $_categoryname;     //Naam van de categorie
    private $_order;            //Volgorde van de categorie t.o.v. alle andere categoriëen
    private $_forums;           //Array van objecten van alle forums die tot deze categorie behoren
    private $_db;               //PDO database object voor communicatie met de database
    
    /**
     * Default constructor
     * @param PDO $db: PDO Database object voor cummunicatie met de database
     */
    public function __construct(PDO $db) {
        $this->_db = $db;
        $this->_forums = array();   //Array voor de objecten van onderliggende fora declareren
    }
    
    /**
     * Getfuncties
     */
    public function getId() {
        return $this->_id;
    }
    public function getCategoryname() {
        return $this->_categoryname;
    }
    public function getOrder() {
        return $this->_order;
    }
    
    /**
     * Setfuncties
     */
    public function setCategoryname($categoryname) {
        $this->_categoryname = $categoryname;
    }
    public function setOrder($order) {
        $this->_order = $order;
    }
    
    /**
     * Alle forums die tot deze categorie behoren ophalen
     * @return type: Array van alle forum objecten die tot deze categorie behoren
     */
    public function getAllForums() {
        $stmt = $this->_db->prepare("SELECT `id` FROM `forums` WHERE `category`= ? ORDER BY `order`;");
        $stmt->execute(array($this->_id));
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $this->categoryIds = array();
        foreach($results as $i => $dataArr) {
            foreach($dataArr as $id) {
                $forum = new Forum($this->_db);     //Nieuw forum object aanmaken
                    $forum->getById($id);           //Forum ophalen op basis van ID
                array_push($this->_forums,$forum);  //Object van dit forum toevoegen aan het array
            }
        }
        return $this->_forums;
    }
    
    /**
     * Een categorie uit de database ophalen op basis van het ID
     * @param type $id: Het ID van de categorie die opgehaald moet worden
     * @return boolean: `true` als de categorie bestaat en is opgehaald
     */
    public function getById($id) {
        $this->_id = $id;
        $stmp = $this->_db->prepare("SELECT * FROM `categories` WHERE `id`= ?;");
        $stmp->execute(array($this->_id));
        if ($stmp->rowCount() == "1") {
            $row = $stmp->fetch(PDO::FETCH_ASSOC);
            $this->_id = $row['id'];
            $this->_categoryname = $row['categoryname'];
            $this->_order = $row['order'];
            return true;
        }
        else {
            return false;
        }
    }
    
    /**
     * Nieuwe categorie opslaan
     * @return boolean: `true` wanneer het opslaan gelukt is
     */
    public function save() {
        /**
         * Laatst `order` ophalen -> +1
         */
        $gid = $this->_db->prepare("SELECT MAX(`order`) FROM `categories`");
        $gid->execute();
        $this->_order = $gid->fetchColumn() +1;
        /**
         * Nieuwe categorie toevoegen
         */
        $qry = $this->_db->prepare("INSERT INTO categories(categoryname,`order`) VALUES (:categoryname,:order);");
        $data = array(
            ':categoryname' => $this->_categoryname,
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
     * Gegevens van de categorie aanpassen in de database
     * @return boolean: `true` als het aanpassen is gelukt
     */
    public function update() {
        $qry = $this->_db->prepare("UPDATE `categories` SET `categoryname`=?,`order`=? WHERE `id`=?");
        $qry->execute(array($this->_categoryname,$this->_order,$this->_id));
        if ($qry->rowCount() > '0') {
            return true;
        }
        else {
            return false;
        }
    }
}

?>