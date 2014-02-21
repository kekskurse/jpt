<?php
session_start();

date_default_timezone_set("Europe/Berlin");


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
#$_SESSION["loko"]=1;
if(isset($_SESSION["loko"])&&$_SESSION["loko"])
{
	require "../controller/loko.php";
}
if(isset($_SESSION["zeitung"])&&$_SESSION["zeitung"])
{
	require "../controller/zeitung.php";
}
if(isset($_SESSION["workflow"])&&$_SESSION["workflow"])
{
	require "../controller/workflow.php";
}

require "../controller/lists.php";

$app->run();