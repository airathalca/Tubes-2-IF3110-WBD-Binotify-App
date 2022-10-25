<?php

class AlbumController extends Controller implements ControllerInterface
{
    public function index()
    {
        echo 'Taylor Swift keren!';
    }

    public function detail($params)
    {
        try {
            switch ($_SERVER['REQUEST_METHOD']) {
                case 'GET':
                    // Prevent CSRF Attacks
                    $tokenMiddleware = $this->middleware('TokenMiddleware');
                    $tokenMiddleware->putToken();

                    $albumID = (int) $params;

                    // Grab album data
                    $albumModel = $this->model('AlbumModel');
                    $album = $albumModel->getAlbumFromID($albumID);
                    $album_props = [];

                    if ($album) {
                        // Format duration
                        $minutes = floor(((int) $album->total_duration) / 60);
                        $seconds = ((int) $album->total_duration) % 60;

                        $album_props = ["album_id" => $album->album_id, "judul" => $album->judul, "penyanyi" => $album->penyanyi, "total_duration" => $minutes . " min " . $seconds . " sec", "image_path" => $album->image_path, "tanggal_terbit" => $album->tanggal_terbit, "genre" => $album->genre];
                    }

                    // Decide if user view or not
                    if (!isset($_SESSION['user_id'])) {
                        $albumDetailView = $this->view('album', 'UserAlbumDetailView', $album_props);
                    } else {
                        $userModel = $this->model('UserModel');
                        $user = $userModel->getUserFromID($_SESSION['user_id']);

                        if (!$user || !$user->is_admin) {
                            $albumDetailView = $this->view('album', 'UserAlbumDetailView', $album_props);
                        } else {
                            /* View admin! */
                            $albumDetailView = $this->view('album', 'AdminAlbumDetailView', $album_props);
                        }
                    }

                    $albumDetailView->render();

                    exit;

                    break;
                case 'POST':
                    // Halaman hanya bisa diakses admin
                    $authMiddleware = $this->middleware('AuthenticationMiddleware');
                    $authMiddleware->isAdmin();

                    // Prevent CSRF Attacks
                    $tokenMiddleware = $this->middleware('TokenMiddleware');
                    $tokenMiddleware->checkToken();

                    /* Lakukan validasi */
                    // Form ada yang kosong
                    if (!$_POST['title'] || !$_POST['artist'] || !$_POST['date'] || !$_POST['genre']) {
                        throw new LoggedException('Bad Request', 400);
                    }

                    // Perbarui dahulu data yang ada, file dilakukan belakangan.
                    $albumModel = $this->model('AlbumModel');
                    $albumID = $_POST['album_id'];

                    $albumModel->changeAlbumTitle($albumID, $_POST['title']);
                    $albumModel->changeAlbumArtist($albumID, $_POST['artist']);
                    $albumModel->changeAlbumDate($albumID, $_POST['date']);
                    $albumModel->changeAlbumGenre($albumID, $_POST['genre']);

                    if ($_FILES['cover']['error'] !== 4) {
                        // Perlu memperbarui file!
                        $storageAccess = new StorageAccess('images');

                        $storageAccess->deleteFile($_POST['old_path']);

                        $uploadedFile = $storageAccess->saveImage($_FILES['cover']['tmp_name']);

                        // Update entri database
                        $albumModel->changeAlbumPath($albumID, $uploadedFile);
                    }

                    // Refresh page!
                    header("Location: /public/album/detail/$albumID", true, 301);
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
                    $storageAccess = new StorageAccess('images');
                    $storageAccess->deleteFile($_POST['old_path']);

                    // Hapus dari database
                    $albumID = (int) $params;
                    $albumModel = $this->model('AlbumModel');
                    $albumModel->deleteAlbum($albumID);

                    // Kirimkan response
                    header('Content-Type: application/json');
                    // Seharusnya ke album list
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

    public function add()
    {
        try {
            switch ($_SERVER['REQUEST_METHOD']) {
                case 'GET':
                    // Halaman hanya bisa diakses admin
                    $authMiddleware = $this->middleware('AuthenticationMiddleware');
                    $authMiddleware->isAdmin();

                    // Prevent CSRF Attacks
                    $tokenMiddleware = $this->middleware('TokenMiddleware');
                    $tokenMiddleware->putToken();

                    // Load AddAlbumView.php
                    $addAlbumView = $this->view('album', 'AddAlbumView');
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

                    /* Lakukan validasi */
                    // Form tidak lengkap
                    if (!$_POST['title'] || !$_POST['artist'] || !$_POST['date'] || !$_POST['genre']) {
                        throw new LoggedException('Bad Request', 400);
                    }
                    // File tidak diisi
                    if ($_FILES['cover']['error'] === 4) {
                        throw new LoggedException('Bad Request', 400);
                    }

                    $storageAccess = new StorageAccess('images');
                    $uploadedFile = $storageAccess->saveImage($_FILES['cover']['tmp_name']);

                    $albumModel = $this->model('AlbumModel');
                    $albumID = $albumModel->createAlbum($_POST['title'], $_POST['artist'], $uploadedFile, $_POST['date'], $_POST['genre']);

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
