<?php
$url = "http://sunbow.be:8000/stats?sid=1";
if (@simplexml_load_file($url) === false) {
    echo "Stream offline.<br />";
}
else {
    $xml = simplexml_load_file($url);
    echo $xml->getName() . "<br><br />";

    print_r($xml);
    die();
    
    
    foreach($xml->children() as $child) {
        //Loop door de xml tags
        $childName = $child->getName();
        
        switch($child->getName()) {
            case 'CURRENTLISTENERS':
                break;
            case 'PEAKLISTENERS':
                break;
            case 'MAXLISTENERS':
                break;
            case 'UNIQUELISTENERS':
                break;
            case 'AVERAGETIME':
                break;
            case 'SERVERGENRE':
                break;
            case 'SERVERURL':
                break;
            case 'SERVERTITLE':
                break;
            case 'SONGTITLE':
                break;
            case 'STREAMSTATUS':
                break;
            case 'STREAMHITS':
                break;
        }
        
        
        
        
        
        
        
    }
    
    
    $arr = array();
    $arr = $xml->children();
    echo $arr[0];
    echo $arr[1];
    echo $arr[2];
    //print_r($arr);
    die();
    
foreach($xml->children() as $child)
  {
    
    echo $child->getName().":".$child."<br />";
  
  }
}
?>