<?php

require_once 'DAO.php';
require_once __DIR__.'/../models/Memory.php';

class MemoriesDAO extends DAO
{
    private $connection;

    public function __construct()
    {
        parent::__construct();
        $this->connection = $this->database->connect();
    }
    public function getAllMemoriesOfThisUser(int $user_id) : ?array
    {
        $statement = $this->connection->prepare("SELECT mem.id, mem.title, mem.content FROM public.memories AS 
                        mem INNER JOIN public.users_memories AS umem ON umem.memory_id = mem.id WHERE umem.user_id = :user_id");
        $statement->bindParam(":user_id", $user_id, PDO::PARAM_INT);
        $statement->execute();

        $memories = $statement->fetchAll(PDO::FETCH_ASSOC);

        $result = [];

        foreach($memories as $memory)
        {
            $result[] = new Memory($memory['id'], $memory["title"], $memory["content"]);
        }
        return $result;
    }

    public function addUsersMemory(int $user_id, Memory $memory) : int
    {
        $statement = $this->connection->prepare("INSERT INTO public.memories (title, content) VALUES(?, ?)");
        $statement->execute([$memory->getMemoryName(), $memory->getMemoryContent()]);

        $memory_id = $this->connection->lastInsertId();

        $statement = $this->connection->prepare("INSERT INTO public.users_memories (user_id, memory_id) VALUES(?, ?)");
        $statement->execute([$user_id, $memory_id]);

        $memory->setMemoryId($memory_id);

        return $memory_id;
    }

    public function updateUsersMemory(int $user_id, Memory $memory) : int
    {
        if($memory->getMemoryId() === -1)
        {
            return $this->addUsersMemory($user_id, $memory);
        }
        else
        {
            $statement = $this->connection->prepare("UPDATE public.memories as mem SET title = :title, content = 
                            :content WHERE mem.id = :memory_id");
            $statement->bindValue(":title", $memory->getMemoryName());
            $statement->bindValue(":content", $memory->getMemoryContent());
            $statement->bindValue(":memory_id", $memory->getMemoryId());
            $statement->execute();
            return $memory->getMemoryId();
        }
    }

    public function deleteUsersMemory(int $user_id, int $memory_id) : bool
    {
        $statement = $this->connection->prepare("DELETE FROM public.memories WHERE id = :memory_id");
        $statement->bindValue(":memory_id", $memory_id);
        if($statement->execute())
        {
            return true;
        }
        else
        {
            return false;
        }
    }

}