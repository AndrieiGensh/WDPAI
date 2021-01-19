<?php

require_once __DIR__.'/../../Database.php';

class DAO
{
    protected $database;
    public function __construct()
    {
        $this->database = new Database();
    }
}