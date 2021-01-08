<?php


require_once 'DAO.php';
require_once __DIR__.'/../models/Video.php';

class VideoDAO extends DAO
{
    public function getAllVideosOfThisUser(int $user_id) :?array
    {
        $statement  = $this->database->connect()->prepare("SELECT * FROM public.users_videos WHERE user_id = :user_id");
        $statement->bindParam(":user_id", $user_id, PDO::PARAM_INT);
        $statement->execute();

        $videos = $statement->fetchAll(PDO::FETCH_ASSOC);

        $result = [];

        foreach($videos as $video)
        {
            $result[] = new Video($video["name_on_server"], $video["title"]);
        }

        return $result;
    }

    public function addUsersVideo(int $user_id, Video $video) : void
    {
        $statement = $this->database->connect()->prepare("INSERT INTO public.users_videos (user_id, name_on_server, title) VALUES(?, ?, ?)");
        $statement->execute([$user_id, $video->getVideoName(), $video->getVideoTitle()]);
    }
}