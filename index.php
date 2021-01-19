<?php

require 'Routing.php';

$path = trim($_SERVER['REQUEST_URI'], '/');
$path = parse_url($path, PHP_URL_PATH);

Routing::set('login', 'SecurityController');
Routing::set('registration', 'RegistrationController');
Routing::set('', 'SecurityController');
Routing::set('profile', 'ProfileController');
Routing::set('forum', 'ForumController');
Routing::set('collection', 'CollectionController');
Routing::set('settings', 'SettingsController');

Routing::run($path);

