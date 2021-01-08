<?php

require_once 'DAO.php';
require_once __DIR__.'/../models/Photo.php';

class PhotoDAO extends DAO
{
    public function getAllPhotosOfThisUser(int $user_id) :?array
    {
        $statement  = $this->database->connect()->prepare("SELECT * FROM public.users_photos WHERE user_id = :user_id");
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
        $statement = $this->database->connect()->prepare("INSERT INTO public.users_photos (user_id, name_on_server, title) VALUES(?, ?, ?)");
        $statement->execute([$user_id, $photo->getPhotoName(), $photo->getPhotoTitle()]);
    }
}