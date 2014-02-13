<?php
$app->get("/loko/member", function() use ($app, $pdo) {
	$loko = new Jupis\LoKo();
	$loko->setPDO($pdo);
	/*DEL*/
	$del = $app->request->params('del');
	if($del!=null)
	{
		$loko->rmLoKoPeople($del);
		$app->redirect('/loko/member');
	}
	/*DEL ENDE */
	$lokoMenschen = $loko->getLoKoPeople();
	$app->render('loko/member.php', array("lokoMenschen"=>$lokoMenschen));
});
$app->post("/loko/member", function() use ($app, $pdo) {
	$loko = new Jupis\LoKo();
	$loko->setPDO($pdo);
	$name = $app->request->params('twitter');
	if(substr($name, 0, 1)=="@")
	{
		$name = substr($name, 1);
	}
	$loko->addLoKoPeople($name);
	$app->redirect('/loko/member');
});

$app->get("/loko/invite", function() use ($app, $pdo) {
	$app->render('loko/invite.php', array());
});
$app->post("/loko/invite", function() use ($app, $pdo) {
	$loko = new Jupis\LoKo();
	$loko->setPDO($pdo);
	$loko->setNNTPData($_SESSION["username"], $_SESSION["pw"]);
	$test = true;
	if($app->request->params('test')==null)
	{
		$test = false;
	}
	$send = $loko->inviteNNTP($app->request->params('subject'), $app->request->params('text'), $test); 
	$app->render('nntpSend.php', array("send"=>$send, "next"=>"/loko/invite"));
	#echo "Einladung wurde verschickt";
	#var_dump($app->request->params('test'));
});

$app->get("/loko/invite/person", function() use($app, $pdo)
{
	$app->render('loko/invite_person.php', array());
});
$app->post("/loko/invite/person", function() use($app, $pdo)
{
	$loko = new Jupis\LoKo();
	$test = true;
	if($app->request->params('test')==null)
	{
		$test = false;
	}
	$loko->setPDO($pdo);
	$loko->setSMTPData(SMTPUSER, SMTPPASS);
	$mails = array();
	$list = $loko->listPeople(true, true);
	$send = array();
	foreach($list as $l)
	{
		#$mails[] = $l["mail"];
		$send[] = $loko->sendMail($app->request->params('subject'),  $app->request->params('text'), $l["mail"], $l["id"], $test, $_SESSION["username"]."@community.junge-piraten.de");
		if($test)
		{
			break;
		}
	}
	#$send = $loko->invitePeople($app->request->params('subject'), $app->request->params('text'), $mails, $test, $_SESSION["username"]."@community.junge-piraten.de");
	$app->render('smtpSend.php', array("send"=>$send, "next"=>"/loko/invite/person"));
});

