<?php
error_reporting(E_ALL ^ E_NOTICE);
include '../../Framework/App.php';


$app = \FW\App::getInstance();
echo $app->getConfig()->app;

$app->run();
