<?php

require_once "AppController.php";
require_once __DIR__."/../DAO/ProfileDataDAO.php";
require_once __DIR__."/../DAO/UserDAO.php";

class SettingsController extends AppController
{
    private $userDAO;
    private $accessPermission = 'settings_access';
    public function __construct()
    {
        parent::__construct();
        $this->userDAO = new UserDAO;
    }

    public function settings()
    {
        if(isset($_COOKIE["user_id"]))
        {
            $userPermissions  = $this->userDAO->getUsersRolePermissions($_COOKIE['user_id']);
            if($userPermissions[$this->accessPermission] === 'true')
            {
                $this->render('settings');
            }
            else
            {
                $url = "http://$_SERVER[HTTP_HOST]";
                header("Location: {$url}/profile");
            }
        }
        else
        {
            $this->render("login", ["messages" => ["You need to login first"]]);
        }
    }

    public function deleteUsersAccount()
    {
        if(!isset($_COOKIE['user_id']))
        {
            echo json_encode(['error' => 'SessionExpired', 'success' => 'false']);
        }
        if($this->isPOST())
        {
            if($this->userDAO->deleteThisUser($_COOKIE['user_id']))
            {
                echo json_encode(['error' => 'false', 'success' => 'true', 'url' => "http://$_SERVER[HTTP_HOST]/login"]);
            }
            else
            {
                echo json_encode(['error' => 'DeleteFailed', 'success' => 'false']);
            }
        }
        else
        {
            echo json_encode(['error' => 'NotAuthorized', 'success' => 'false']);
        }
    }
}