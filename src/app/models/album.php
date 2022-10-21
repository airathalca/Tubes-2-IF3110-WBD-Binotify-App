<?php

class Album
{
    private $table = 'album';
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }
}
