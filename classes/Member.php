<?php

/**
 * Description of Member
 *
 * @author Kaj
 */
class Member {
    private $_username;
    private $_password;
    private $_email;
    private $_db;
    
    public function __construct() {
        
    }
    
    private function createDbConnection() {
        if ($this->_db) {
            return true;
        }
        else {
            
            $config = new Config();
            $mysqlCredentials = $config->getMysqlCredentials();
            $host = $mysqlCredentials['host'];
            $user = $mysqlCredentials['user'];
            $pass = $mysqlCredentials['pass'];
            $dbname = $mysqlCredentials['db'];
            
            try {
                $db = new PDO('mysql:host='.$host.';dbname='.$dbname.';charset=utf8', $user, $pass);
                $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
            }
            catch(PDOException $ex) { 
                //echo $ex->getMessage();
                return false;
            }
            $this->_db = $db;
            return true;
        }
    }
    
    //Controle of deze (nieuwe) gebruiker aangemaakt mag worden
    public function available() {
        
        $this->createDbConnection();
        
        $qry = $this->_db->prepare("SELECT * FROM `users` WHERE `username` = ? OR email = ?;");
        $qry->execute(array($this->_username,$this->_email));
  
        
        if ($qry->rowCount() > "0") {
            return false;
        }
        else {
            return true;
        }
    }
    
    //Controleer of deze gebruiker zijn gegevens juist zijn
    public function verify() {
        $this->createDbConnection();
        $qry = $this->_db->prepare("SELECT * FROM `users` WHERE `username`= ? AND `password` = ?;");
        $qry->execute(array($this->_username,$this->_password));
        
        if ($qry->rowCount() == "1") {
            return true;
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
            $qry = $this->_db->prepare("INSERT INTO users(username,email,password,registerdate,lastip,usergroup) VALUES (:username,:email,:password,NOW(),:lastip,:usergroup);");
            $data = array(
                ':username' => $this->_username,
                ':email' => $this->_email,
                ':password' => $this->_password,
                ':lastip' => $_SERVER['REMOTE_ADDR'],
                ':usergroup' => '1'            
            );
            $qry->execute($data);
            if ($qry->rowCount() > '0') {
                echo "Gelukt!";
                return true;
            }
            else {
                echo "Mislukt!";
                return false;
            }
        }
    }
    
    public function setUsername($username) {
        $this->_username = $username;
    }
    public function setPassword($password) {
        $this->_password = $password;
    }
    public function setEmail($email) {
        $this->_email = $email;
    }
    
    
}

?>
