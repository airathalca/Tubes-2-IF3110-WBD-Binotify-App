<?php

class HomeController extends Controller implements ControllerInterface
{
    public function index()
    {
        try {
            switch ($_SERVER['REQUEST_METHOD']) {
                case 'GET':
                    // Cari user ID
                    $songModel = $this->model('SongModel');
                    $songArr = $songModel->get10Songs();
                    if (isset($_SESSION['user_id'])) {
                        // Ada data user_id, coba fetch data username!
                        $userModel = $this->model('UserModel');
                        $user = $userModel->getUserFromID($_SESSION['user_id']);
                        $homeView = $this->view('home', 'MainView', ['username' => $user->username, 'is_admin' => $user->is_admin, 'song_arr' => $songArr]);
                    } else {
                        $homeView = $this->view('home', 'MainView', ['username' => null, 'song_arr' => $songArr]);
                    }
                    $homeView->render();

                    break;
                default:
                    throw new LoggedException('Method Not Allowed', 405);
            }
        } catch (Exception $e) {
            http_response_code($e->getCode());
        }
    }
    
}
