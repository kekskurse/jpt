<?php
session_start();
#$_SESSION["BLA"]="ja";
require '../vendor/autoload.php';
require '../middelware/AllCapsMiddelware.php';
$app = new \Slim\Slim(
	array(
    	'templates.path' => '../templates'
	));

$app->add(new \AllCapsMiddleware());

require "../controller/test.php";
require "../controller/public.php";
require "../controller/loko.php";

$app->run();