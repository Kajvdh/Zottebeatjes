<?php

/**
 * Class: Database
 * 
 * Deze klasse zorgt voor het opzetten van de verbinnding met de MySQL server
 *
 * @author Kaj Van der Hallen
 * @author Michael Deboeure
 */

class Database {
    private $_db;   //PDO Database object van de verbinding met de database
    
    /**
     * Default constructor
     */
    public function __construct() {
        $this->createDbConnection();
    }
    
    /**
     * PDO object ophalen
     */
    public function getConnection() {
        return $this->_db;
    }
    
    /**
     * Connectie met de database opzetten
     * @return boolean: `true` als de connectie is opgezet
     */
    private function createDbConnection() {
        if ($this->_db) {
            return true;
        }
        else {
            /**
             * Benodigde informatie van de MySQL server ophalen uit de Config klasse
             */
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
                return false;
            }
            $this->_db = $db;
            return true;
        }
    }
}

?>