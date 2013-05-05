<?php

/**
 * Description of Usergroup
 *
 * @author Kaj
 */
class Usergroup {
    private $_id;                   
    private $_groupname;            
    private $_can_login;            //Kan inloggen op het account
    private $_can_view_board;       //Kan overzicht van de categoriëen en forums zien
    private $_can_view_forum;       //Kan inhoud van een forum zien
    private $_can_view_topic;       //Kan de posts in een topic bekijken
    private $_can_post_topic;       //Kan een nieuw topic starten
    private $_can_post_reply;       //Kan een reactie op een bestaand topic plaatsen
    private $_can_edit_owntopic;    //Kan eigen reacties bewerken
    private $_can_edit_ownreply;    //Kan eigen topics bewerken
    private $_can_edit_topic;       //Kan alle reacties van iedereen bewerken
    private $_can_edit_reply;       //Kan alle topics van iedereen bewerken
    private $_can_poll_post;        //Kan een vote starten
    private $_can_poll_vote;        //Kan stemmen op een vote
    private $_can_set_avatar;       //Kan een avatar instellen
    private $_can_set_signature;    //Kan een onderschrift instellen
        
    private $_db;
    
    public function __construct(PDO $db) {
        $this->_db = $db;
    }
    
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
    public function canPostPoll() {
        return $this->_can_poll_post;
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
   
    
    //Gebruikersgroepsgegevens ophalen uit de database op basis van id
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
            $this->_can_poll_post = $row['can_poll_post'];
            $this->_can_poll_vote = $row['can_poll_vote'];
            $this->_can_set_avatar = $row['can_set_avatar'];
            $this->_can_set_signature = $row['can_set_signature'];
            return true;
        }
        else {
            return false;
        }
    }
}

?>
