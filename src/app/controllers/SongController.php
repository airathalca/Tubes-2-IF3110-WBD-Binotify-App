<?php

class SongController extends Controller implements ControllerInterface
{
    public function index()
    {
        echo 'La la la';
    }

    public function search()
    {
        try {
            switch ($_SERVER['REQUEST_METHOD']) {
                case 'GET':
                    $q = '';
                    if (isset($_GET['q'])) {
                        $q = $_GET['q'];
                    }
                    $songModel = $this->model('SongModel');
                    $genreArr = $songModel->getGenre();
                    $songArr = $songModel->getByQuery($q);
                    if (isset($_SESSION['user_id'])) {
                        $userModel = $this->model('UserModel');
                        $user = $userModel->getUserFromID($_SESSION['user_id']);
                        $searchView = $this->view('song', 'SearchView', array_merge(['is_admin' => $user->is_admin, 'username' => $user->username, 'genre_arr' => $genreArr], $songArr));
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

    public function fetch($page)
    {
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

                    // Keperluan navbar
                    if (isset($_SESSION['user_id'])) {
                        // Ada data user_id, coba fetch data username!
                        $userModel = $this->model('UserModel');
                        $user = $userModel->getUserFromID($_SESSION['user_id']);
                        $nav = ['username' => $user->username, 'is_admin' => $user->is_admin];
                    } else {
                        $nav = ['username' => null];
                    }

                    // Load AddSongView.php
                    $addAlbumView = $this->view('song', 'AddSongView', array_merge(['album_arr' => $albumArr], $nav));
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
                    $songID = $songModel->addSong($_POST['title'], $_POST['artist'], $_POST['date'], $_POST['genre'], $duration, $uploadedAudio, $uploadedImage, $_POST['album']);

                    header("Location: /public/song/detail/$songID", true, 301);
                    exit;

                    break;
                default:
                    throw new LoggedException('Method Not Allowed', 405);
            }
        } catch (Exception $e) {
            if ($e->getCode() == 401) {
                /* Unauthorized */
                $notFoundView = $this->view('not-found', 'NotFoundView');
                $notFoundView->render();
            }
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
                    $albumModel = $this->model('AlbumModel');

                    $songArtist = ($songModel->getSong($songID))->penyanyi;
                    $albumArtist = ($albumModel->getAlbumFromID($albumID)->penyanyi);

                    if ($songArtist !== $albumArtist) {
                        throw new LoggedException(400, "Bad Request");
                    }

                    $song = $songModel->getSong($songID);

                    $songModel->assignAlbum($songID, $albumID);
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

    public function detail($params)
    {
        try {
            switch ($_SERVER['REQUEST_METHOD']) {
                case 'GET':
                    // Prevent CSRF Attacks
                    $tokenMiddleware = $this->middleware('TokenMiddleware');
                    $tokenMiddleware->putToken();

                    $songID = (int) $params;

                    $songModel = $this->model('SongModel');
                    $song = $songModel->getSong($songID);
                    if ($song) {
                        // Format duration
                        $minutes = floor(((int) $song->duration) / 60);
                        $seconds = ((int) $song->duration) % 60;
                        $date = date('d F Y', strtotime($song->tanggal_terbit));
                        $song_props = [
                            "song_id" => $song->song_id, "judul" => $song->judul, "penyanyi" => $song->penyanyi, "duration" => $minutes . " min " . $seconds . " sec",
                            "image_path" => $song->image_path, "audio_path" => $song->audio_path, "tanggal_terbit" => $date, "genre" => $song->genre, "album" => $song->album_id
                        ];
                    } else {
                        throw new LoggedException('Not Found', 404);
                    }
                    // Keperluan navbar
                    if (isset($_SESSION['user_id'])) {
                        // Ada data user_id, coba fetch data username!
                        $userModel = $this->model('UserModel');
                        $user = $userModel->getUserFromID($_SESSION['user_id']);
                        $nav = ['username' => $user->username, 'is_admin' => $user->is_admin];
                        if ($user->is_admin) {
                            $song_props['tanggal_terbit'] = $song->tanggal_terbit;
                            $song_props['duration'] = $song->duration;
                            $songDetailView = $this->view('song', 'AdminSongDetailView', array_merge($song_props, $nav));
                        } else {
                            $songDetailView = $this->view('song', 'UserSongDetailView', array_merge($song_props, $nav));
                        }
                    } else {
                        $nav = ['username' => null];
                        $songDetailView = $this->view('song', 'UserSongDetailView', array_merge($song_props, $nav));
                    }

                    $songDetailView->render();

                    exit;

                    break;
                case 'POST':
                    $authMiddleware = $this->middleware('AuthenticationMiddleware');
                    $authMiddleware->isAdmin();

                    $tokenMiddleware = $this->middleware('TokenMiddleware');
                    $tokenMiddleware->checkToken();

                    if (!$_POST['title'] || !$_POST['artist'] || !$_POST['date'] || !$_POST['genre']) {
                        throw new LoggedException('Bad Request', 400);
                    }

                    $songModel = $this->model('SongModel');
                    $songID = $_POST['song_id'];
                    if ($_POST['artist'] !== $_POST['old_artist']) {
                        $songModel->changeSongArtist($songID, $_POST['artist']);
                    }
                    $songModel->changeSongTitle($songID, $_POST['title']);
                    $songModel->changeSongDate($songID, $_POST['date']);
                    $songModel->changeSongGenre($songID, $_POST['genre']);

                    if ($_FILES['cover']['error'] !== 4) {
                        $storageAccessImage = new StorageAccess('images');
                        $storageAccessImage->deleteFile($_POST['old_image_path']);
                        $uploadedImage = $storageAccessImage->saveImage($_FILES['cover']['tmp_name']);
                        $songModel->changeCoverPath($songID, $uploadedImage);
                    }

                    if ($_FILES['audio']['error'] !== 4) {
                        $diffDuration = 0;
                        $storageAccessAudio = new StorageAccess('songs');
                        $storageAccessAudio->deleteFile($_POST['old_audio_path']);
                        $mp3Access = new MP3Access($_FILES['audio']['tmp_name']);
                        $duration = (int) $mp3Access->getDuration();
                        $uploadedAudio = $storageAccessAudio->saveAudio($_FILES['audio']['tmp_name']);
                        if ($duration !== (int) $_POST['old_duration']) {
                            $diffDuration = $duration - (int) $_POST['old_duration'];
                        }
                        $songModel->changeAudioPath($songID, $duration, $uploadedAudio);
                        if ($diffDuration !== 0 && $_POST['artist'] === $_POST['old_artist']) {
                            $albumModel = $this->model('AlbumModel');
                            $albumModel->addDuration($_POST['album_id'], $diffDuration);
                        }
                    }

                    // Refresh page!
                    header("Location: /public/song/detail/$songID", true, 301);
                    exit;
                default:
                    throw new LoggedException('Method Not Allowed', 405);
            }
        } catch (Exception $e) {
            http_response_code($e->getCode());
            exit;
        }
    }
    public function delete($params)
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

                    // Hapus dari storage
                    $storageAccessImage = new StorageAccess('images');
                    $storageAccessImage->deleteFile($_POST['old_image_path']);

                    $storageAccessAudio = new StorageAccess('songs');
                    $storageAccessAudio->deleteFile($_POST['old_audio_path']);

                    // Hapus dari database
                    $songID = (int) $params;
                    $songModel = $this->model('songModel');
                    $songModel->deleteSong($songID);
                    if ($_POST['album_id'] !== NULL) {
                        $albumModel = $this->model('AlbumModel');
                        $albumModel->substractDuration($_POST['album_id'], $_POST['duration']);
                    }

                    // Kirimkan response
                    header('Content-Type: application/json');
                    // Redirect ke album list
                    echo json_encode(["redirect_url" => "/public/home"]);
                    exit;
                default:
                    throw new LoggedException('Method Not Allowed', 405);
            }
        } catch (Exception $e) {
            http_response_code($e->getCode());
            exit;
        }
    }
}
