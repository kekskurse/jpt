<?php
session_start();
#$_SESSION["BLA"]="ja";
require '../vendor/autoload.php';
require '../middelware/AllCapsMiddelware.php';
if(!file_exists("../config/config.php"))
{
	echo "Config File not exist";
	exit();
}
require '../config/config.php';
$pdo = new Easy\PDOW\PDOW();
$pdo->connect($mysql["host"], $mysql["user"], $mysql["pw"], $mysql["db"], true);


$app = new \Slim\Slim(
	array(
    	'templates.path' => '../templates'
	));

$app->add(new \AllCapsMiddleware());

require "../controller/test.php";
require "../controller/public.php";
require "../controller/loko.php";
require "../controller/lists.php";

$app->run();