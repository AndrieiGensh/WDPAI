<?php


class Photo
{
    private $photoName;
    private $photoTitle;
    private $photoId;

    public function __construct(int $photoId, string $name, string $title)
    {
        $this->photoName = $name;
        $this->photoTitle = $title;
        $this->photoId = $photoId;
    }

    public function getPhotoName(): string
    {
        return $this->photoName;
    }

    public function setPhotoName(string $photoName): void
    {
        $this->photoName = $photoName;
    }

    public function getPhotoId(): string
    {
        return $this->photoId;
    }

    public function setPhotoId(int $photoId): void
    {
        $this->photoId = $photoId;
    }

    public function getPhotoTitle(): string
    {
        return $this->photoTitle;
    }

    public function setPhotoTitle(string $photoTitle): void
    {
        $this->photoTitle = $photoTitle;
    }

}