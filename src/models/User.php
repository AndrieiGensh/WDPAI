<?php


class User
{
    private $user_id;
    private $email;
    private $password;
    private $name;
    private $surname;

    public function __construct(int $user_id, string $email, string $password, string $name, string $surname)
    {
        $this->user_id = $user_id;
        $this->email = $email;
        $this->password = $password;
        $this->name = $name;
        $this->surname = $surname;
    }

    public function getUserId() : int
    {
        return $this->user_id;
    }

    public function setUserId(int $user_id)
    {
        $this->user_id = $user_id;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email)
    {
        $this->email = $email;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password)
    {
        $this->password = $password;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name)
    {
        $this->name = $name;
    }

    public function getSurname(): string
    {
        return $this->surname;
    }

    public function setSurname(string $surname)
    {
        $this->surname = $surname;
    }


}