<?php

class AlbumController extends Controller implements ControllerInterface
{
    public function index()
    {
        try {
            switch ($_SERVER['REQUEST_METHOD']) {
                case 'GET':
                    // Prevent CSRF Attacks
                    $tokenMiddleware = $this->middleware('TokenMiddleware');
                    $tokenMiddleware->putToken();

                    // Load album-album di page 1
                    $albumModel = $this->model('AlbumModel');
                    $res = $albumModel->getAlbums(1);

                    // Keperluan navbar
                    if (isset($_SESSION['user_id'])) {
                        // Ada data user_id, coba fetch data username!
                        $userModel = $this->model('UserModel');
                        $user = $userModel->getUserFromID($_SESSION['user_id']);
                        $nav = ['username' => $user->username, 'is_admin' => $user->is_admin];
                    } else {
                        $nav = ['username' => null];
                    }

                    // Load AlbumListView
                    $albumListView = $this->view('album', 'AlbumListView', array_merge($res, $nav));
                    $albumListView->render();
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

    public function fetch($page)
    {
        try {
            switch ($_SERVER['REQUEST_METHOD']) {
                case 'GET':
                    // Prevent CSRF Attacks
                    $tokenMiddleware = $this->middleware('TokenMiddleware');
                    $tokenMiddleware->putToken();

                    // Load album-album di page 1
                    $albumModel = $this->model('AlbumModel');
                    $res = $albumModel->getAlbums((int) $page);

                    header('Content-Type: application/json');
                    http_response_code(200);
                    echo json_encode($res);
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

                    $albumID = (int) $params;

                    // Grab album data
                    $albumModel = $this->model('AlbumModel');
                    $album = $albumModel->getAlbumFromID($albumID);
                    $album_props = [];
                    $album_songs = ["songs" => []];
                    $songs_to_add = ["songs_to_add" => []];

                    if ($album) {
                        // Format duration
                        $minutes = floor(((int) $album->total_duration) / 60);
                        $seconds = ((int) $album->total_duration) % 60;

                        $album_props = ["album_id" => $album->album_id, "judul" => $album->judul, "penyanyi" => $album->penyanyi, "total_duration" => $minutes . " min " . $seconds . " sec", "image_path" => $album->image_path, "tanggal_terbit" => $album->tanggal_terbit, "genre" => $album->genre];

                        // Get album songs
                        $songModel = $this->model('SongModel');
                        $album_songs = ["songs" => $songModel->getSongsFromAlbum($albumID)];

                        // Get songs to add
                        $songs_to_add = ["songs_to_add" => $songModel->getAlbumlessSongs($album->penyanyi)];
                    }

                    // Keperluan navbar
                    if (isset($_SESSION['user_id'])) {
                        // Ada data user_id, coba fetch data username!
                        $userModel = $this->model('UserModel');
                        $user = $userModel->getUserFromID($_SESSION['user_id']);
                        $nav = ['username' => $user->username, 'is_admin' => $user->is_admin];
                    } else {
                        $nav = ['username' => null];
                    }

                    // Decide if user view or not
                    if (!isset($_SESSION['user_id'])) {
                        $albumDetailView = $this->view('album', 'UserAlbumDetailView', array_merge($album_props, $nav, $album_songs));
                    } else {
                        $userModel = $this->model('UserModel');
                        $user = $userModel->getUserFromID($_SESSION['user_id']);

                        if (!$user || !$user->is_admin) {
                            $albumDetailView = $this->view('album', 'UserAlbumDetailView', array_merge($album_props, $nav, $album_songs));
                        } else {
                            /* View admin! */
                            $albumDetailView = $this->view('album', 'AdminAlbumDetailView', array_merge($album_props, $nav, $album_songs, $songs_to_add));
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
                    if (!$_POST['title'] || !$_POST['date'] || !$_POST['genre']) {
                        throw new LoggedException('Bad Request', 400);
                    }

                    // Perbarui dahulu data yang ada, file dilakukan belakangan.
                    $albumModel = $this->model('AlbumModel');
                    $albumID = $_POST['album_id'];


                    $albumModel->changeAlbumTitle($albumID, $_POST['title']);

                    // $albumModel->changeAlbumArtist($albumID, $_POST['artist']);
                    // if ($_POST['artist'] !== $oldAlbumArtist) {
                    //     $songModel = $this->model('SongModel');
                    //     $songModel->bulkResetAlbum($albumID);
                    // }

                    $albumModel->changeAlbumDate($albumID, $_POST['date']);
                    $albumModel->changeAlbumGenre($albumID, $_POST['genre']);

                    if ($_FILES['cover']['error'] !== 4) {
                        // Perlu memperbarui file!
                        $storageAccess = new StorageAccess(StorageAccess::IMAGE_PATH);

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
                    $storageAccess = new StorageAccess(StorageAccess::IMAGE_PATH);
                    $storageAccess->deleteFile($_POST['old_path']);

                    // Hapus dari database
                    $albumID = (int) $params;
                    $albumModel = $this->model('AlbumModel');
                    $albumModel->deleteAlbum($albumID);

                    // Kirimkan response
                    header('Content-Type: application/json');
                    // Redirect ke album list
                    echo json_encode(["redirect_url" => "/public/album"]);
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

                    // Keperluan navbar
                    if (isset($_SESSION['user_id'])) {
                        // Ada data user_id, coba fetch data username!
                        $userModel = $this->model('UserModel');
                        $user = $userModel->getUserFromID($_SESSION['user_id']);
                        $nav = ['username' => $user->username, 'is_admin' => $user->is_admin];
                    } else {
                        $nav = ['username' => null];
                    }

                    // Load AddAlbumView.php
                    $addAlbumView = $this->view('album', 'AddAlbumView', $nav);
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

                    $storageAccess = new StorageAccess(StorageAccess::IMAGE_PATH);
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
            if ($e->getCode() == 401) {
                /* Unauthorized */
                $notFoundView = $this->view('not-found', 'NotFoundView');
                $notFoundView->render();
            }
            http_response_code($e->getCode());
            exit;
        }
    }

    public function penyanyi()
    {
        try {
            switch ($_SERVER['REQUEST_METHOD']) {
                case 'GET':
                    // Halaman hanya bisa diakses admin
                    $authMiddleware = $this->middleware('AuthenticationMiddleware');
                    $authMiddleware->isAdmin();

                    // Prevent CSRF Attacks
                    $tokenMiddleware = $this->middleware('TokenMiddleware');
                    $tokenMiddleware->checkToken();

                    $albumModel = $this->model('AlbumModel');
                    $album = $albumModel->getAlbumFromPenyanyi($_GET['artist']);

                    header('Content-Type: application/json');
                    http_response_code(200);
                    echo json_encode($album);
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
