<?php

require 'Routing.php';

$path = trim($_SERVER['REQUEST_URI'], '/');
$path = parse_url($path, PHP_URL_PATH);

Routing::set('login', 'SecurityController');
Routing::set('registration', 'DefaultController');
Routing::set('', 'SecurityController');
Routing::set('profile', 'DefaultController');
Routing::set('forum', 'DefaultController');
Routing::set('collection', 'CollectionController');
Routing::set('settings', 'DefaultController');

Routing::run($path);

