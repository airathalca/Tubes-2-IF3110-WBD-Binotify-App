<?php

require_once __DIR__ . '/../middlewares/Authentication.php';
require_once __DIR__ . '/../middlewares/Token.php';

class User extends Controller implements ControllerInterface
{
    private $authMiddleware;
    private $tokenMiddleware;

    public function __construct()
    {
        $this->authMiddleware = new Authentication();
        $this->tokenMiddleware = new Token();
    }

    public function index()
    {
        try {
            switch ($_SERVER['REQUEST_METHOD']) {
                case 'GET':
                    $indexView = $this->view('user', 'userlist');
                    $indexView->render();
                    break;
                default:
                    throw new LoggedException('Method Not Allowed', 405);
            }
        } catch (Exception $e) {
            http_response_code($e->getCode());
        }
    }

    public function login()
    {
        try {
            switch ($_SERVER['REQUEST_METHOD']) {
                case 'GET':
                    $this->tokenMiddleware->putToken();

                    $loginView = $this->view('user', 'login');
                    $loginView->render();

                    break;
                case 'POST':
                    $this->tokenMiddleware->checkToken();

                    $userModel = $this->model('user');
                    $userId = $userModel->login($_POST['username'], $_POST['password']);
                    $_SESSION['user_id'] = $userId;

                    break;
                default:
                    throw new LoggedException('Method Not Allowed', 405);
            }
        } catch (Exception $e) {
            http_response_code($e->getCode());
        }
    }
}
