<?php

require_once 'src/controllers/DefaultController.php';
require_once 'src/controllers/SecurityController.php';
require_once 'src/controllers/CollectionController.php';

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


        $init = '_init';
        $action = ($action === '') ? 'login' : $action;

        $actual_controller->$action();
    }
}