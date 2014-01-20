<?php
$app->get('/', function () use ($app) {
    $app->redirect('/test');
});
$app->get('/test', function () use ($app) {
    $app->render('index.php', array());
});