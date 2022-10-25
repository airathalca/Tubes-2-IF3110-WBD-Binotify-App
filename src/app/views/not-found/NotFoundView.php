<?php

class NotFoundView implements ViewInterface
{
    public function __construct($data = [])
    {
        $this->data = $data;
    }

    public function render()
    {
        require_once __DIR__ . '/../../components/not-found/NotFoundPage.php';
    }
}
