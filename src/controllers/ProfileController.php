<?php

require_once "AppController.php";
require_once __DIR__."/../DAO/ProfileDataDAO.php";
require_once __DIR__."/../DAO/UserDAO.php";

class ProfileController extends AppController
{
    private $profileDAO;
    private $userDAO;
    private $accessPermission = 'profile_access';

    public function __construct()
    {
        parent::__construct();
        $this->profileDAO = new ProfileDataDAO();
        $this->userDAO = new UserDAO();
    }

    public function profile()
    {
        if(isset($_COOKIE["user_id"]))
        {
            $userPermissions  = $this->userDAO->getUsersRolePermissions($_COOKIE['user_id']);
            if($userPermissions[$this->accessPermission] === 'true')
            {
                $profile_data = $this->profileDAO->getProfileDataOfThisUser($_COOKIE["user_id"]);
                $personal_data = $this->profileDAO->getPersonalDataOfThisUser($_COOKIE["user_id"]);

                $result = ["name" => $personal_data["name"], "surname" => $personal_data['surname'],
                    "about_me" => $profile_data['about_me'], 'code' => $profile_data['code'], "messages" => "bla"];
                $this->render("profile", $result);
            }
            else
            {
                $this->render('profile');
            }
        }
        else{
            $this->render("login", ["messages" => ["You need to login first"]]);
        }
    }

    public function updateAboutMe()
    {
        if($this->isPost())
        {
            if(isset($_POST['newAboutMe']) and !empty($_POST['newAboutMe']))
            {
                if(isset($_COOKIE["user_id"]))
                {
                    $this->profileDAO->updateAboutMeOfThisUser($_COOKIE["user_id"], $_POST['newAboutMe']);
                    echo json_encode(['error' => 'false', 'success' => 'true']);
                }
                else
                {
                    echo json_encode(['error' => "UserNotSet", 'success' => 'false']);
                }
            }
            else
            {
                echo json_encode(['error' => 'InfoNotSet', 'success' => 'false']);
            }
        }
        else
        {
            echo json_encode(['error' => 'NotPOST', 'success' =>'false']);
        }
    }

    public function updateTravellersCode()
    {
        if($this->isPost())
        {
            if(isset($_POST['code']) and !empty($_POST['code']))
            {
                if(isset($_COOKIE["user_id"]))
                {
                    $this->profileDAO->updateTravellersCodeOfThisUser($_COOKIE["user_id"], $_POST['code']);
                    echo json_encode(['error' => 'false', 'success' => 'true']);
                }
                else
                {
                    echo json_encode(['error' => "UserNotSet", 'success' => 'false']);
                }
            }
            else
            {
                echo json_encode(['error' => 'InfoNotSet', 'success' => 'false']);
            }
        }
        else
        {
            echo json_encode(['error' => 'NotPOST', 'success' =>'false']);
        }
    }

}