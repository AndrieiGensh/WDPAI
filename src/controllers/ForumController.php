<?php

require_once "AppController.php";
require_once __DIR__."/../DAO/ProfileDataDAO.php";
require_once __DIR__."/../DAO/UserDAO.php";

class ForumController extends AppController
{
    private $userDAO;
    private $accessPermission = 'forum_access';
    public function __construct()
    {
        parent::__construct();
        $this->userDAO = new UserDAO();
    }

    public function forum()
    {
        if(isset($_COOKIE["user_id"]))
        {
            $userPermissions  = $this->userDAO->getUsersRolePermissions($_COOKIE['user_id']);
            if($userPermissions[$this->accessPermission] === 'true')
            {
                $this->render('forum');
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

}