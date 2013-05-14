<?php

/**
 * Class: Member
 * 
 * Bevat alle informatie van een gebruikersaccount.
 * Het uitlezen en wegschrijven van de nodige gegevens gebeurt in deze klasse.
 * Alle benodigde logica om de nodige informatie op te bouwen van wat een gebruiker kan wordt in deze klasse beschreven.
 *
 * @author Kaj Van der Hallen
 * @author Michael Deboeure
 */

class Member {
    private $_id;                   //Uniek ID
    private $_username;             //Gebruikersnaam
    private $_email;                //Emailadres
    private $_password;             //MD5 geëncrypteerd passwoord
    private $_avatar;               //URL naar de avatar
    private $_signature;            //Signature
    private $_posts;                //Aantal posts
    private $_registerdate;         //Datum van registratie
    private $_lastlogin;            //Datum van laast ingelogd
    private $_lastip;               //Laatst gebruikte IP adres
    private $_usergroup;            //ID van de gebruikersgroep waartoe de gebruiker behoord
    private $_verificationcode;     //Unieke verificatie code voor activatie account
    private $_db;                   //PDO Database object
    
    /**
     * Default constructor
     * @param PDO $db: PDO object dat gebruikt wordt om te verbinden op database
     */
    public function __construct(PDO $db) {
        $this->_db = $db;
        $this->_avatar = "";
        $this->_signature = "";
        $this->_posts = "0";
        $this->_usergroup = "1";
    }
    
    /**
     * Getfuncties
     * @return type: Geeft opgevraagde informatie terug
     */
    public function getId() {
        return $this->_id;
    }
    public function getUsername() {
        return $this->_username;
    }
    public function getEmail() {
        return $this->_email;
    }
    public function getPassword() {
        return $this->_password;
    }
    public function getAvatar() {
        return $this->_avatar;
    }
    public function getSignature() {
        return $this->_signature;
    }
    public function getPosts() {
        return $this->_posts;
    }
    public function getRegisterdate() {
        return $this->_registerdate;
    }
    public function getLastlogin() {
        return $this->_lastlogin;
    }
    public function getLastip() {
        return $this->_lastip;
    }
    public function getUsergroup() {
        return $this->_usergroup;
    }
    public function getVerificationcode() {
        return $this->_verificationcode;
    }
    
    /**
     * Setfuncties
     */
    public function setUsername($username) {
        $this->_username = $username;
    }
    public function setEmail($email) {
        $this->_email = $email;
    }
    public function setPassword($password) {
        $this->_password = $password;
    }
    public function setAvatar($avatar) {
        $this->_avatar = $avatar;
    }
    public function setSignature($signature) {
        $this->_signature = $signature;
    }
    public function setPosts($posts) {
        $this->_posts = $posts;
    }
    public function setUsergroup($usergroup) {
        $this->_usergroup = $usergroup;
    }
    public function setVerificationcode($verificationcode) {
        $this->_verificationcode = $verificationcode;
    }
    public function getPermissions() {
        $usergroup = new Usergroup($this->_db);
        $usergroup->getById($this->_usergroup);
        return $usergroup;
    }
    public function isGuest($isguest) {
        if ($isguest) {
            $this->_usergroup = "5";
        }
    }
    
    /**
     * Gebruikersgegevens van het account ophalen
     * @param type $id: Het id van het gebruikersaccount dat opgehaald moet worden
     * @return boolean: `true` wanneer er een account met opgegeven ID bestaat
     */
    public function getById($id) {
        $stmp = $this->_db->prepare("SELECT * FROM `users` WHERE `id` = ?;");
        $stmp->execute(array($id));
        if ($stmp->rowCount() == "1") {
            $row = $stmp->fetch(PDO::FETCH_ASSOC);
            $this->_id = $row['id'];
            $this->_username = $row['username'];
            $this->_email = $row['email'];
            $this->_password = $row['password'];
            $this->_avatar = $row['avatar'];
            $this->_signature = $row['signature'];
            $this->_posts = $row['posts'];
            $this->_registerdate = $row['registerdate'];
            $this->_lastlogin = $row['lastlogin'];
            $this->_lastip = $row['lastip'];
            $this->_usergroup = $row['usergroup'];
            $this->_verificationcode = $row['verificationcode'];
            return true;
        }
        else {
            return false;
        }
    }
    
