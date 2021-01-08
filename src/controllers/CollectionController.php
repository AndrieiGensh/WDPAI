<?php
require_once "AppController.php";
require_once __DIR__."/../DAO/PhotoDAO.php";
require_once __DIR__."/../DAO/VideoDAO.php";
require_once __DIR__."/../DAO/MemoriesDAO.php";

class CollectionController extends AppController
{
    private $photoDAO;
    private $videoDAO;
    private $memoriesDAO;

    public function __construct()
    {
        parent::__construct();
        $this->photoDAO = new PhotoDAO();
        $this->videoDAO = new VideoDAO();
        $this->memoriesDAO = new MemoriesDAO();
    }

    public function collection_init()
    {
        if(isset($_COOKIE["user_id"]))
        {
            $user_photos = $this->photoDAO->getAllPhotosOfThisUser();
            $user_videos = $this->videoDAO->getAllVideosOfThisUser();
            $user_memories = $this->memoriesDAO->getAllMemoriesOfThisUser();

            $this->render("collection", ["photos" => $user_photos, "videos" => $user_videos, "memories" => $user_memories]);
        }
    }

    public function addPhoto()
    {
        $this->photoDAO->
    }

    public function addVideo()
    {

    }

    public function addMemory()
    {

    }

}