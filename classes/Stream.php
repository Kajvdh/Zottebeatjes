<?php

/**
 * Class: Stream
 * 
 * Bevat alle informatie van de stream
 * Zorgt voor het uitlezen van informatie van de stream
 *
 * @author Kaj Van der Hallen
 * @author Michael Deboeure
 */

class Stream {
    private $_url;                  //URL naar de XML data informatieweergave van de stream
    private $_currentlisteners;     //Het aantal luisteraars
    private $_peaklisteners;        //Het record aantal luisteraars sinds dat de stream online is
    private $_maxlisteners;         //Het maximum aantal luisteraars
    private $_uniquelisteners;      //Het aantal unieke luisteraars (op basis van IP-adres)
    private $_averagetime;          //De gemiddelde luister-tijd van de luisteraars
    private $_servergenre;          //Het muziekgenre, meegegeven door de server
    private $_serverurl;            //Server url (meestal link naar de broadcast software)
    private $_servertitle;          //Server titel (Naam van de DJ)
    private $_songtitle;            //Titel van het liedje dat wordt afgespeeld
    private $_streamstatus;         //Streamstatus `1`:Online `0`:Offline
    private $_streamhits;           //Streamhits
    private $_bitrate;              //Bitrate van de muziek
    
    /**
     * Default constructor
     * @param type $url: URL naar de XML data informatieweergave van de stream
     */
    public function __construct($url) {
        $this->_url = $url;
    }
    
    /**
     * Getfuncties
     */
    public function getCurrentListeners() {
        return $this->_currentlisteners;
    }
    public function getPeakListeners() {
        return $this->_peaklisteners;
    }
    public function getMaxListeners() {
        return $this->_maxlisteners;
    }
    public function getUniqueListeners() {
        return $this->_uniquelisteners;
    }
    public function getAverageTime() {
        return $this->_averagetime;
    }
    public function getServerGenre() {
        return $this->_servergenre;
    }
    public function getServerUrl() {
        return $this->_serverurl;
    }
    public function getServerTitle() {
        return $this->_servertitle;
    }
    public function getSongTitle() {
        return $this->_songtitle;
    }
    public function getStreamStatus() {
        return $this->_streamstatus;
    }
    public function getStreamHits() {
        return $this->_streamhits;
    }
    public function getBitRate() {
        return $this->_bitrate;
    }
    
    /**
     * Controleren of de stream online is
     * @return boolean: `true` als de stream online is
     */
    public function isOnline() {
        if ((@simplexml_load_file($this->_url) === false)) {
            return false;
        }
        else {
            return true;
        }
    }
    
    /**
     * De XML informatie van de stream uitlezen
     * @return boolean: `true` als de server bereikbaar is en de XML data ingelezen is
     */
    public function readAllXmlData() {
        if (!$this->isOnline()) {
            return false;
        }
        else {
            $xml = simplexml_load_file($this->_url);
            
            //            Voorbeeld Xml data object dump:
            //                SimpleXMLElement Object ( 
            //                        [CURRENTLISTENERS] => 1 
            //                        [PEAKLISTENERS] => 1 
            //                        [MAXLISTENERS] => 32 
            //                        [UNIQUELISTENERS] => 1 
            //                        [AVERAGETIME] => 62 
            //                        [SERVERGENRE] => Hardstyle 
            //                        [SERVERURL] => http://www.virtualdj.com/ 
            //                        [SERVERTITLE] => DJKaj 
            //                        [SONGTITLE] => Crypsis - The Main MF 
            //                        [NEXTTITLE] => SimpleXMLElement Object ( ) 
            //                        [IRC] => DJKaj 
            //                        [ICQ] => DJKaj 
            //                        [AIM] => DJKaj 
            //                        [STREAMHITS] => 1 
            //                        [STREAMSTATUS] => 1 
            //                        [STREAMPATH] => /test.aac 
            //                        [BITRATE] => 160 
            //                        [CONTENT] => audio/mpeg 
            //                        [VERSION] => 2.0.0.29 (posix(linux x86)) 
            //                ) 
            
            
            foreach($xml->children() as $child) { //Loop door de xml tags
                switch($child->getName()) {
                    case 'CURRENTLISTENERS':
                        $this->_currentlisteners = $child;
                        break;
                    case 'PEAKLISTENERS':
                        $this->_peaklisteners = $child;
                        break;
                    case 'MAXLISTENERS':
                        $this->_maxlisteners = $child;
                        break;
                    case 'UNIQUELISTENERS':
                        $this->_uniquelisteners = $child;
                        break;
                    case 'AVERAGETIME':
                        $this->_averagetime = $child;
                        break;
                    case 'SERVERGENRE':
                        $this->_servergenre = $child;
                        break;
                    case 'SERVERURL':
                        $this->_serverurl = $child;
                        break;
                    case 'SERVERTITLE':
                        $this->_servertitle = $child;
                        break;
                    case 'SONGTITLE':
                        $this->_songtitle = $child;
                        break;
                    case 'STREAMSTATUS':
                        $this->_streamstatus = $child;
                        break;
                    case 'STREAMHITS':
                        $this->_streamhits = $child;
                        break;
                    case 'BITRATE':
                        $this->_bitrate = $child;
                        break;
                }
            }
            return true;
        }
    }
}

?>