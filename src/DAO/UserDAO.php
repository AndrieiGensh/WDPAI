<?php

require_once 'DAO.php';
require_once __DIR__.'/../models/User.php';

class UserDAO extends DAO
{
    private $connection;

    public function __construct()
    {
        parent::__construct();
        $this->connection=$this->database->connect();
    }

    public function getUser(string $email) : ?User
    {
        $statement = $this->database->connect()->prepare('SELECT us.id, us.email, us.password, us_d.name, us_d.surname FROM 
                public.users AS us INNER JOIN public.user_details AS us_d ON us_d.id = us.user_details WHERE us.email = :email');

        $statement->bindParam(':email', $email, PDO::PARAM_STR);
        $statement->execute();

        $user_general_info = $statement->fetch(PDO::FETCH_ASSOC);

        if($user_general_info === false or empty($user_general_info))
        {
            return null;
        }

        return new User($user_general_info['id'], $user_general_info['email'], $user_general_info['password'],
            $user_general_info['name'], $user_general_info['surname']);
    }

    public function addUser(string $email, string $password, string $name, string $surname) : int
    {
        $statement = $this->connection->prepare("SELECT us_d.id FROM public.user_details AS us_d WHERE 
                                    us_d.name = :name AND us_d.surname = :surname");
        $statement->bindParam(":name", $name, PDO::PARAM_STR);
        $statement->bindParam(":surname", $surname, PDO::PARAM_STR);

        $statement->execute();
        $user_details_item_id = $statement->fetch(PDO::FETCH_ASSOC);

        if($user_details_item_id === false or $user_details_item_id === null)
        {
            $statement = $this->connection->prepare("INSERT INTO public.user_details (name, surname) VALUES 
                                               (?, ?)");
            $statement->execute([$name, $surname]);

            $user_details_item_id = $this->connection->lastInsertId();
        }

        $statement = $this->connection->prepare("INSERT INTO public.users (email, password, authorized, 
                          user_details, registration_date) VALUES (?, ?, ?, ?, ?)");

        $statement->bindValue(1, $email, PDO::PARAM_STR);
        $statement->bindValue(2, $password, PDO::PARAM_STR);
        $statement->bindValue(3, true, PDO::PARAM_BOOL);
        $statement->bindValue(4, intval($user_details_item_id), PDO::PARAM_INT);
        $statement->bindValue(5, date("Y-m-d"), PDO::PARAM_STR);

        $statement->execute();

        return $this->connection->lastInsertId();
    }
}