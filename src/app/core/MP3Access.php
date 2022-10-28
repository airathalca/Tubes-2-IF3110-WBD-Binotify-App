<?php

class MP3Access
{
    protected $filename;
    public function __construct($filename)
    {
        $this->filename = $filename;
    }

    public function getDuration()
    {
        $dur = shell_exec("ffmpeg -i " . $this->filename . " 2>&1");
        if (preg_match("/: Invalid /", $dur)) {
            return false;
        }
        preg_match("/Duration: (.{2}):(.{2}):(.{2})/", $dur, $duration);
        if (!isset($duration[1])) {
            return false;
        }
        $hours = $duration[1];
        $minutes = $duration[2];
        $seconds = $duration[3];
        return $seconds + ($minutes * 60) + ($hours * 60 * 60);
    }
}
