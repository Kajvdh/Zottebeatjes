<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Forum
 *
 * @author Kaj
 */
class Forum {
    private $_db;
    private $_topics;
    
    public $id;
    public $category;
    public $forumname;
    public $order;
    
    public function __construct(PDO $db) {
        $this->_db = $db;
        $this->_topics = array();
    }
    
    public function getId() {
        return $this->id;
    }
    
    public function getForumName() {
        return $this->forumname;
    }
    public function setForumName($forumname) {
        $this->forumname = $forumname;
    }
    public function getCategory() {
        return $this->category;
    }
    public function setCategory($category) {
        $this->category = $category;
    }
    public function getOrder() {
        return $this->order;
    }
    public function setOrder($order) {
        $this->order = $order;
    }
    
    
    public function save() {
        $gid = $this->_db->prepare("SELECT MAX(`order`) FROM forums");
        $gid->execute();
        $this->order = $gid->fetchColumn() +1;
        
        $qry = $this->_db->prepare("INSERT INTO forums(forumname,category,`order`) VALUES (:forumname,:category,:order);");
        $data = array(
            ':forumname' => $this->forumname,
            ':category' => $this->category,
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
        $qry = $this->_db->prepare("UPDATE forums SET category=?,forumname=?,`order`=? WHERE id=?");
        $qry->execute(array($this->category,$this->forumname,$this->order,$this->id));
        if ($qry->rowCount() > '0') {
            return true;
        }
        else {
            return false;
        }
    }
    
    public function getAllTopics() {
        $stmt = $this->_db->prepare("SELECT `id`FROM `topics` WHERE `forum`= ?;");
        $stmt->execute(array($this->id));
        
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
    
    public function getById($id) {
        $this->id = $id;
        $stmp = $this->_db->prepare("SELECT * FROM `forums` WHERE `id`= ?;");
        $stmp->execute(array($this->id));
        
        if ($stmp->rowCount() == "1") {
            $row = $stmp->fetch(PDO::FETCH_ASSOC);
            $this->id = $row['id'];
            $this->category = $row['category'];
            $this->forumname = $row['forumname'];
            $this->order = $row['order'];
            return true;
        }
        else {
            return false;
        }
    }
    
    
}

?>
