<?php


/**
 * Description of Stream
 *
 * @author Kaj
 */
class Stream {
    private $_url;
    private $_currentlisteners; //Het aantal luisteraars
    private $_peaklisteners; //Het record aantal luisteraars
    private $_maxlisteners; //Het maximum aantal luisteraars
    private $_uniquelisteners; //Het aantal unieke luisteraars (op basis van IP-adres)
    private $_averagetime; //De gemiddelde luister-tijd
    private $_servergenre; //Het genre, meegegeven door de server
    private $_serverurl; //Server url (meestal link naar de broadcast software)
    private $_servertitle; //Server titel (vaak de DJ naam)
    private $_songtitle; //Songtitel
    private $_streamstatus; //Streamstatus
    private $_streamhits; //Streamhits
    private $_bitrate; //Bitrate
    
    public function __construct($url) {
        $this->_url = $url;
    }
    
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
    
    public function isOnline() {
        if (@simplexml_load_file($this->_url) === false) {
            return false;
        }
        else {
            return true;
        }
    }
    
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
            
            
            foreach($xml->children() as $child) {
                //Loop door de xml tags

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
        }
    }
    
    //put your code here
}

?>
