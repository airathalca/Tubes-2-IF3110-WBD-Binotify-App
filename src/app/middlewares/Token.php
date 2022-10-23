<?php

class Token
{
    public function putToken()
    {
        $_SESSION['token'] = md5(uniqid(mt_rand(), true));
    }

    public function checkToken()
    {
        $token = $_POST['token'];

        if (!$token || $token !== $_SESSION['token']) {
            throw new LoggedException('Method Not Allowed', 405);
        }
    }
}
