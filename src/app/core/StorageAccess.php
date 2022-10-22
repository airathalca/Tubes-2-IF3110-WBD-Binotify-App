<?php

class StorageAccess
{
    private $storageDir;

    public const IMAGE_PATH = 'image';
    public const SONG_PATH = 'song';

    public function __construct($foldername)
    {
        $this->storageDir = __DIR__ . '/../../storage/' . $foldername . '/';
    }

    public function createFile($data)
    {
        $valid = false;
        $filename = '';

        while (!$valid) {
            $filename = uniqid("", true);

            if (!file_exists($this->storageDir . $filename)) {
                $valid = true;
            }
        }

        file_put_contents($this->storageDir . $filename, $data);
        return $filename;
    }

    public function deleteFile($filename)
    {
        if (file_exists($$this->storageDir . $filename)) {
            unlink($this->storageDir . $filename);
            return true;
        } else {
            return false;
        }
    }
}
