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

    private function skipID3v2Tag(&$block)
    {
        if (substr($block, 0,3)=="ID3")
        {
            $id3v2_major_version = ord($block[3]);
            $id3v2_minor_version = ord($block[4]);
            $id3v2_flags = ord($block[5]);
            $flag_unsynchronisation  = $id3v2_flags & 0x80 ? 1 : 0;
            $flag_extended_header    = $id3v2_flags & 0x40 ? 1 : 0;
            $flag_experimental_ind   = $id3v2_flags & 0x20 ? 1 : 0;
            $flag_footer_present     = $id3v2_flags & 0x10 ? 1 : 0;
            $z0 = ord($block[6]);
            $z1 = ord($block[7]);
            $z2 = ord($block[8]);
            $z3 = ord($block[9]);
            if ( (($z0&0x80)==0) && (($z1&0x80)==0) && (($z2&0x80)==0) && (($z3&0x80)==0) )
            {
                $header_size = 10;
                $tag_size = (($z0&0x7f) * 2097152) + (($z1&0x7f) * 16384) + (($z2&0x7f) * 128) + ($z3&0x7f);
                $footer_size = $flag_footer_present ? 10 : 0;
                return $header_size + $tag_size + $footer_size;//bytes to skip
            }
        }
        return 0;
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

                    // Baca durasi file
                    $mp3Access = new MP3Access($_FILES['audio']['tmp_name']);
                    $duration = (int) $mp3Access->getDuration();
                    
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

    public function resetalbum($songID)
    {
        try {
            switch ($_SERVER['REQUEST_METHOD']) {
                case 'POST':
                    // Halaman hanya bisa diakses admin
                    $authMiddleware = $this->middleware('AuthenticationMiddleware');
                    $authMiddleware->isAdmin();

                    // Prevent CSRF Attacks
                    $tokenMiddleware = $this->middleware('TokenMiddleware');
                    $tokenMiddleware->checkToken();

                    $songModel = $this->model('SongModel');
                    $songModel->resetAlbum($songID);

                    $song = $songModel->getSong($songID);

                    $albumID = $_POST['album_id'];
                    $albumModel = $this->model('AlbumModel');
                    $albumModel->substractDuration($albumID, $song->duration);

                    header("Location: /public/album/detail/$albumID", true, 301);
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

    public function addtoalbum()
    {
        try {
            switch ($_SERVER['REQUEST_METHOD']) {
                case 'POST':
                    // Halaman hanya bisa diakses admin
                    $authMiddleware = $this->middleware('AuthenticationMiddleware');
                    $authMiddleware->isAdmin();

                    // Prevent CSRF Attacks
                    $tokenMiddleware = $this->middleware('TokenMiddleware');
                    $tokenMiddleware->checkToken();

                    $albumID = $_POST['album_id'];
                    $songID = $_POST['song'];

                    $songModel = $this->model('SongModel');
                    $songModel->assignAlbum($songID, $albumID);

                    $song = $songModel->getSong($songID);

                    $albumModel = $this->model('AlbumModel');
                    $albumModel->addDuration($albumID, $song->duration);

                    header("Location: /public/album/detail/$albumID", true, 301);
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
