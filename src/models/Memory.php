<?php


class Memory
{
    private $memoryName;
    private $memoryContent;

    public function __construct(string $name, string $content)
    {
        $this->memoryContent = $name;
        $this->$this->memoryContent = $content;
    }

    public function getMemoryName()
    {
        return $this->memoryName;
    }

    public function setMemoryName($memoryName): void
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