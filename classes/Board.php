<?php

/**
 * Class: Board
 * 
 * Bevat alle informatie van het Board (Verzameling van de categoriëen)
 * Deze klasse zorgt voor het ophalen van de nodige informatie van het Board
 *
 * @author Kaj Van der Hallen
 * @author Michael Deboeure
 */

class Board {
    private $_categories;       //Array van objecten van de beschikbare categoriëen
    private $_db;               //PDO Database object voor communicatie met de database
    
    /**
     * Default constructor
     * @param PDO $db: PDO Database object voor communicatie met de database
     */
    public function __construct(PDO $db) {
        $this->_db = $db;
        $this->_categories = array();   //categories als array declareren
    }
    
    /**
     * Alle categoriëen ophalen
     * @return type: Array van de objecten van alle categoriëen
     */
    public function getAllCategories() {
        $stmt = $this->_db->query("SELECT `id` FROM `categories` ORDER BY `order`;");
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $this->categoryIds = array();
        foreach($results as $i => $dataArr) {
            foreach($dataArr as $id) {
                $category = new Category($this->_db);       //Nieuw categorie object aanmaken
                $category->getById($id);                    //Informatie van deze categorie ophalen
                array_push($this->_categories,$category);   //Object opslaan in array
            }
        }
        return $this->_categories;
    }
}

?>