<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Board
 *
 * @author Kaj
 */
class Board {
    private $_db;
    private $_categories;
    
    public function __construct(PDO $db) {
        $this->_db = $db;
        $this->_categories = array();
    }
    
    public function getAllCategories() {
        $stmt = $this->_db->query("SELECT `id`FROM `categories`;");
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $this->categoryIds = array();
        foreach($results as $i => $dataArr) {
            foreach($dataArr as $id) {
                $category = new Category($this->_db);
                $category->getById($id);
                array_push($this->_categories,$category);
            }
        }
        return $this->_categories;
    }
    
    public function getCategoryIds() {
        $return = array();
        foreach($this->_categories as $c) {
            array_push($return,$c->getId());
        }
        return $return;
    }
    
    
    
}

?>
