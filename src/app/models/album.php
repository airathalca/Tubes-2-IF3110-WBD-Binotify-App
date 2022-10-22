<?php

class Album
{
    private $database;

    public function __construct()
    {
        $this->database = new Database();
    }
}
