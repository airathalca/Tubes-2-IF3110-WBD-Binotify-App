<?php

class SongLimitMiddleware
{
    public function checkSong()
    {
        if ($_SESSION['song_count'] >= MAX_SONG_COUNT) {
            return false;
        }
        $_SESSION['song_count'] += 1;
        return true;
    }

    public function makeNewSession()
    {
        $_SESSION['song_count'] = 0;
        $_SESSION['date'] = date('Y-m-d');
    }
}
