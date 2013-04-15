<?php
require('lib/smarty/Smarty.class.php');

//Maak een nieuw object aan genaamd "Smarty"
global $smarty;

$smarty = new Smarty();

$smarty->template_dir = "templates"; //Hierin staan de templatebestanden waarvan je gebruik maakt in je project
$smarty->compile_dir = "templates_c"; //Hierin komen de gecompileerde templatebestanden te staan
$smarty->cache_dir = "cache"; //Het is mogelijk om templates te cachen zodat ze niet telkens opnieuw gecompileerd hoeven worden. In dat geval is dit de map waar de gecachede bestanden in komen te staan.
$smarty->config_dir = "configs"; //Deze map wordt gebruikt voor het opslaan van configuratie-bestanden.
?>
