<?php

/**
 * Class: Login
 * 
 * Bevat alle informatie van de sessie waarmee de gebruiker is ingelogd
 *
 * @author Kaj Van der Hallen
 * @author Michael Deboeure
 */

class Login {
    
        /**
         * Default constructor
         */
        public function __construct() {
            
        }
        
        /**
         * Sessie uitlezen
         * @return boolean: 'true' als de gebruiker ingelogd is
         */
        public function getSession() {
            if (isset($_SESSION['login'])) { return $_SESSION['login']; }
            else { return false; }
        }
        
        /**
         * Nieuwe sessie starten
         * @param type $uid: Het ID van de gebruiker waarvoor de sessie opgestart moet worden
         */
        public function setSession($uid) {
            $_SESSION['login'] = $uid;
        }
    }

?>