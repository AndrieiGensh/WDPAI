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
        $statement->bindValue(":name", $name, PDO::PARAM_STR);
        $statement->bindValue(":surname", $surname, PDO::PARAM_STR);

        $statement->execute();
        $user_details_item_id = $statement->fetch(PDO::FETCH_ASSOC);

        if(!$user_details_item_id['id'])
        {
            $statement = $this->connection->prepare("INSERT INTO public.user_details (name, surname) VALUES 
                                               (?, ?)");
            $statement->execute([$name, $surname]);

            $user_details_item_id = $this->connection->lastInsertId();
        }

        $statement = $this->connection->prepare("INSERT INTO public.users (email, password, authorized, 
                          user_details, registration_date) VALUES (?, ?, ?, ?, ?)");

        $statement->bindValue(1, $email, PDO::PARAM_STR);
        $statement->bindValue(2, password_hash($password, PASSWORD_DEFAULT), PDO::PARAM_STR);
        $statement->bindValue(3, true, PDO::PARAM_BOOL);
        $statement->bindValue(4, intval($user_details_item_id['id']), PDO::PARAM_INT);
        $statement->bindValue(5, date("Y-m-d"), PDO::PARAM_STR);

        $statement->execute();

        $userId = $this->connection->lastInsertId();

        $statement = $this->connection->prepare("INSERT INTO public.user_roles (user_id, role_id) VALUES(?, ?)");
        $statement->bindValue(1, $userId);
        $statement->bindValue(2, 0);

        $statement->execute();

        return $userId;
    }

    public function deleteThisUser(int $user_id) : bool
    {
        $statement = $this->connection->prepare("DELETE FROM public.users WHERE id = :user_id");
        $statement->bindValue(":user_id", $user_id);
        if($statement->execute())
        {
            return true;
        }
        return false;
    }

    public function getUsersRolePermissions(int $user_id)
    {
        $statement = $this->connection->prepare("SELECT perm.permission_name FROM public.user_roles AS u_r INNER JOIN public.roles_permissions AS r_p ON u_r.role_id =
        r_p.role_id INNER JOIN public.permissions AS perm ON r_p.permission_id = perm.id WHERE u_r.user_id = :user_id");
        $statement->bindValue(":user_id", $user_id);
        $statement->execute();

        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        $arr = [];
        foreach($result as $res)
        {
            $arr[] = $res['permission_name'];
        }
        $allPermissions = ['delete_permission', 'edit_permission', 'add_permission', 'forum_access',
            'profile_access', 'settings_access', 'collection_access'];
        $resolvedPermissions = array();
        foreach($allPermissions as $perm)
        {
            if(in_array($perm, $arr))
            {
                $resolvedPermissions[$perm] = 'true';
            }
            else
            {
                $resolvedPermissions[$perm] = 'false';
            }
        }
        return $resolvedPermissions;
    }
}