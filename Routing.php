<?php

require_once 'src/controllers/DefaultController.php';
require_once 'src/controllers/SecurityController.php';
require_once 'src/controllers/CollectionController.php';
require_once 'src/controllers/ProfileController.php';
require_once 'src/controllers/RegistrationController.php';
require_once 'src/controllers/ForumController.php';
require_once 'src/controllers/SettingsController.php';

class Routing 
{
    public static $routes;

    public static function set($url, $controller)
    {
        self::$routes[$url] = $controller;
    }

    public static function run($url)
    {
        $action = explode('/', $url)[0];

        if(!array_key_exists($action, self::$routes))
        {
            die("Wrong url");
        }

        $controller_name = self::$routes[$action];
        $actual_controller = new $controller_name();

        $action = ($action === '') ? 'login' : $action;

        $actual_controller->$action();
    }
}