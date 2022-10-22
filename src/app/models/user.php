<?php

class User
{
    private $table = 'user';
    private $database;

    public function __construct()
    {
        $this->database = new Database();
    }

    public function login($username, $password)
    {
        $query = 'SELECT username, password, isAdmin FROM ' . $this->table . ' WHERE username = :username';

        $this->database->query($query);
        $this->database->bind('username', $username);

        $user = $this->database->fetch();

        if (isset($user) && password_verify($password, $user->password)) {
            return $user->id;
        } else {
            throw new LoggedException('Unauthorized', 401);
        }
    }
}
