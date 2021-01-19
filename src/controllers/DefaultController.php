<?php

require_once 'AppController.php';

class DefaultController extends AppController
{

    public function index()
    {
        $this->render('login');
    }

    public function registration()
    {
        $this->render('registration');
    }

    public function profile()
    {
        $this->render('profile');
    } 

    public function settings()
    {
        $this->render('settings');
    }

    public function forum()
    {
        $this->render('forum');
    }   

    public function collection()
    {
        $this->render('collection');
    }
}