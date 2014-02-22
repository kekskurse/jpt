<?php
$app->get("/workflow/groups", function() use($app, $pdo)
{
	$w = new Jupis\Workflow();
	$w->setPDO($pdo);
	$list = $w->listWorkflowGroups(false);
	$app->render('workflows/groups.php', array("list"=>$list));
});
$app->get("/workflow/groups/new", function() use($app, $pdo)
{
	$app->render("workflows/groups_new.php", array("id"=>"NEW", "name"=>"", "aktiv"=>1));
});
$app->post("/workflow/groups/new", function() use($app, $pdo)
{
	$w = new Jupis\Workflow();
	$w->setPDO($pdo);
	$aktiv = 0;
	if($app->request->params("aktiv")!=null)
	{
		$aktiv = 1;
	}
	$w->addWorkflowGroup($app->request->params("name"), $aktiv);
	$app->redirect("/workflow/groups");
	#$app->render("workflows/groups_new.php", array("id"=>"NEW", "name"=>"", "aktiv"=>1));
});
$app->get("/workflow/groups/edit", function() use($app, $pdo)
{
	$w = new Jupis\Workflow();
	$w->setPDO($pdo);
	$detais = $w->getWorkflowGroup($app->request->params("id"));
	$app->render("workflows/groups_new.php", array("id"=>$app->request->params("id"), "name"=>$detais["name"], "aktiv"=>$detais["aktiv"]));
});
$app->post("/workflow/groups/edit", function() use($app, $pdo)
{
	$w = new Jupis\Workflow();
	$w->setPDO($pdo);
	$aktiv = 0;
	if($app->request->params("aktiv")!=null)
	{
		$aktiv = 1;
	}
	$w->updateWorkflowGrop($app->request->params("id"), $app->request->params("name"), $aktiv);
	$app->redirect("/workflow/groups");
	#$app->render("workflows/groups_new.php", array("id"=>"NEW", "name"=>"", "aktiv"=>1));
});
$app->get("/workflow/groups/rm", function() use($app, $pdo)
{
	$w = new Jupis\Workflow();
	$w->setPDO($pdo);
	$detais = $w->delWorkflowGroup($app->request->params("id"));
	$app->redirect("/workflow/groups");
});