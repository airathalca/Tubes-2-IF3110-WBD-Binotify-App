<?php

class Song
{
    private $table = 'song';
    private $database;

    public function __construct()
    {
        $this->database = new Database();
    }
}
