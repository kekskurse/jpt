<?php
session_start();
$_SESSION["bundesland"]=null;
//Run this Script on time per Day!
require __DIR__.'/../vendor/autoload.php';
require __DIR__.'/../config/config.php';

$mediaWiki = new SSP\MediaWiki\MediaWikiConnect();
$mediaWiki->setAPIUrl("https://wiki.junge-piraten.de/w/api.php");
$mediaWiki->setLoginData($mediawiki["user"], $mediawiki["pw"]);
$mediaWiki->login();

$pdo = new Easy\PDOW\PDOW();
$pdo->connect($mysql["host"], $mysql["user"], $mysql["pw"], $mysql["db"], true);

$loko = new Jupis\LoKo();
$loko->setPDO($pdo);

$groups = $loko->listGroups(0);
$bundeslaender = array('baden-württemberg','bayern','berlin','brandenburg','bremen','hamburg','hessen','mecklenburg-vorpommern','niedersachsen','nordrhein-westfalen','rheinland-pfalz','saarland','sachsen','sachsen-anhalt','schleswig-holstein','thueringen','ueberregional');
foreach($bundeslaender as $bundesland)
{
	$groupsBundesland = array();
	foreach($groups as $group)
	{
		if($group["bundesland"]==$bundesland)
		{
			$groupsBundesland[] = $group;
		}
	}
	$text = "Gruppen in ".$bundesland.":\r\n";
	foreach($groupsBundesland as $group)
	{
		if($group["aktiv"]==1)
		{
			$text.= '* [['.$group["wiki"].'|'.$group["groupName"].']]'."\r\n";
		}
		$mediaWiki->setPageText("Vorlage:JPT/GroupBundesland/".$bundesland, $text);
		
	}
}
#var_dump($groups);
/*
$text = "<!-- Diese Seite wird durch einen Bot erstellt, manuelle änderungen werden überschrieben! !-->\r\n\r\n\r\n";
$text .= '{| class="wikitable sortable" style="width:100%"
! Typ !! Name !! Aktiv !! Bundesland !! Bemerkung
';
foreach($groups as $group)
{
	$b = array();
	$bemerkung = "";
	if($group["aktiv"]==1)
	{
		$people = $loko->searchPeople("group:".$group["id"]);
		if(count($people)==0)
		{
			$b[] = "'''Kein*e [[Loko/Ansprechpartner|Ansprechpartner*in]], bitte an loko@junge-piraten.de wenden!'''";
		}
		if($group["mail"]=="")
		{
			$b[] = "Keine Gruppen E-Mail adresse.";
		}
	}
	if(count($b)==0)
	{
		$bemerkung = "''Keine''";
	}
	else
	{
		for($i=0;$i<count($b);$i++)
		{
			if($i!=0)
			{
				$bemerkung.="\r\n";
			}
			$bemerkung.=$b[$i];
		}
	}
	$aktiv="Nein";
	if($group["aktiv"])
	{
		$aktiv = "Ja";
	}
	$text.='|-
| '.$group["typ"].'
| [['.$group["wiki"].'|'.$group["groupName"].']]
| '.$aktiv.'
| '.$group["bundesland"].'
| '.$bemerkung.'
|-';
}
$text .= '
|}';
*/
#$mediaWiki->getEditToken("Benutzer:Sspssp/Test");
$mediaWiki->setPageText("Benutzer:Sspssp/Test", $text);
#$text = $mediaWiki->getPageText("Benutzer:Sspssp/Test");
#echo $text;
