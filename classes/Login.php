<?php


/**
 * Description of Login
 *
 * @author Kaj
 */
class Login {
        public function __construct() {
            
        }
        public function getSession() {
            if (isset($_SESSION['login'])) { return $_SESSION['login']; }
            else { return false; }
        }
        public function setSession($username) {
            $_SESSION['login'] = $username;
        }
    }

?>
