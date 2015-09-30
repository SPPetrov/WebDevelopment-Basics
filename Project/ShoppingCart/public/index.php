<?php
error_reporting(E_ALL ^ E_NOTICE);
include '../../Framework/App.php';


$app = \FW\App::getInstance();

$app->run();

$app->getSession()->counter+=1;
echo $app->getSession()->counter;
