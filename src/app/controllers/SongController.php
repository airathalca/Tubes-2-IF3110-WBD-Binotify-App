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
                    if (isset($_GET['sort'])) {
                        $sort = $_GET['sort'];
                    }
                    if (isset($_GET['filter'])) {
                        $filter = $_GET['filter'];
                    }
                    $songModel = $this->model('SongModel');
                    $genreArr = $songModel->getGenre();
                    $songArr = $songModel->getByQuery($q, $sort, $filter);
                    if (isset($_SESSION['user_id'])) {
                        $userModel = $this->model('UserModel');
                        $user = $userModel->getUserFromID($_SESSION['user_id']);
                        $searchView = $this->view('song', 'SearchView', array_merge(['is_admin' => $user->is_admin,'username' => $user->username, 'genre_arr' => $genreArr], $songArr) );
                    } else {
                        $searchView = $this->view('song', 'SearchView', array_merge(['username' => null, 'genre_arr' => $genreArr], $songArr));
                    }
                    $searchView->render();
                    exit;

                    break;
                default:
                    throw new LoggedException('Method Not Allowed', 405);
            }
        } catch (Exception $e) {
            http_response_code($e->getCode());
        }
    }

    public function fetch($page) {
        try {
            switch ($_SERVER['REQUEST_METHOD']) {
                case 'GET':
                    // Prevent CSRF Attacks
                    $tokenMiddleware = $this->middleware('TokenMiddleware');
                    $tokenMiddleware->putToken();

                    $songModel = $this->model('SongModel');
                    $songArr = $songModel->getByQuery($_GET['q'], $_GET['sort'], $_GET['filter'], $page);

                    header('Content-Type: application/json');
                    echo json_encode($songArr);
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
                case 'POST':
                    // Halaman hanya bisa diakses admin
                    $authMiddleware = $this->middleware('AuthenticationMiddleware');
                    $authMiddleware->isAdmin();

                    // Prevent CSRF Attacks
                    $tokenMiddleware = $this->middleware('TokenMiddleware');
                    $tokenMiddleware->checkToken();

                    // Form tidak lengkap
                    if (!$_POST['title'] || !$_POST['artist'] || !$_POST['date'] || !$_POST['genre']) {
                        throw new LoggedException('Bad Request', 400);
                    }
                    // File tidak diisi
                    if ($_FILES['audio']['error'] === 4 || $_FILES['cover']['error'] === 4) {
                        throw new LoggedException('Bad Request', 400);
                    }
                    
                    $storageAccessAudio = new StorageAccess('songs');
                    $uploadedAudio = $storageAccessAudio->saveAudio($_FILES['audio']['tmp_name']);

                    $storageAccessImage = new StorageAccess('images');
                    $uploadedImage = $storageAccessImage->saveImage($_FILES['cover']['tmp_name']);

                    $songModel = $this->model('SongModel');
                    $songID = $songModel->addSong($_POST['title'], $_POST['artist'], $_POST['date'], $_POST['genre'], $uploadedAudio, $uploadedImage, $_POST['album']);

                    header("Location: /public/song/detail/$songID", true, 301);
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
