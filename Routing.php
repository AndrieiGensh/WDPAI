<?php

require_once 'src/controllers/DefaultController.php';

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
            die("Wrong url was provided!");
        }

        $controller_name = self::$routes[$action];
        $actual_controller = new $controller_name();

        $actual_controller->$action();
    }
}