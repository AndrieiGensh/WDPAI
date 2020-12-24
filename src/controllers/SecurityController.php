<?php

require_once 'AppController.php';
require_once __DIR__.'/../models/User.php';

class SecurityController extends AppController
{
    public function login()
    {
        $temporary_user = new User('alfredshore@gmail.com', 'password', 'Alfred', 'Shore');

        if($this->isPOST())
        {
            return $this->render('login');
        }

        $email = $_POST["email"];
        $password  =$_POST['password'];

        if($temporary_user->getEmail() !== $email)
        {
            return $this->render("login", ['messages' => ['user with this email does not exist']]);
        }

        if($temporary_user->getPassword() !== $password)
        {
            return $this->render("login", ['messages' => ['wrong password']]);
        }

        $url = "http://$_SERVER[HTTP_HOST]";
        header("Location: {$url}/profile");

    }

}