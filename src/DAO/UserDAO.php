<?php

require_once 'DAO.php';
require_once __DIR__.'/../models/User.php';

class UserDAO extends DAO
{
    public function getUser(string $email) : ?User
    {
        $statement = $this->database->connect()->prepare('SELECT * FROM public.users WHERE email = :email');

        $statement->bindParam(':email', $email, PDO::PARAM_STR);
        $statement->execute();

        $user = $statement->fetch(PDO::FETCH_ASSOC);

        if($user == false)
        {
            return null;
        }

        return new User($user['id'], $user['email'], $user['password'], $user['name'], $user['surname']);
    }
}