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
        $query = 'SELECT user_id, username, password FROM ' . $this->table . ' WHERE username = :username';

        $this->database->query($query);
        $this->database->bind('username', $username);

        $user = $this->database->fetch();

        if (isset($user) && password_verify($password, $user->password)) {
            return $user->user_id;
        } else {
            throw new LoggedException('Unauthorized', 401);
        }
    }

    public function register($username, $password)
    {
    }

    public function doesEmailExist($email)
    {
    }

    public function doesUsernameExist($username)
    {
    }
}
