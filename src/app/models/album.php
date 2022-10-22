<?php

class Album
{
    private $table = 'album';
    private $database;

    public function __construct()
    {
        $this->database = new Database();
    }
}
