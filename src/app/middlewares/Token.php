<?php

class Token
{
    public function putToken()
    {
        $_SESSION['token'] = md5(uniqid(mt_rand(), true));
    }

    public function checkToken()
    {
        $token = filter_input(INPUT_POST, 'token', FILTER_DEFAULT);

        if (!$token || $token !== $_SESSION['token']) {
            throw new LoggedException('Method Not Allowed', 405);
        }
    }
}
