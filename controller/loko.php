<?php
$app->get("/loko/member", function() use ($app) {
	$app->render('loko/member.php', array());
});
