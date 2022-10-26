<?php

class SongLimitMiddleware
{
    public function checkSong($songID)
    {
        if ($songID !== $_SESSION['song_id'])
        {
            if($_SESSION['song_count'] >= MAX_SONG_COUNT) {
                return false;
            }
            $_SESSION['song_id'] = $songID;
            $_SESSION['song_count'] += 1;
        }
        return true;
    }

    public function makeNewSession($songID)
    {
        $_SESSION['song_count'] = 1;
        $_SESSION['song_id'] = $songID;
        $_SESSION['date'] = date('Y-m-d');
    }
}
