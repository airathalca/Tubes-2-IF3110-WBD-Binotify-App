<?php

class User extends Controller implements DefaultMethodInterface
{
    public function index()
    {
        $this->view('user/index');
    }

    public function login()
    {
        try {
            switch ($_SERVER['REQUEST_METHOD']) {
                case 'GET':
                    break;
                case 'POST':
                    break;
                default:
                    throw new LoggedException('Method Not Allowed', 405);
            }
        } catch (Exception $e) {
            http_response_code($e->getCode());
        }
    }
}
