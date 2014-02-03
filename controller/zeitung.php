<?php
$app->get('/zeitung/contact', function () use ($app) {
    $app->render('zeitung/contact.php', array("q"=>$app->request->params("q")));
});
$app->get("/zeitung/contact/search", function() use($app, $pdo)
{
	$zeitung = new Jupis\Zeitung();
	$zeitung->setPDO($pdo);
	$list = $zeitung->searchPeople($app->request->params('q'));
	echo json_encode($list);
});
$app->get("/zeitung/contact/edit", function() use ($app, $pdo)
{
	$zeitung = new Jupis\Zeitung();
	$zeitung->setPDO($pdo);
	$person = $zeitung->getPeople($app->request->params('id'));
	$app->render("zeitung/contact_new.php", array("id"=>$person["id"],"name"=>$person["name"], "mail"=>$person["mail"], "more"=>$person["more"], "topics"=>$person["topics"]));
});
$app->post("/zeitung/contact/edit", function() use($app, $pdo)
{
	$zeitung = new Jupis\Zeitung();
	$zeitung->setPDO($pdo);
	$zeitung->updatePeople($app->request->params("id"),$app->request->params("name"),$app->request->params("mail"), $app->request->params("topics"), $app->request->params("more"));
	#updatePeople($id, $name, $mail, $topics, $more)
	$app->redirect("/zeitung/contact");
});
$app->get("/zeitung/contact/new", function() use ($app)
{
	$app->render("zeitung/contact_new.php", array("id"=>"","name"=>"", "mail"=>"", "more"=>"", "topics"=>""));
});
$app->post("/zeitung/contact/new", function() use($app, $pdo)
{
	$zeitung = new Jupis\Zeitung();
	$zeitung->setPDO($pdo);
	$zeitung->addPeople($app->request->params("name"),$app->request->params("mail"), $app->request->params("topics"), $app->request->params("more"));
	$app->redirect("/zeitung/contact");
});
$app->get("/zeitung/contact/del", function() use ($app, $pdo)
{
	$zeitung = new Jupis\Zeitung();
	$zeitung->setPDO($pdo);
	$person = $zeitung->delPeople($app->request->params('id'));
	$app->redirect("/zeitung/contact");
});
$app->get('/zeitung/topiclist', function() use($pdo, $app) {
	$zeitung = new Jupis\Zeitung();
	$zeitung->setPDO($pdo);
	$list = $zeitung->searchTopic($app->request->params("term"));
	echo "[";
	foreach($list as $e)
	{
		echo '{ "id": "'.$e.'", "label": "'.$e.'", "value": "'.$e.'" }';
	}
	echo "]";
});
$app->get("/zeitung/topics", function() use($app, $pdo)
{
	$zeitung = new Jupis\Zeitung();
	$zeitung->setPDO($pdo);
	$topics = $zeitung->listAllTopics();
	$app->render("zeitung/topics.php", array("topics"=>$topics));
});