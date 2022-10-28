<?php

class TokenMiddleware
{
    public function putToken()
    {
        if (!isset($_SESSION['csrf_token'])) {
            $_SESSION['csrf_token'] = md5(uniqid(mt_rand(), true));
        }
    }

    public function checkToken()
    {
        $token = $_REQUEST['csrf_token'];

        if (!$token || $token !== $_SESSION['csrf_token']) {
            throw new LoggedException('Method Not Allowed', 405);
        }
    }
}
