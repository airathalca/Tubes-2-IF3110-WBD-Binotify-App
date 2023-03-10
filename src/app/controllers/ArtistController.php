<?php

class ArtistController extends Controller implements ControllerInterface
{
    public function index()
    {
        try {
            switch ($_SERVER['REQUEST_METHOD']) {
                case 'GET':
                    // Prevent CSRF Attacks
                    $tokenMiddleware = $this->middleware('TokenMiddleware');
                    $tokenMiddleware->putToken();

                    if (isset($_SESSION['user_id'])) {
                        // Ada data user_id, coba fetch data username!
                        $userModel = $this->model('UserModel');
                        $user = $userModel->getUserFromID($_SESSION['user_id']);

                        if ($user->is_admin) {
                            $artistView = $this->view('artist', 'ArtistPremiumView', ['username' => $user->username, 'is_admin' => $user->is_admin, 'redirect' => BASE_URL . '/home', 'user_id' => $_SESSION['user_id']]);
                            $artistView->render();
                        } else {
                            $artistView = $this->view('artist', 'ArtistPremiumView', ['username' => $user->username, 'is_admin' => $user->is_admin, 'user_id' => $_SESSION['user_id']]);
                            $artistView->render();
                        }
                    } else {
                        $artistView = $this->view('artist', 'ArtistPremiumView', ['redirect' => BASE_URL . "/user/login"]);
                        $artistView->render();
                    }
                    
                    break;
                default:
                    throw new LoggedException('Method Not Allowed', 405);
            }
        } catch (Exception $e) {
            http_response_code($e->getCode());
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

                    $artistID = (int) $params;

                    // Cari user ID
                    if (isset($_SESSION['user_id'])) {
                        // Ada data user_id, coba fetch data username!
                        $userModel = $this->model('UserModel');
                        $user = $userModel->getUserFromID($_SESSION['user_id']);
                        $artistView = $this->view('artist', 'DetailView', ['username' => $user->username, 'is_admin' => $user->is_admin, 'artist_ID' => $artistID]);
                    } else {
                        $artistView = $this->view('artist', 'DetailView', ['username' => null, 'artist_ID' => $artistID]);
                    }
                    $artistView->render();

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
