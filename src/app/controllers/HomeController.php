<?php

class HomeController extends Controller implements ControllerInterface
{
    public function index()
    {
        try {
            switch ($_SERVER['REQUEST_METHOD']) {
                case 'GET':
                    // Cari user ID
                    if (isset($_SESSION['user_id'])) {
                        // Ada data user_id, coba fetch data username!
                        $userModel = $this->model('UserModel');
                        $user = $userModel->getUserFromID($_SESSION['user_id']);
                        $homeView = $this->view('home', 'MainView', ['username' => $user->username, 'is_admin' => $user->is_admin]);
                    } else {
                        $homeView = $this->view('home', 'MainView', ['username' => null]);
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
    public function search() {
        try {
            switch ($_SERVER['REQUEST_METHOD']) {
                case 'GET':
                    $q = '';
                    $sort = 'judul';
                    $filter = 'all';

                    if (isset($_GET['q'])) {
                        $q = $_GET['q'];
                    }
                    if (isset($_GET['filter'])) {
                        $filter = $_GET['filter'];
                    }
                    if (isset($_GET['sort'])) {
                        $page = $_GET[''];
                    }
                    $songModel = $this->model('SongModel');
                    $songArr = $songModel->getByQuery($q, $sort, $filter);
                    if (isset($_SESSION['user_id'])) {
                        $userModel = $this->model('UserModel');
                        $user = $userModel->getUserFromID($_SESSION['user_id']);
                        $searchView = $this->view('home', 'SearchView', ['username' => $user->username, 'song_arr' => $songArr]);
                    } else {
                        $searchView = $this->view('home', 'SearchView', ['username' => null, 'song_arr' => $songArr]);
                    }
                    $searchView->render();
                    break;
                default:
                    throw new LoggedException('Method Not Allowed', 405);
            }
        } catch (Exception $e) {
            http_response_code($e->getCode());
        }
    }
}
