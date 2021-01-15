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

            $result = ["name" => $personal_data["name"], "surname" => $personal_data['surname'],
                "about_me" => $profile_data['about_me'], 'code' => $profile_data['code'], "messages" => "bla"];
            $this->render("profile", $result);
        }
        else{
            $this->render("login", ["messages" => "Ypu need to login first"]);
        }
    }
}