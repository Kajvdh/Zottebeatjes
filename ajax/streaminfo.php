<?php

include '../includes.php';

$stream = new Stream($config->getStreamXmlUrl());
$stream->readAllXmlData();

$dataArr = array();

$dataArr['online'] = $stream->isOnline();
$dataArr['currentlisteners'] = $stream->getCurrentListeners();
$dataArr['peaklisteners'] = $stream->getPeakListeners();
$dataArr['songtitle'] = $stream->getSongTitle();
$dataArr['dj'] = $stream->getServerTitle();
$dataArr['streamstatus'] = $stream->getStreamStatus();

echo json_encode($dataArr);
?>