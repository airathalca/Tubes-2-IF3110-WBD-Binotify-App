<?php

class User
{
    private $table = 'user';
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }
}
