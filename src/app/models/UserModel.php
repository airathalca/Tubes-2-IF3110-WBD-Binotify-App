<?php

class UserModel
{
    private $database;

    public function __construct()
    {
        $this->database = new Database();
    }

    public function login($username, $password)
    {
        $query = 'SELECT user_id, password FROM user WHERE username = :username LIMIT 1';

        $this->database->query($query);
        $this->database->bind('username', $username);

        $user = $this->database->fetch();

        if (property_exists($user, 'user_id') && password_verify($password, $user->password)) {
            return $user->user_id;
        } else {
            throw new LoggedException('Unauthorized', 401);
        }
    }

    public function register($email, $username, $password)
    {
        $query = 'INSERT INTO user VALUES (:email, :username, :password, :is_admin)';
        $options = [
            'cost' => BCRYPT_COST
        ];

        $this->database->query($query);
        $this->database->bind('email', $email);
        $this->database->bind('username', $username);
        $this->database->bind('password', password_hash($password, PASSWORD_BCRYPT, $options));
        $this->database->bind('is_admin', false);

        $this->database->execute();
    }

    public function doesEmailExist($email)
    {
        $query = 'SELECT email FROM user WHERE email = :email LIMIT 1';

        $this->database->query($query);
        $this->database->bind('email', $email);

        $user = $this->database->fetch();

        return property_exists($user, 'email');
    }

    public function doesUsernameExist($username)
    {
        $query = 'SELECT username FROM user WHERE username = :username LIMIT 1';

        $this->database->query($query);
        $this->database->bind('username', $username);

        $user = $this->database->fetch();

        return property_exists($user, 'username');
    }
}
