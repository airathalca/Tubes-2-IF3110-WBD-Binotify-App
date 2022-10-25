<?php

class SongController extends Controller implements ControllerInterface
{
    public function index()
    {
        echo 'La la la';
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
                        $sort = $_GET['sort'];
                    }
                    $songModel = $this->model('SongModel');
                    $genreArr = $songModel->getGenre();
                    $songArr = $songModel->getByQuery($q, $sort, $filter);
                    if (isset($_SESSION['user_id'])) {
                        $userModel = $this->model('UserModel');
                        $user = $userModel->getUserFromID($_SESSION['user_id']);
                        $searchView = $this->view('song', 'SearchView', ['username' => $user->username, 'is_admin' => $user->is_admin, 
                        'genre_arr' => $genreArr, 'song_arr' => $songArr]);
                    } else {
                        $searchView = $this->view('song', 'SearchView', ['username' => null, 
                        'genre_arr' => $genreArr, 'song_arr' => $songArr]);
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

    public function add() 
    {
        try {
            switch ($_SERVER['REQUEST_METHOD']) {
                case 'GET':
                    $authMiddleware = $this->middleware('AuthenticationMiddleware');
                    $authMiddleware->isAdmin();

                    // Prevent CSRF Attacks
                    $tokenMiddleware = $this->middleware('TokenMiddleware');
                    $tokenMiddleware->putToken();

                    // Get Album ID
                    $albumModel = $this->model('AlbumModel');
                    $albumArr = $albumModel->getAllAlbum();
                    // Load AddSongView.php
                    $addAlbumView = $this->view('song', 'AddSongView', ['album_arr' => $albumArr]);
                    $addAlbumView->render();
                    exit;

                    break;
                default:
                    throw new LoggedException('Method Not Allowed', 405);
            }
        } catch (Exception $e) {
            http_response_code($e->getCode());
            exit;
        }
    }
}
