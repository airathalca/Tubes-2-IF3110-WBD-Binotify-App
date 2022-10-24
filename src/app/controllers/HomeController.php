<?php

class HomeController extends Controller implements ControllerInterface
{
    public function index()
    {
        // Cari user ID
        $homeView = null;
        if (isset($_SESSION['user_id'])) {
            // Ada data user_id, coba fetch data username!
            $userModel = $this->model('UserModel');
            $username = $userModel->getUsernameFromID($_SESSION['user_id']);
            $homeView = $this->view('home', 'MainView', ['username' => $username]);
        } else {
            $homeView = $this->view('home', 'MainView', ['username' => null]);
        }
        $homeView->render();
    }
}
