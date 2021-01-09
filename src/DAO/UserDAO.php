<?php

require_once 'DAO.php';
require_once __DIR__.'/../models/User.php';

class UserDAO extends DAO
{
    public function getUser(string $email) : ?User
    {
        $statement = $this->database->connect()->prepare('SELECT us.id, us.email, us.password, us_d.name, us_d.surname FROM 
                public.users AS us INNER JOIN public.user_details AS us_d ON us_d.id = us.user_details WHERE us.email = :email');

        $statement->bindParam(':email', $email, PDO::PARAM_STR);
        $statement->execute();

        $user_general_info = $statement->fetch(PDO::FETCH_ASSOC);

        if($user_general_info == false)
        {
            return null;
        }

        return new User($user_general_info['id'], $user_general_info['email'], $user_general_info['password'],
            $user_general_info['name'], $user_general_info['surname']);
    }
}