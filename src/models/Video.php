<?php


class Video
{
    private $videoName;
    private $videoTitle;
    private $videoId;

    public function __construct(int $videoId, string $name, string $title)
    {
        $this->videoName = $name;
        $this->videoTitle = $title;
        $this->videoId = $videoId;
    }

    public function getVidoId(): string
    {
        return $this->videoId;
    }

    public function setVideoId(int $videoId): void
    {
        $this->videoId = $videoId;
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