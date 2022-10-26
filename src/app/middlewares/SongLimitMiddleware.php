<?php

class SongLimitMiddleware
{
    public function incrementSongCount()
    {
        $_SESSION['song_count'] += 1;
    }

    public function checkSongCount()
    {
        $song_count = $_SESSION['song_count'];

        if ($song_count > MAX_SONG_COUNT) {
            require_once __DIR__ . '/AuthenticationMiddleware.php';

            $authMiddleware = new AuthenticationMiddleware();
            $authMiddleware->isAuthenticated();
        }
    }
}
