<?php


class Photo
{
    private $photoName;
    private $photoTitle;

    public function __construct(string $name, string $title)
    {
        $this->photoName = $name;
        $this->photoTitle = $title;
    }

    public function getPhotoName(): string
    {
        return $this->photoName;
    }

    public function setPhotoName(string $photoName): void
    {
        $this->photoName = $photoName;
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