<?php

class AdminAlbumDetailView implements ViewInterface
{
    public $data;
    public function __construct($data = [])
    {
        $this->data = $data;
    }

    public function render()
    {
        var_dump ($this->data);
        require_once __DIR__ . '/../../components/album/AdminAlbumDetailPage.php';
    }
}