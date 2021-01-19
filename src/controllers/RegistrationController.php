<?php

require_once __DIR__.'/../DAO/UserDAO.php';
require_once __DIR__.'/../DAO/ProfileDataDAO.php';
require_once 'AppController.php';
require_once 'ProfileController.php';
require_once 'SecurityController.php';

class RegistrationController extends AppController
{
    private $userDAO;
    private $profileDataDAO;
    private int $userid;

    public function __construct()
    {
        parent::__construct();
        $this->userDAO = new UserDAO();
        $this->profileDataDAO = new ProfileDataDAO();
    }

    public function registration()
    {
        $this->render('registration');
    }

    public function checkNewUserEmail(string $email) : bool
    {
        $possibleUser = $this->userDAO->getUser($email);
        if($possibleUser === null)
        {
            return true;
        }
        else{
            return false;
        }
    }

    public function addNewUser() : void
    {
        if($this->isPOST())
        {
            if(isset($_POST["name"]) and !empty($_POST["name"]))
            {
                if(isset($_POST["surname"]) and !empty($_POST["surname"]))
                {
                    if(isset($_POST["email"]) and !empty($_POST["email"]))
                    {
                        if(isset($_POST["password"]) and !empty($_POST["password"]))
                        {
                            if($this->checkNewUserEmail($_POST["email"]))
                            {
                                $name = $_POST["name"];
                                $surname = $_POST["surname"];
                                $email = $_POST["email"];
                                $password = $_POST["password"];

                                $this->userid = $this->userDAO->addUser($email, $password, $name, $surname);
                                if(!$this->userid)
                                {
                                    echo json_encode(['error' => 'UserAddingFailed', 'success' => 'false']);
                                }
                                else
                                {
                                    echo json_encode(['error' => 'false', 'success' => 'true']);
                                }
                            }
                            else
                            {
                                echo json_encode(['error' => 'EmailOccupied', 'success' => 'false']);
                                return;
                            }
                        }
                        else
                        {
                            echo json_encode(['error' => 'PasswordNoTSet', 'success' => 'false']);
                            return;
                        }
                    }
                    else
                    {
                        echo json_encode(['error' => 'EmailNotSent', 'success' => 'false']);
                        return;
                    }
                }
                else
                {
                    echo json_encode(['error' => 'SurnameNotSet', 'success' => 'false']);
                }
            }
            else
            {
                echo json_encode(['error' => 'NameNotSet', 'success' => 'false']);
                return;
            }
        }
        else
        {
            echo json_encode(['error' => 'NotPOST', 'success' => 'false']);
            return;
        }
    }

    public function redirectNewUser()
    {
        if(isset($_POST['created_user_email']) and !empty($_POST["created_user_email"]))
        {
            $user = $this->userDAO->getUser($_POST["created_user_email"]); 
            if($user != null)
            {
                $url = "http://$_SERVER[HTTP_HOST]/profile";
                echo json_encode(['error' => 'false', 'success' => 'true', 'url' => $url, 'user_id' => $user->getUserId()]);
            }
            else{
                echo json_encode(["error" => 'UserNotFetched', 'success' => 'false']);
            }
        }
    }

    public function getUrlForCancelButton()
    {
        $url = "http://$_SERVER[HTTP_HOST]/login";
        echo json_encode(['error' => 'false', 'success' => 'true', 'url' => $url]);
    }


}