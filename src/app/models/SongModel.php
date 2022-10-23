<?php

class SongModel
{
    private $database;

    public function __construct()
    {
        $this->database = new Database();
    }
}
