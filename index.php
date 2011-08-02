<?php

/**
 * index.php
 *
 * Routes and framework settings
 *
 * @author Sascha Ohms
 * @copyright Copyright 2011, Sascha Ohms
 * @license http://www.gnu.org/licenses/lgpl.txt
 *
**/

$app = require 'lib/base.php';

$app->set('RELEASE', false);
$app->set('DEBUG', true);
$app->set('CACHE', 'folder=cache/'); # you can use other caching engines too
$app->set('imgdb', 'test.db'); # sqlite dbname; CHANGEME!
$app->set('GUI', 'tpl/'); # do not change

$app->route('GET /', 'main->start');
$app->route('GET /del/@img/@del', 'main->del');
$app->route('GET /reg', 'main->showReg');
$app->route('GET /login', 'main->showLogin');

$app->route('POST /login', 'main->doLogin');
$app->route('POST /add', 'main->add');

$app->run();

?>