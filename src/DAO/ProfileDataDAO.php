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

    public function updateAboutMeOfThisUser(int $user_id, string $aboutMe)
    {
        $statement = $this->connection->prepare("SELECT * FROM public.user_profile_info AS us_p WHERE us_p.user_id = :user_id");
        $statement->bindValue(":user_id", $user_id, PDO::PARAM_INT);
        $statement->execute();

        $result = $statement->fetch(PDO::FETCH_ASSOC);

        if($result['user_id'])
        {
            $statement = $this->connection->prepare("UPDATE public.user_profile_info AS us_p SET about_me = 
                    :about_me WHERE us_p.user_id = :user_id");
            $statement->bindValue(":about_me", $aboutMe, PDO::PARAM_STR);
            $statement->bindValue(":user_id", $user_id, PDO::PARAM_INT);
            $statement->execute();
        }
        else
        {
            $statement = $this->connection->prepare("INSERT INTO public.user_profile_info (user_id, about_me) 
                    VALUES (:user_id, :about_me)");
            $statement->bindValue(":about_me", $abouMe, PDO::PARAM_STR);
            $statement->bindValue(":user_id", $user_id, PDO::PARAM_INT);
            $statement->execute();
        }
    }

    public function updateTravellersCodeOfThisUser(int $user_id, string $code)
    {
        $statement = $this->connection->prepare("SELECT * FROM public.user_profile_info AS us_p WHERE us_p.user_id = :user_id");
        $statement->bindValue(":user_id", $user_id, PDO::PARAM_INT);
        $statement->execute();

        $result = $statement->fetch(PDO::FETCH_ASSOC);

        if($result['user_id'])
        {
            $statement = $this->connection->prepare("UPDATE public.user_profile_info AS us_p SET travellers_code = 
                    :code WHERE us_p.user_id = :user_id");
            $statement->bindValue(":code", $code, PDO::PARAM_STR);
            $statement->bindValue(":user_id", $user_id, PDO::PARAM_INT);
            $statement->execute();
        }
        else
        {
            $statement = $this->connection->prepare("INSERT INTO public.user_profile_info (user_id, travellers_code) 
                    VALUES (:user_id, :code)");
            $statement->bindValue(":code", $code, PDO::PARAM_STR);
            $statement->bindValue(":user_id", $user_id, PDO::PARAM_INT);
            $statement->execute();
        }
    }

    public function updatePersonalDataOfThisUser(int $user_id, string $name, string $surname)
    {
        $statement = $this->connection->prepare("SELECT us_d.id FROM public.user_details as us_d WHERE 
                        us_d.name = :name AND us_d.surname = :surname");
        $statement->bindValue(":name", $name, PDO::PARAM_STR);
        $statement->bindValue(":surname", $surname, PDO::PARAM_STR);

        $name_surname_id = $statement->fetch(PDO::FETCH_ASSOC);

        if($name_surname_id == null and $name_surname_id == false)
        {
            $statement = $his->connection->prepare("INSERT INTO public.user_details AS us_d (name, surname) 
                       VALUES(?, ?)");
            $statement->bindValue(1, $name, PDO::PARAM_STR);
            $statement->bindValue(2, $surname, PDO::PARAM_STR);

            $statement->execute();

            $name_surname_id = $this->connection->lastInsertId();
        }

        $statement = $this->connection->prepare("UPDATE public.users AS us SET user_details = :info_id WHERE 
                        us.id = :user_id");
        $statement->bindValue(":info_id", $name_surname_id, PDO::PARAM_STR);
        $statement->bindValue(":user_id", $user_id, PDO::PARAM_INT);

        $statement->execute();
    }

}