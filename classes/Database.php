<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Database
 *
 * @author Kaj
 */
class Database {
    private $_db;
    public function __construct() {
        $this->createDbConnection();
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
    public function getConnection() {
        return $this->_db;
    }
}

?>
