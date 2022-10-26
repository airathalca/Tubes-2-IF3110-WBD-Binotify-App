<?php

class UserAlbumDetailView implements ViewInterface
{
    public $data;
    public function __construct($data = [])
    {
        $this->data = $data;
    }

    public function render()
    {
        var_dump ($this->data);
        require_once __DIR__ . '/../../components/album/UserAlbumDetailPage.php';
    }
}