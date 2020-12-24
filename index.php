<?php

require 'Routing.php';

$path = trim($_SERVER['REQUEST_URI'], '/');
$path = parse_url($path, PHP_URL_PATH);

Routing::set('login', 'SecurityController');
Routing::set('', 'DefaultController');
Routing::set('profile', 'DefaultController');
Routing::set('forum', 'DefaultController');
Routing::set('collection', 'DefaultController');
Routing::set('settings', 'DefaultController');

Routing::run($path);

