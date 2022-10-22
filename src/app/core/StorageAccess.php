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

    public function saveFile($fileinput)
    {
        $tmpname = $_FILES[$fileinput]['tmp_name'];

        $filesize = filesize($tmpname);
        if ($filesize > MAX_SIZE) {
            throw new LoggedException('Request Entity Too Large', 413);
        }

        $mimetype = mime_content_type($tmpname);
        if (!in_array($mimetype, array_keys(ALLOWED_FILES))) {
            throw new LoggedException('Unsupported Media Type', 415);
        }

        $valid = false;
        while (!$valid) {
            $filename = md5(uniqid(mt_rand(), true)) . ALLOWED_FILES[$mimetype];
            $valid = !$this->doesFileExist($filename);
        }

        $success = move_uploaded_file($tmpname, $filename);
        if (!$success) {
            throw new LoggedException('Internal Server Error', 500);
        }

        return $filename;
    }

    public function deleteFile($filename)
    {
        if (!$this->doesFileExist($filename)) {
            throw new LoggedException('Not Found', 404);
        }

        $success = unlink($this->storageDir . $filename);
        if (!$success) {
            throw new LoggedException('Internal Server Error', 500);
        }
    }

    private function doesFileExist($filename)
    {
        return file_exists($this->storageDir . $filename);
    }
}
