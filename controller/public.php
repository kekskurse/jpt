<?php
$app->get("/login", function() use ($app) {
	$app->render('login.php', array());
});
$app->post("/login", function() use ($app, $pdo) {
	/* CHECK NNTP CONNECTION */
	$nntp = new SSP\NNTP\NNTP();
	$nntp->connect("news.junge-piraten.de"); //Return true or false
	$res = $pdo->query("SELECT * FROM `access` WHERE `username` = ?", array($app->request->params('user')));
	if(count($res)==0)
	{
		$app->render('login.php', array("login"=>false));
	}
	elseif(count($res)>1)
	{
		$app->render('login.php', array("login"=>false));
	}
	else
	{
		$login = $nntp->autentifizierung($app->request->params('user'), $app->request->params('pass')); //Return true or false
		if($login)
		{
			#var_dump($res);exit();
			$_SESSION["login"]=true;
			$_SESSION["username"]=$app->request->params('user');
			$_SESSION["pw"]=$app->request->params('pass');
			$_SESSION["loko"]=$res[0]["loko"];
			$_SESSION["bundesland"]=$res[0]["bundesland"];
			$_SESSION["zeitung"]=$res[0]["zeitung"];
			$_SESSION["workflow"]=1;
			$_SESSION["mail"]=$res[0]["mail"];
			$app->redirect('/');
		}
		$app->render('login.php', array("login"=>$login));
	}
});
$app->get("/logout", function() use ($app) {
	$_SESSION["login"]=false;
	$_SESSION["username"]=null;
	$app->render('login.php', array());
});
$app->get("/public/api/groups.json", function () use($app, $pdo)
{
	$b = null;
	if(isset($_SESSION["bundesland"]))
	{
		$b = $_SESSION["bundesland"];
	}
	$_SESSION["bundesland"]=NULL;
	$loko = new Jupis\LoKo();
	$loko->setPDO($pdo);
	$groups = $loko->listGroups();
	if(isset($app->request->get("q")))
	{
		$groups = $loko->searchGroups($app->reqeust->get("q"));
	}
	
	$_SESSION["bundesland"] = $b;
	echo json_encode($groups);
});
