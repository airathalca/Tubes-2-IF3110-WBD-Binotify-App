<?php

class SongLimitMiddleware
{
    public function incrementSongCount()
    {
        if (!isset($_SESSION['song_count'])) {
            $_SESSION['song_count'] = 0;
        }

        $_SESSION['song_count'] += 1;
    }

    public function checkSongCount()
    {
        $song_count = $_SESSION['song_count'];

        if ($song_count > MAX_SONG_COUNT) {
            throw new LoggedException('Unauthorized', 401);
        }
    }
}
