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

    private array $SUPPORTED_PHOTO_TYPES = ["image/png", "image/jpeg"];
    private array $SUPPORTED_VIDEO_TYPES = ["avi", "ogv", "mp4"];
    private $MAX_FILE_SIZE = 1024 * 1024;
    private $UPLOAD_DIRECTORY = "/../../public/uploads/";

    public function __construct()
    {
        parent::__construct();
        $this->photoDAO = new PhotoDAO();
        $this->videoDAO = new VideoDAO();
        $this->memoriesDAO = new MemoriesDAO();
    }

    public function collection()
    {
        if(isset($_COOKIE["user_id"]))
        {
            $user_photos = $this->photoDAO->getAllPhotosOfThisUser($_COOKIE["user_id"]);
            $user_videos = $this->videoDAO->getAllVideosOfThisUser($_COOKIE["user_id"]);
            $user_memories = $this->memoriesDAO->getAllMemoriesOfThisUser($_COOKIE["user_id"]);

            $this->render("collection", ["photos" => $user_photos, "videos" => $user_videos, "memories" => $user_memories]);
        }
        else
        {
            $this->render("login", ["messages" => ["You need to login first"]]);
        }
    }

    public function addPhoto() : void
    {
        if($this->isPOST())
        {
            if(is_uploaded_file($_FILES["photo_image"]["tmp_name"]))
            {
                if($this->checkFile($_FILES["photo_image"]))
                {
                    move_uploaded_file(
                        $_FILES["photo_image"]["tmp_name"],
                        __DIR__.$this->UPLOAD_DIRECTORY.$_FILES["photo_image"]["name"]
                    );
                    $this->photoDAO->addUsersPhoto($_COOKIE["user_id"], new Photo($_FILES["photo_image"]["name"], $_POST["photo_title"]));
                    echo json_encode(array("error" => "false", "success" => "true"));
                    return;
                }
                else{
                    echo json_encode(['error' => 'FileCheck', 'success' => 'false']);
                    return;
                }
            }
            else
            {
                echo json_encode(['error' => 'NotUploaded', 'success' => 'false']);
                return;
            }
        }
        else
        {
            echo json_encode(["error" => "NotPost", "success" => "false"]);
            return;
        }
    }

    public function addVideo()
    {
        if($this->isPOST() && is_uploaded_file($_FILES["video"]["tmp_name"]) && $this->checkFile($_FILES["video"]))
        {
            move_uploaded_file(
                $_FILES["video"]["tmp_name"],
                dirname(__DIR__).$this->UPLOAD_DIRECTORY.$_FILES["video"]["name"]
            );
            echo json_encode(["error" => "false", "success" => "true"]);
        }
        else
        {
            echo json_encode(["error" => "Problem", "success" => "false"]);
        }
        $this->videoDAO->addUsersVideo($_COOKIE["user_id"], new Video($_FILES["video"]["name"],$_POST["video_title"]));
    }

    public function addMemory()
    {
        if($this->isPOST() && isset($_POST["memory_content"]) && isset($_POST["memory_title"]))
        {
            if($_POST["memory_content"] !== "" && $_POST["memory_title"] !== "")
            {
                $memory_content = $_POST["memory_content"];
                $memory_title = $_POST["memory_title"];
                $this->memoriesDAO->addUsersMemory($_COOKIE["user_id"], new Memory($memory_content, $memory_title));

                echo json_encode(array('error' => 'false', 'success' => 'true'));
            }
            else{
                echo json_encode(array('error' => 'Problem', 'success' => 'false'));
            }

        }
        else
        {
            echo json_encode(array('error' => 'Problem', 'success' => 'false'));
        }

    }

    public function checkFile(array $file) : bool
    {
        if($file["size"] > $this->MAX_FILE_SIZE)
        {
            echo json_encode(array(["error" => "Size", "success" => "false"]));
            return false;
        }
        if(!in_array($file["type"], $this->SUPPORTED_PHOTO_TYPES))
        {
            echo json_encode(["error" => "Type", "success" => "false"]);
            return false;
        }
        return true;
    }

    public function distinguishActionRequest()
    {
        if($this->isPOST())
        {
            if(isset($_POST["action"]) && !empty($_POST["action"]))
            {
                if(method_exists($this, $_POST["action"]))
                {
                    $method = $_POST["action"];
                    $this->$method();
                }
                else
                {
                    echo json_encode(array('error' => 'MethodNotExist', 'success' => "false"));
                }

            }
            else
            {
                echo json_encode(array('error' => 'MethodNotSet', 'success' => "false"));
            }

        }
        else
        {
            echo json_encode(array('error' => 'NotPost', 'success' => "false"));
        }

    }

}