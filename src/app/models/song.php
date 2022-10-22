<?php

class Song
{
    private $database;

    public function __construct()
    {
        $this->database = new Database();
    }
}
