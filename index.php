<?php

$app = require 'lib/base.php';

$app->set('RELEASE', false);
$app->set('DEBUG', true);
$app->set('CACHE', 'folder=cache/'); # you can use other caching engines too
$app->set('imgdb', 'test.db'); # sqlite dbname; CHANGEME!
$app->set('GUI', 'tpl/'); # do not change

$app->route('GET /', 'main->start');
$app->route('GET /add', 'main->showAdd');
$app->route('POST /add', 'main->add');

$app->run();

?>