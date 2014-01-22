<?php
$app->get("/lists", function() use ($app, $pdo)
{
	$app->render("lists/overview.php", array());
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