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
    public $order;
    
    private $_forums;
    
    public function __construct(PDO $db) {
        $this->_db = $db;
        $this->_forums = array();
    }
    
    public function getId() {
        return $this->id;
    }
    
    public function getCategoryname() {
        return $this->categoryname;
    }
    public function setCategoryname($categoryname) {
        $this->categoryname = $categoryname;
    }
    
    public function getOrder() {
        return $this->order;
    }
    public function setOrder($order) {
        $this->order = $order;
    }
    
    
    
    public function save() {
        $gid = $this->_db->prepare("SELECT MAX(`order`) FROM categories");
        $gid->execute();
        $this->order = $gid->fetchColumn() +1;
        
        $qry = $this->_db->prepare("INSERT INTO categories(categoryname,`order`) VALUES (:categoryname,:order);");
        $data = array(
            ':categoryname' => $this->categoryname,
            ':order' => $this->order
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
    
    
    
    public function update() {
        $qry = $this->_db->prepare("UPDATE categories SET categoryname=?,`order`=? WHERE id=?");
        $qry->execute(array($this->categoryname,$this->order,$this->id));
        if ($qry->rowCount() > '0') {
            return true;
        }
        else {
            return false;
        }
    }
    
    public function getAllForums() {
        $stmt = $this->_db->prepare("SELECT `id` FROM `forums` WHERE `category`= ? ORDER BY `order`;");
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
        return $this->_forums;
    }
    
    
    public function getById($id) {
        $this->id = $id;
        $stmp = $this->_db->prepare("SELECT * FROM `categories` WHERE `id`= ?;");
        $stmp->execute(array($this->id));
        
        if ($stmp->rowCount() == "1") {
            $row = $stmp->fetch(PDO::FETCH_ASSOC);
            $this->id = $row['id'];
            $this->categoryname = $row['categoryname'];
            $this->order = $row['order'];
            return true;
        }
        else {
            return false;
        }
    }
}

?>
