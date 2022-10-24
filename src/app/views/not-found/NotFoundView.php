<?php

class NotFoundView implements ViewInterface
{
    public function __construct() {
        // Nothing to do here!
    }

    public function render() {
        require_once __DIR__ . '/../../components/not-found/NotFoundPage.php';
    }
}