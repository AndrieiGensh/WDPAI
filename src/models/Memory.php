<?php


class Memory
{
    private $memoryName;
    private $memoryContent;
    private $memoryId;

    public function __construct(int $memory_id, string $name, string $content)
    {
        $this->memoryName = $name;
        $this->memoryContent = $content;
        $this->memoryId = $memory_id;
    }

    public function getMemoryName() : string
    {
        return $this->memoryName;
    }

    public function setMemoryId(int $memoryId): void
    {
        $this->memoryId = $memoryId;
    }

    public function getMemoryId() : int
    {
        return $this->memoryId;
    }

    public function setMemoryName(string $memoryName): void
    {
        $this->memoryName = $memoryName;
    }

    public function getMemoryContent(): string
    {
        return $this->memoryContent;
    }

    public function setMemoryContent(string $memoryContent): void
    {
        $this->memoryContent = $memoryContent;
    }

}