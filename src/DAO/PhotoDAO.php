<?php

require_once 'DAO.php';
require_once __DIR__.'/../models/Photo.php';

class PhotoDAO extends DAO
{
    private $connection;
    public function __construct()
    {
        parent::__construct();
        $this->connection = $this->database->connect();
    }

    public function getAllPhotosOfThisUser(int $user_id) :?array
    {
        $statement  = $this->connection->prepare("SELECT pho.name_on_server, pho.title FROM public.photos as pho
            INNER JOIN public.users_photos as upho ON upho.photo_id = pho.id WHERE upho.user_id = :user_id");
        $statement->bindParam(":user_id", $user_id, PDO::PARAM_INT);
        $statement->execute();

        $photos = $statement->fetchAll(PDO::FETCH_ASSOC);

        $result = [];

        foreach($photos as $photo)
        {
            $result[] = new Photo($photo["name_on_server"], $photo["title"]);
        }

        return $result;

    }

    public function addUsersPhoto(int $user_id, Photo $photo) : void
    {
        $this->connection = $this->database->connect();
        $statement = $this->connection->prepare("INSERT INTO public.photos (name_on_server, title) VALUES(?, ?)");
        $statement->execute([$photo->getPhotoName(), $photo->getPhotoTitle()]);

        $photo_id = $this->connection->lastInsertId();

        $statement = $this->connection->prepare("INSERT INTO public.users_photos (user_id, photo_id) VALUES(?, ?)");
        $statement->execute([$user_id, $photo_id]);
    }
}