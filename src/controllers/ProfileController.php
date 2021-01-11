<?php

require_once "AppController.php";
require_once __DIR__."/../DAO/ProfileDataDAO.php";

class ProfileController extends AppController
{
    private $profileDAO;

    public function __construct()
    {
        parent::__construct();
        $this->profileDAO = new ProfileDataDAO();
    }

    public function profile()
    {
        if(isset($_COOKIE["user_id"]))
        {
            $profile_data = $this->profileDAO->getProfileDataOfThisUser($_COOKIE["user_id"]);
            $personal_data = $this->profileDAO->getPersonalDataOfThisUser($_COOKIE["user_id"]);

            $this->render("profile", ["personal_data" => $personal_data, "profile_data" => $profile_data,
                "messages" => ""]);
        }
        else{
            $this->render("login", ["messages" => "Ypu need to login first"]);
        }
    }


}