<?php

class NotFoundController extends Controller implements ControllerInterface
{
    public function index()
    {
        $notFoundView = $this->view('not-found', 'NotFoundView');
        $notFoundView->render();
    }
}
