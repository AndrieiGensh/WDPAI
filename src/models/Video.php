<?php


class Video
{
    private $videoName;
    private $videoTitle;

    public function __construct(string $name, string $title)
    {
        $this->videoName = $name;
        $this->videoTitle = $title;
    }

    public function getVideoName(): string
    {
        return $this->videoName;
    }

    public function setVideoName(string $videoName): void
    {
        $this->videoName = $videoName;
    }

    public function getVideoTitle(): string
    {
        return $this->videoTitle;
    }

    public function setVideoTitle(string $videoTitle): void
    {
        $this->videoTitle = $videoTitle;
    }

}