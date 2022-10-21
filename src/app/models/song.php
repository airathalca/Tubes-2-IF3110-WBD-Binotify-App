<?php

class Song
{
    private $table = 'song';
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }
}
