<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Member
 *
 * @author Kaj
 */
class Member {
    private $_username;
    private $_password;
    private $_email;
    
    public function __construct() {
        
    }
    
    //Controle of deze (nieuwe) gebruiker aangemaakt mag worden
    public function validate() {
        return false;
    }
    //Gebruiker wegschrijven naar de database
    public function save() {
        
    }
    
}

?>
