<?php

require_once 'DAO.php';
require_once __DIR__.'/../models/Memory.php';

class MemoriesDAO extends DAO
{
    public function getAllMemoriesOfThisUser(int $user_id) : ?array
    {
        $statement = $this->database->connect()->prepare("SELECT mem.title, mem.content FROM public.memories AS 
                        mem INNER JOIN public.users_memories AS umem ON umem.memory_id = mem.id WHERE umem.user_id = :user_id");
        $statement->bindParam(":user_id", $user_id, PDO::PARAM_INT);
        $statement->execute();

        $memories = $statement->fetchAll(PDO::FETCH_ASSOC);

        $result = [];

        foreach($memories as $memory)
        {
            $result[] = new Memory($memory["title"], $memory["content"]);
        }
        return $result;
    }

    public function addUsersMemory(int $user_id, Memory $memory)
    {
        $statement = $this->database->connect()->prepare("INSERT INTO public.memories (title, content) VALUES(?, ?)");
        $statement->execute([$memory->getMemoryName(), $memory->getMemoryContent()]);

        $memory_id = $this->database->connect()->lastInsertId();

        $statement = $this->database->connect()->prepare("INSERT INTO public.users_memories (user_id, memory_id) VALUES(?, ?)");
        $statement->execute([$user_id, $memory_id]);
    }

}