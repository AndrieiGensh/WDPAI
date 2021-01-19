<?php

require_once __DIR__.'/../controllers/SecurityController.php';
require_once __DIR__.'/../controllers/SettingsController.php';
require_once __DIR__.'/../controllers/RegistrationController.php';
require_once __DIR__.'/../controllers/CollectionController.php';
require_once __DIR__.'/../controllers/ProfileController.php';
require_once __DIR__.'/../controllers/ForumController.php';

if(isset($_POST['handler_controller']))
{
    $controller_name = $_POST['handler_controller'];
    $controller = new $controller_name();

    $controller->distinguishActionRequest();
}
else
{
    echo json_encode(['error' => 'ControllerNotSet', 'success' => 'true']);
}