$app->get("/loko/contact", function() use($app, $pdo)
{
	$loko = new Jupis\LoKo();
	$loko->setPDO($pdo);
	$list = $loko->listPeople();
	$app->render('loko/contact.php', array("q"=>$app->request->params('q')));
});
$app->get("/loko/contact/edit", function() use($app, $pdo)
{
	$loko = new Jupis\LoKo();
	$loko->setPDO($pdo);
	$groups = $loko->listGroups();
	$person = $loko->getPeople($app->request->params('id'));
	$app->render('loko/contact_new.php', array("id"=>$person["id"], "name"=>$person["name"], "mail"=>$person["mail"],"more"=>$person["more"], "group"=>$person["group"],"groups"=>$groups, "aktiv"=>$person["aktiv"], "lokoAnsprechpartner" => $person["lokoAnsprechpartner"]));
});
$app->post("/loko/contact/edit", function() use($app, $pdo)
{
	$loko = new Jupis\LoKo();
	$loko->setPDO($pdo);
	$aktiv = 0;
	if($app->request->params("aktiv")!=NULL)
	{
		$aktiv = 1;
	}
	$lokoAnsprechpartner = 0;
	if($app->request->params("lokoAnsprechpartner")!=NULL)
	{
		$lokoAnsprechpartner = 1;
	}
	$loko->updatePeople($app->request->params('id'), $app->request->params('name'), $app->request->params('mail'), $app->request->params('group'), $app->request->params('more'), $aktiv, $lokoAnsprechpartner);
	$app->redirect('/loko/contact');
});
$app->get("/loko/contact/new", function() use($app, $pdo)
{
	$loko = new Jupis\LoKo();
	$loko->setPDO($pdo);
	$groups = $loko->listGroups();
	$app->render('loko/contact_new.php', array("id"=>"NEW", "name"=>"", "mail"=>"","more"=>"","groups"=>$groups, "group"=>"", "aktiv" => 1, "lokoAnsprechpartner"=>1));
});
$app->get("/loko/contact/del", function() use($app, $pdo)
{
	$loko = new Jupis\LoKo();
	$loko->setPDO($pdo);
	$loko->delPeople($app->request->params('id'));
	$app->redirect('/loko/contact');
});
$app->post("/loko/contact/new", function() use($app, $pdo)
{
	$loko = new Jupis\LoKo();
	$loko->setPDO($pdo);
	$aktiv = 0;
	if($app->request->params("aktiv")!=NULL)
	{
		$aktiv = 1;
	}
	$lokoAnsprechpartner = 0;
	if($app->request->params("lokoAnsprechpartner")!=NULL)
	{
		$lokoAnsprechpartner = 1;
	}
	$loko->addPeople($app->request->params('name'), $app->request->params('mail'), $app->request->params('group'), $app->request->params('more'), $aktiv, $lokoAnsprechpartner);
	$app->redirect('/loko/contact');
});
$app->get("/loko/contact/search", function() use($app, $pdo)
{
	$loko = new Jupis\LoKo();
	$loko->setPDO($pdo);
	$list = $loko->searchPeople($app->request->params('q'));
	$bundeslaender = $loko->getLoKoBundeslaender();
	$tmp = array();
	foreach($list as $l)
	{
		if(in_array($l["bundesland"],$bundeslaender))
		{
			$l["verwalter"]=$l["bundesland"];
		}
		else
		{
			$l["verwalter"]="bund";
		}
	}
	echo json_encode($list);
});
/*GROUPS */
$app->get("/loko/groups", function() use($app)
{
	//$loko = new Jupis\LoKo();
	//$loko->setPDO($pdo);
	//$list = $loko->listGroups();
	$app->render('loko/groups.php', array());
});
$app->get("/loko/groups/new", function() use($app, $pdo)
{
	$bundeslaender = array('baden-württemberg','bayern','berlin','brandenburg','bremen','hamburg','hessen','mecklenburg-vorpommern','niedersachsen','nordrhein-westfalen','rheinland-pfalz','saarland','sachsen','sachsen-anhalt','schleswig-holstein','thueringen', 'ueberregional');
	$typen = array('crew','lo','lv','treffen','stammtisch','sonstiges');
	$app->render('loko/groups_new.php', array("id"=>"NEW", "name"=>"", "mail"=>"","more"=>"","aktiv"=>true, "bundesland"=>"", "listelaender"=>$bundeslaender, "wiki"=>"", "typen"=>$typen, "typ"=>""));
});
$app->post("/loko/groups/new", function() use($app, $pdo)
{
	$loko = new Jupis\LoKo();
	$loko->setPDO($pdo);
	$aktiv = false;
	if($app->request->params('aktiv')=="on")
	{
		$aktiv=true;
	}
	$loko->createGroup($app->request->params('name'),$app->request->params('mail'),$app->request->params('more'),$aktiv,$app->request->params('typ'),$app->request->params('bundesland'),$app->request->params('wiki'));
	$app->redirect('/loko/groups');
});
$app->get("/loko/groups/edit", function() use($app, $pdo)
{
	$loko = new Jupis\LoKo();
	$loko->setPDO($pdo);
	$detais = $loko->getGroups($app->request->params('id'));
	$bundeslaender = array('baden-württemberg','bayern','berlin','brandenburg','bremen','hamburg','hessen','mecklenburg-vorpommern','niedersachsen','nordrhein-westfalen','rheinland-pfalz','saarland','sachsen','sachsen-anhalt','schleswig-holstein','thueringen', 'ueberregional');
	$typen = array('crew','lo','lv','treffen','stammtisch','sonstiges');
	$app->render('loko/groups_new.php', array("id"=>$detais["id"], "name"=>$detais["groupName"], "mail"=>$detais["mail"],"more"=>$detais["more"],"aktiv"=>$detais["aktiv"],"bundesland"=>$detais["bundesland"], "listelaender"=>$bundeslaender, "wiki"=>$detais["wiki"], "typen"=>$typen, "typ"=>$detais["typ"]));
});
$app->post("/loko/groups/edit", function() use($app, $pdo)
{
	$loko = new Jupis\LoKo();
	$loko->setPDO($pdo);
	$aktiv = false;
	if($app->request->params('aktiv')=="on")
	{
		$aktiv=true;
	}
	$loko->updateGroup($app->request->params('id'), $app->request->params('name'),$app->request->params('mail'),$app->request->params('more'),$aktiv,$app->request->params('typ'),$app->request->params('bundesland'),$app->request->params('wiki'));
	$app->redirect('/loko/groups');
});
$app->get("/loko/groups/del", function() use($app, $pdo)
{
	$loko = new Jupis\LoKo();
	$loko->setPDO($pdo);
	$loko->delGroup($app->request->params('id'));
	#$loko->updateGroup($app->request->params('id'), $app->request->params('name'),$app->request->params('mail'),$app->request->params('more'));
	$app->redirect('/loko/groups');
});
$app->get("/loko/groups/search", function() use($app, $pdo)
{
	$loko = new Jupis\LoKo();
	$loko->setPDO($pdo);
	$list = $loko->searchGroups($app->request->params('q'));
	echo json_encode($list);
});
$app->get("/loko/groups/detais", function() use($app, $pdo)
{
	$loko = new Jupis\LoKo();
	$loko->setPDO($pdo);
	$app->ender("loko/group_detais.php", array());
});