    /**
     * Gebruiker opslaan in de database
     * @return boolean: `true` als het opslaan is gelukt
     */
    public function save() {
        if (!$this->available()) {
            return false;
        }
        else {
            $qry = $this->_db->prepare("INSERT INTO users(username,email,password,avatar,posts,signature,registerdate,lastip,usergroup,verificationcode) VALUES (:username,:email,:password,:avatar,:posts,:signature,NOW(),:lastip,:usergroup,:verificationcode);");
            $data = array(
                ':username' => $this->_username,
                ':email' => $this->_email,
                ':password' => $this->_password,
                ':avatar' => $this->_avatar,
                ':posts' => $this->_posts,
                ':signature' => $this->_signature,
                ':lastip' => $_SERVER['REMOTE_ADDR'],
                ':usergroup' => $this->_usergroup,
                ':verificationcode' => $this->_verificationcode
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
    
    /**
     * Controleren of de opgegeven gegevens voor deze gebruiker juist zijn
     * @return boolean: `true` als de opgegeven gegevens correct zijn
     */
    public function verify() {
        $stmp = $this->_db->prepare("SELECT `id` FROM `users` WHERE `username`= ? AND `password` = ?;");
        $stmp->execute(array($this->_username,$this->_password));
        
        if ($stmp->rowCount() == "1") {
            $row = $stmp->fetch(PDO::FETCH_ASSOC);
            $this->_id = $row['id'];
            return $this->_id;
        }
        else {
            return false;
        }
    }
    
    /**
     * Controleren of de opgegeven gegevens nog beschikbaar zijn om een nieuw account mee aan te maken
     * @return boolean: `true` als de gegevens nog niet in gebruik zijn door een ander account
     */
    public function available() {
        $qry = $this->_db->prepare("SELECT * FROM `users` WHERE `username` = ? OR `email` = ?;");
        $qry->execute(array($this->_username,$this->_email));
        if ($qry->rowCount() > "0") {
            return false;
        }
        else {
            return true;
        }
    }
    
    /**
     * Het gebruikersaccount activeren
     * @return boolean: `true` als het activeren is gelukt
     */
    public function activate() {
        $qry = $this->_db->prepare("UPDATE `users` SET `usergroup`=? WHERE `id`=?");
        $qry->execute(array("2",$this->_id));
        if ($qry->rowCount() > '0') {
            return true;
        }
        else {
            return false;
        }
    }
    
    /**
     * Het aantal posts van deze gebruiker incrementeren
     * @return boolean: `true` als postcount incrementeren gelukt is
     */
    public function incPosts() {
        $stmp = $this->_db->prepare("UPDATE `users` SET `posts` = `posts` + 1 WHERE `id` = ?");
        $stmp->execute(array($this->_id));
        if ($stmp->rowCount() > '0') {
            return true;
        }
        else {
            return false;
        }
    }
    
    /**
     * De avatar van de gebruiker aanpassen
     * @return boolean: `true` als het aanpassen van de avatar is gelukt
     */
    public function updateAvatar() {
        $qry = $this->_db->prepare("UPDATE `users` SET `avatar`=? WHERE `id`=?");
        $qry->execute(array($this->_avatar,$this->_id));
        if ($qry->rowCount() > '0') {
            return true;
        }
        else {
            return false;
        }
    }
    
    /**
     * De signature van de gebruiker aanpassen
     * @return boolean: `true` als het aanpassen van de signature gelukt is
     */
    public function updateSignature() {
        $qry = $this->_db->prepare("UPDATE `users` SET `signature`=? WHERE `id`=?");
        $qry->execute(array($this->_signature,$this->_id));
        if ($qry->rowCount() > '0') {
            return true;
        }
        else {
            return false;
        }
    }
    
    /**
     * De datum wanneer de gebruiker het laatst ingelogd is updaten naar huidig tijdstip
     * @return boolean: `true` als het updaten gelukt is
     */
    public function setLastloginNow() {
        $qry = $this->_db->prepare("UPDATE `users` SET `lastlogin`=NOW() WHERE `id`=?");
        $qry->execute(array($this->_id));
        if ($qry->rowCount() > '0') {
            return true;
        }
        else {
            return false;
        }
    }
    
    /**
     * Het IP adres vanaf waar het account het laatste is aangemeld updaten
     * @param type $ip: Het IP adres dat opgeslagen moet worden
     * @return boolean: `true` als het opslaan gelukt is
     */
    public function setLastIp($ip) {
        $qry = $this->_db->prepare("UPDATE `users` SET `lastip`=? WHERE `id`=?");
        $qry->execute(array($ip,$this->_id));
        if ($qry->rowCount() > '0') {
            return true;
        }
        else {
            return false;
        }
    }
}

?>