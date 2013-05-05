<?php

/**
 * Description of Member
 *
 * @author Kaj
 */
class Member {
    private $_id;
    private $_username;
    private $_email;
    private $_password;
    private $_avatar;
    private $_signature;
    private $_posts;
    private $_registerdate;
    private $_lastlogin;
    private $_lastip;
    private $_usergroup;
    private $_verificationcode;
    
    private $_db;
    
    public function __construct(PDO $db) {
        $this->_db = $db;
        $this->_avatar = "";
        $this->_signature = "";
        $this->_posts = "0";
        $this->_usergroup = "1";
    }
    
    public function getId() {
        return $this->_id;
    }
    public function getUsername() {
        return $this->_username;
    }
    public function setUsername($username) {
        $this->_username = $username;
    }
    public function getEmail() {
        return $this->_email;
    }
    public function setEmail($email) {
        $this->_email = $email;
    }
    public function getPassword() {
        return $this->_password;
    }
    public function setPassword($password) {
        $this->_password = $password;
    }
    public function getAvatar() {
        return $this->_avatar;
    }
    public function setAvatar($avatar) {
        $this->_avatar = $avatar;
    }
    public function getSignature() {
        return $this->_signature;
    }
    public function setSignature($signature) {
        $this->_signature = $signature;
    }
    public function getPosts() {
        return $this->_posts;
    }
    public function setPosts($posts) {
        $this->_posts = $posts;
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
    public function setUsergroup($usergroup) {
        $this->_usergroup = $usergroup;
    }
    public function getVerificationcode() {
        return $this->_verificationcode;
    }
    public function setVerificationcode($verificationcode) {
        $this->_verificationcode = $verificationcode;
    }
    public function getPermissions() {
        $usergroup = new Usergroup($this->_db);
        $usergroup->getById($this->_usergroup);
        return $usergroup;
    }
    
    //Controle of deze (nieuwe) gebruiker aangemaakt mag worden
    public function available() {
        
        $qry = $this->_db->prepare("SELECT * FROM `users` WHERE `username` = ? OR email = ?;");
        $qry->execute(array($this->_username,$this->_email));
  
        
        if ($qry->rowCount() > "0") {
            return false;
        }
        else {
            return true;
        }
    }
    
    public function incPosts() {
        $stmp = $this->_db->prepare("UPDATE users SET `posts` = `posts` + 1 WHERE id=?");
        $stmp->execute(array($this->_id));
        if ($stmp->rowCount() > '0') {
            return true;
        }
        else {
            return false;
        }
    }
    
    //Gebruikersgegevens ophalen uit de database op basis van id
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
    
    //Controleer of deze gebruiker zijn gegevens juist zijn
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
    
    //Gebruiker wegschrijven naar de database
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
    
    public function activate() {
        $qry = $this->_db->prepare("UPDATE users SET usergroup=? WHERE id=?");
        $qry->execute(array("2",$this->_id));
        if ($qry->rowCount() > '0') {
            return true;
        }
        else {
            return false;
        }
    }
    public function updateAvatar() {
        $qry = $this->_db->prepare("UPDATE users SET avatar=? WHERE id=?");
        $qry->execute(array($this->_avatar,$this->_id));
        if ($qry->rowCount() > '0') {
            return true;
        }
        else {
            return false;
        }
    }
    public function updateSignature() {
        $qry = $this->_db->prepare("UPDATE users SET signature=? WHERE id=?");
        $qry->execute(array($this->_signature,$this->_id));
        if ($qry->rowCount() > '0') {
            return true;
        }
        else {
            return false;
        }
    }
    
    
    public function setLastloginNow() {
        $qry = $this->_db->prepare("UPDATE users SET lastlogin=NOW() WHERE id=?");
        $qry->execute(array($this->_id));
        if ($qry->rowCount() > '0') {
            return true;
        }
        else {
            return false;
        }
    }
    
    
    
    public function setLastIp($ip) {
        $qry = $this->_db->prepare("UPDATE users SET lastip=? WHERE id=?");
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
