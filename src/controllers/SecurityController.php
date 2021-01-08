<?php

require_once 'AppController.php';
require_once __DIR__.'/../models/User.php';
require_once __DIR__.'/../DAO/UserDAO.php';

class SecurityController extends AppController
{

    public function login()
    {
        if(isset($_COOKIE["user_id"]))
        {
            $url = "http://$_SERVER[HTTP_HOST]";
            header("Location: {$url}/profile");
        }

        $userDao = new UserDAO();

        if(!$this->isPOST())
        {
            return $this->render('login');
        }

        $email = $_POST["email"];
        $password  =$_POST['password'];

        $user = $userDao->getUser($email);

        if($user===null)
        {
            return $this->render("login", ["messages" => ["User does not exist"]]);
        }

        if($user->getPassword() != $password)
        {
            return $this->render("login", ["messages" => ["Wrong password was provided"]]);
        }

        setcookie("user_id", $user->getUserId(), time() + 3600);

        $url = "http://$_SERVER[HTTP_HOST]";
        header("Location: {$url}/profile");

    }

}