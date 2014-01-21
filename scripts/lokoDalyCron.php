<?php
//Run this Script on time per Day!
require '../vendor/autoload.php';
require '../config/config.php';

$twitter = new Twitter(TwitterCKEY, TwitterCSecret, TwitterAToken, TwitterASecret);
if(date("d")==25||date("d")==30||date("d")==3)
{
	$loko = new Jupis\LoKo();

	$pdo = new Easy\PDOW\PDOW();
	$pdo->connect($mysql["host"], $mysql["user"], $mysql["pw"], $mysql["db"]);

	$loko->setPDO($pdo);

	$list = $loko->getLoKoPeople();
	foreach($list as $e)
	{
		//$e["name"];
		$twitter->request('direct_messages/new', 'POST', array('screen_name' => $e["name"], "text"=>"Denke an das LoKo Mumble und die Einladung"));
	}
}