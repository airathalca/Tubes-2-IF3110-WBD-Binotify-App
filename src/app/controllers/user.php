<?php

require_once __DIR__ . '/../middlewares/Authentication.php';

class User extends Controller implements ControllerInterface
{
    public function index()
    {
        $indexView = $this->view('user/index');
        $indexView->render();
    }

    public function login()
    {
        try {
            switch ($_SERVER['REQUEST_METHOD']) {
                case 'GET':
                    $loginView = $this->view('user/Login');
                    $loginView->render();

                    break;
                case 'POST':
                    $userModel = $this->model('User');
                    $authenticationMiddleware = $this->middleware('Authentication');
                    break;
                default:
                    throw new LoggedException('Method Not Allowed', 405);
            }
        } catch (Exception $e) {
            http_response_code($e->getCode());
        }
    }
}
