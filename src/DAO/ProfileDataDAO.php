<?php

require_once __DIR__.'/../DAO/DAO.php';

class ProfileDataDAO extends DAO
{
    private $connection;

    public function __construct()
    {
        parent::__construct();
        $this->connection=$this->database->connect();
    }

    public function getProfileDataOfThisUser(int $user_id) :? array
    {
        $statement = $this->connection->prepare("SELECT pi.travellers_code, pi.about_me FROM public.user_profile_info
                AS pi WHERE pi.user_id = :user_id");
        $statement->bindParam(":user_id", $user_id, PDO::PARAM_INT);
        $statement->execute();

        $profile_info = $statement->fetch(PDO::FETCH_ASSOC);

        return ['code' => $profile_info["travellers_code"], 'about_me' => $profile_info["about_me"]];
    }

    public function getPersonalDataOfThisUser(int $user_id) :? array
    {
        $statement = $this->connection->prepare("SELECT us_d.name, us_d.surname FROM public.users AS u_s 
                    INNER JOIN public.user_details AS us_d ON u_s.user_details = us_d.id WHERE u_s.id = :user_id");
        $statement->bindParam(":user_id", $user_id, PDO::PARAM_INT);
        $statement->execute();

        $user_details = $statement->fetch(PDO::FETCH_ASSOC);

        $user_name = $user_details["name"];
        $user_surname = $user_details["surname"];

        $result = ["name" => $user_name, "surname" => $user_surname];
        
        return $result;
    }

    public function updateProfileDataOfThisUser(int $user_id) : bool
    {

    }

    public function updatePersonalDataOfThisUser(int $user_id, string $name, string $surname) : bool
    {
        $statement = $this->connection->prepare("");
    }

}