<?php

class AlbumController extends Controller implements ControllerInterface
{
    public function index()
    {
        echo 'Taylor Swift keren!';
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
                    // File tidak sesuai extensionnya
                    $extension = explode('.', $_FILES['cover']['name']);
                    $extension = strtolower(end($extension));
                    if (!in_array($extension, ['jpeg', 'png'])) {
                        throw new LoggedException('Bad Request', 400);
                    }
                    
                    $albumModel = $this->model('AlbumModel');
                    $albumID = $albumModel->createAlbum($_POST['title'], $_POST['artist'], $_FILES['cover']['tmp_name'], $_POST['date'], $_POST['genre']);

                    $fileLocation = "/images/album/$albumID.$extension";
                    
                    move_uploaded_file($_FILES['cover']['tmp_name'], '../storage' . $fileLocation);

                    $albumModel->changeAlbumPath($albumID, $fileLocation);

                    // Redirect <seharusnya ke album detail>
                    header('Location: /public/album/add', true, 301);
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
