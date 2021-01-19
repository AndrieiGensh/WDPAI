<?php
require_once "AppController.php";
require_once __DIR__."/../DAO/PhotoDAO.php";
require_once __DIR__."/../DAO/VideoDAO.php";
require_once __DIR__."/../DAO/MemoriesDAO.php";
require_once __DIR__."/../DAO/UserDAO.php";

class CollectionController extends AppController
{
    private $photoDAO;
    private $videoDAO;
    private $memoriesDAO;
    private $userDAO;

    private $accessPermission = 'collection_access';

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
        $this->userDAO = new UserDAO();
    }

    public function collection()
    {
        if(isset($_COOKIE["user_id"]))
        {
            $userPermissions  = $this->userDAO->getUsersRolePermissions($_COOKIE['user_id']);
            if($userPermissions[$this->accessPermission] === 'true')
            {
                $user_photos = $this->photoDAO->getAllPhotosOfThisUser($_COOKIE["user_id"]);
                $user_videos = $this->videoDAO->getAllVideosOfThisUser($_COOKIE["user_id"]);
                $user_memories = $this->memoriesDAO->getAllMemoriesOfThisUser($_COOKIE["user_id"]);

                $this->render("collection", ["photos" => $user_photos, "videos" => $user_videos, "memories" => $user_memories]);
            }
            else
            {
                $url = "http://$_SERVER[HTTP_HOST]";
                header("Location: {$url}/profile");
            }
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
                    $this->photoDAO->addUsersPhoto($_COOKIE["user_id"], new Photo(-1,$_FILES["photo_image"]["name"], $_POST["photo_title"]));
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
        $this->videoDAO->addUsersVideo($_COOKIE["user_id"], new Video(-1,$_FILES["video"]["name"],$_POST["video_title"]));
    }

    public function addMemory()
    {
        if (!isset($_COOKIE['user_id'])) {
            echo json_encode(['error' => "CookieExpired", 'success' => 'false']);
            return;
        }
        if ($this->isPOST()) {
            if (isset($_POST['memory_content'])) {
                if (isset($_POST['memory_title'])) {
                    if (isset($_POST['memory_id'])) {
                        $temporaryMemId = $_POST["memory_id"] === 'new' ? -1 : $_POST["memory_id"];
                        $updatedMemoryId = $this->memoriesDAO->updateUsersMemory($_COOKIE["user_id"],
                            new Memory($temporaryMemId, $_POST['memory_title'], $_POST['memory_content']));
                        if (isset($updatedMemoryId)) {
                            echo json_encode(['error' => 'false', 'success' => 'true', 'memory_id' => $updatedMemoryId]);
                        }
                    } else {
                        echo json_encode(['error' => 'MemoryIdNotSet', 'success' => 'false']);
                    }
                } else {
                    echo json_encode(['error' => 'MemoryTitleNotSet', 'success' => 'false']);
                }
            } else {
                echo json_encode(['error' => 'MemoryContentNotSet', 'success' => 'false']);
            }
        } else {
            echo json_encode(['error' => 'NotPost', 'success' => 'false']);
        }
    }

    public function deleteMemory()
    {
        if (!isset($_COOKIE['user_id'])) {
            echo json_encode(['error' => "CookieExpired", 'success' => 'false']);
            return;
        }
        if($this->isPOST())
        {
            if(isset($_POST["memory_id"]))
            {
                if($this->memoriesDAO->deleteUsersMemory($_COOKIE["user_id"], $_POST["memory_id"]))
                {
                    echo json_encode(['error' => 'false', 'success' => 'true']);
                }
                else
                {
                    echo json_encode(['error' => 'DeletingProblem', 'success' => 'false']);
                }
            }
            else
            {
                echo json_encode(['error' => 'MemoryIdNotPost', 'succcess' => 'false']);
            }
        }
        else
        {
            echo json_encode(['error' => 'NotPost', 'success' => 'false']);
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
}