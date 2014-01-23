<?php
$app->get("/lists", function() use ($app, $pdo)
{
	$app->render("lists/overview.php", array());
});
$app->get("/lists/search", function() use ($app, $pdo)
{
	$lists = new Jupis\Listen();
	$lists->setPDO($pdo);
	$l = $lists->searchList($app->request->params("q"));
	echo json_encode($l);
});
$app->get("/lists/new", function() use ($app, $pdo)
{
	$app->render("lists/new.php", array("name"=>""));
});
$app->post("/lists/new", function() use ($app, $pdo)
{
	$lists = new Jupis\Listen();
	$lists->setPDO($pdo);
	$lists->createList($app->request->params('name'));
	$app->redirect("/lists");
});
$app->get("/lists/structur", function() use($app, $pdo)
{
	$lists = new Jupis\Listen();
	$lists->setPDO($pdo);
	$structur = $lists->getListStructur($app->request->params("id"));
	$app->render("lists/stuctur.php", array("structur"=>$structur));
});
$app->post("/lists/structur", function() use($app, $pdo)
{
	$lists = new Jupis\Listen();
	$lists->setPDO($pdo);
	$lists->addFeld($app->request->params("id"),$app->request->params("name"),$app->request->params("typ"));
	$app->redirect("/lists/structur?id=".$app->request->params("id"));
	#$structur = $lists->getListStructur($app->request->params("id"));
	#$app->render("lists/stuctur.php", array("structur"=>$structur));
});
$app->get("/lists/list", function() use ($app, $pdo)
{
	$app->render("lists/list.php", array("id"=>$app->request->params("id")));
});
$app->get("/lists/list/structur", function () use ($app, $pdo)
{
	$lists = new Jupis\Listen();
	$lists->setPDO($pdo);
	$s = $lists->getListStructur($app->request->params("id"));
	echo json_encode($s);
});
$app->get("/lists/list/entries", function () use ($app, $pdo)
{
	$lists = new Jupis\Listen();
	$lists->setPDO($pdo);
	$val = $lists->searchEntries($app->request->params("id"),$app->request->params("q"));
	echo json_encode($val);
});
$app->get("/lists/list/new", function() use ($app, $pdo)
{
	$lists = new Jupis\Listen();
	$lists->setPDO($pdo);
	$s = $lists->getListStructur($app->request->params("id"));
	$app->render("lists/new_entry.php", array("id"=>$app->request->params("id"), "struktur"=>$s));
});
$app->post("/lists/list/new", function() use($app, $pdo)
{
	$lists = new Jupis\Listen();
	$lists->setPDO($pdo);
	$s = $lists->getListStructur($app->request->params("id"));
	$data = array();
	foreach($s as $feld)
	{
		$data[$feld["name"]] = $app->request->params($feld["name"]);
	}
	#var_dump($data);exit();
	$lists->addEntry($app->request->params("id"), $data);
	$app->redirect("/lists/list?id=".$app->request->params("id"));
});