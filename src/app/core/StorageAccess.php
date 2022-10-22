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

    public function fileExist($filename)
    {
        return file_exists($$this->storageDir . $filename);
    }

    public function saveFile($filename)
    {
        $tmpname = $_FILES[$filename]['tmp_name'];
        $mimeType = mime_content_type($tmpname);
        $filename = '';

        $valid = false;
        while (!$valid) {
            $filename = md5(uniqid(mt_rand(), true)) . ALLOWED_FILES[$mimeType];

            if (!file_exists($this->storageDir . $filename)) {
                $valid = true;
            }
        }

        move_uploaded_file($tmpname, $filename);
        return $filename;
    }

    public function deleteFile($filename)
    {
        unlink($this->storageDir . $filename);
    }
}
