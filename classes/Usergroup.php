<?php

/**
 * Class: Usergroup
 * 
 * Bevat alle informatie van een gebruikersgroep.
 * Deze klasse zorgt voor het uitlezen van de informatie van een bepaalde gebruikersgroep uit de database.
 * Alle rechten die een gebruikersgroep heeft worden in deze klasse beschreven.
 *
 * @author Kaj Van der Hallen
 * @author Michael Deboeure
 */

class Usergroup {
    private $_id;                   //Uniek ID      
    private $_groupname;            //Groepsnaam van de gebruikersgroep
    private $_can_login;            //Gebruikers kunnen inloggen
    private $_can_view_board;       //Gebruikers kunnen overzicht van categoriëen en fora zien
    private $_can_view_forum;       //Gebruikers kunnen de inhoud van een forum zien
    private $_can_view_topic;       //Gebruikers kunnen de inhoud van een topic zien
    private $_can_post_topic;       //Gebruikers kunnen een nieuw topic starten
    private $_can_post_reply;       //Gebruikers kunnen een reactie op een topic plaatsen
    private $_can_edit_owntopic;    //Gebruikers kunnen hun eigen topics bewerken
    private $_can_edit_ownreply;    //Gebruikers kunnen hun eigen reacties aanpassen
    private $_can_edit_topic;       //Gebruikers kunnen alle topics aanpassen
    private $_can_edit_reply;       //Gebruikers kunnen alle reacties op topics aanpassen
    private $_can_poll_vote;        //Gebruikers kunnen stemmen op een poll
    private $_can_set_avatar;       //Gebruikers kunnen een avatar instellen
    private $_can_set_signature;    //Gebruikers kunnen een signature instellen
    private $_is_admin;             //Gebruikers zijn administrators
    private $_db;                   //PDO Database object voor communicatie met de database
    
    /**
     * Default constructor
     * @param PDO $db: PDO object dat gebruikt wordt om te verbinden op database
     */
    public function __construct(PDO $db) {
        $this->_db = $db;
    }
    /**
     * Getfuncties
     * @return type: Geeft opgevraagde informatie terug
     */
    public function getId() {
        return $this->_id;
    }
    public function getGroupname() {
        return $this->_groupname;
    }
    public function canLogin() {
        return $this->_can_login;
    }
    public function canViewBoard() {
        return $this->_can_view_board;
    }
    public function canViewForum() {
        return $this->_can_view_forum;
    }
    public function canViewTopic() {
        return $this->_can_view_topic;
    }
    public function canPostTopic() {
        return $this->_can_post_topic;
    }
    public function canPostReply() {
        return $this->_can_post_reply;
    }
    public function canEditOwnTopic() {
        return $this->_can_edit_owntopic;
    }
    public function canEditOwnReply() {
        return $this->_can_edit_ownreply;
    }
    public function canEditTopic() {
        return $this->_can_edit_topic;
    }
    public function canEditReply() {
        return $this->_can_edit_reply;
    }
    public function canVote() {
        return $this->_can_poll_vote;
    }
    public function canSetAvatar() {
        return $this->_can_set_avatar;
    }
    public function canSetSignature() {
        return $this->_can_set_signature;
    }
    public function isAdmin() {
        return $this->_is_admin;
    }
   
    /**
     * De gebruikersgroep uit de database ophalen op basis van het ID
     * @param type $id: Het id van de gebruikersgroep die opgehaald moet worden
     * @return boolean: `true` als de gerbuikersgroep bestaat en is opgehaald
     */
    public function getById($id) {
        $stmp = $this->_db->prepare("SELECT * FROM `usergroups` WHERE `id` = ?;");
        $stmp->execute(array($id));
        if ($stmp->rowCount() == "1") {
            $row = $stmp->fetch(PDO::FETCH_ASSOC);
            $this->_id = $row['id'];
            $this->_groupname = $row['groupname'];
            $this->_can_login = $row['can_login'];
            $this->_can_view_board = $row['can_view_board'];
            $this->_can_view_forum = $row['can_view_forum'];
            $this->_can_view_topic = $row['can_view_topic'];
            $this->_can_post_topic = $row['can_post_topic'];
            $this->_can_post_reply = $row['can_post_reply'];
            $this->_can_edit_owntopic = $row['can_edit_owntopic'];
            $this->_can_edit_ownreply = $row['can_edit_ownreply'];
            $this->_can_edit_topic = $row['can_edit_topic'];
            $this->_can_edit_reply = $row['can_edit_reply'];
            $this->_can_poll_vote = $row['can_poll_vote'];
            $this->_can_set_avatar = $row['can_set_avatar'];
            $this->_can_set_signature = $row['can_set_signature'];
            $this->_is_admin = $row['is_admin'];
            return true;
        }
        else {
            return false;
        }
    }
}

?>