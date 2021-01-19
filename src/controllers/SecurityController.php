<?php

require_once 'AppController.php';
require_once __DIR__.'/../models/User.php';
require_once __DIR__.'/../DAO/UserDAO.php';

class SecurityController extends AppController
{
    private $userDAO;

    public function __construct()
    {
        parent::__construct();
        $this->userDAO = new UserDAO;
    }

    public function login()
    {
        if(isset($_COOKIE["user_id"]))
        {
            $url = "http://$_SERVER[HTTP_HOST]";
            header("Location: {$url}/profile");
        }

        if(!$this->isPOST())
        {
            return $this->render('login');
        }

        $email = $_POST["email"];
        $password  = $_POST['password'];

        $user = $this->userDAO->getUser($email);

        if($user===null)
        {
            return $this->render("login", ["messages" => ["User does not exist"]]);
        }

        if(!password_verify($password, $user->getPassword()))
        {
            return $this->render("login", ["messages" => ["Wrong password was provided"]]);
        }

        setcookie("user_id", $user->getUserId(), time() + 3600);

        $url = "http://$_SERVER[HTTP_HOST]";
        header("Location: {$url}/profile");

    }

    public function resolvePermissions()
    {
        if(isset($_COOKIE['user_id']))
        {
            if($this->isPOST())
            {
                $permissions = $this->userDAO->getUsersRolePermissions($_COOKIE["user_id"]);
                if(!empty($permissions))
                {
                    echo json_encode(['error' => 'false', 'success' => 'true', 'permissions' => $permissions]);
                }
                else
                {
                    echo json_encode(['error' => 'CouldNotResovePermissions', 'success' => 'false']);
                }
            }
            else
            {
                echo json_encode(['error' => 'NotPost', 'success' => 'false']);
            }
        }
        else
        {
            echo json_encode(['error' => 'UserNotSet', 'success' => 'false']);
        }
    }

}