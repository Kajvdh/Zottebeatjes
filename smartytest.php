<?php
//Roep het bestand aan waarin de Smarty classes staan
require('lib/smarty/Smarty.class.php');

//Maak een nieuw object aan genaamd "Smarty"
$smarty = new Smarty();

$smarty->template_dir = "templates"; //Hierin staan de templatebestanden waarvan je gebruik maakt in je project
$smarty->compile_dir = "templates_c"; //Hierin komen de gecompileerde templatebestanden te staan
$smarty->cache_dir = "cache"; //Het is mogelijk om templates te cachen zodat ze niet telkens opnieuw gecompileerd hoeven worden. In dat geval is dit de map waar de gecachede bestanden in komen te staan.
$smarty->config_dir = "configs"; //Deze map wordt gebruikt voor het opslaan van configuratie-bestanden.

//Toekennen van paginatitel
$smarty->assign("paginaTitel","Smarty Site :: Home");
//Toekennen van een bedrag
$smarty->assign("totaalBedrag",50.30);
//Toekennen van een lap tekst
$content = "Dit is een tekst die je zo lang kunt maken als je zelf wilt.";
$smarty->assign("content",$content);
//Toekennen van een array
$arrNames = array("Henk","Klaas","Jan");
$smarty->assign("namen",$arrNames);

$smarty->display("index.tpl");

?>