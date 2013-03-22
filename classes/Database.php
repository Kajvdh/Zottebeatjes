<?php


/**
 * Description of Database
 *
 * @author Kaj
 */
class Database {
    private $_mysqlHost;
    private $_mysqlUser;
    private $_mysqlPass;
    private $_mysqlDbName;
    private $_db;
    
    public function __construct() {
        $config = new Config();
        $mysqlCredentials = $config->getMysqlCredentials();
        
        $this->_mysqlHost = $mysqlCredentials["host"];
        $this->_mysqlUser = $mysqlCredentials["user"];
        $this->_mysqlPass = $mysqlCredentials["pass"];
        $this->_mysqlDbName = $mysqlCredentials["db"];
        
        
        $this->_db = new PDO('mysql:host='.$this->_mysqlHost.';dbname='.$this->_mysqlDbName.';charset=utf8',
                $this->_mysqlUser,$this->_mysqlPass);
        
        $this->_db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $this->_db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        
    }
    
    public function test() {
        try {
            $this->_db->query('hi'); //foute query
        } catch (PDOException $ex) {
            echo "Er is een fout opgetreden!";
            //fout kan opgehaald worden met $ex->getMessage();
        }
    }
    
}

?>
