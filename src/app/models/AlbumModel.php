<?php

class AlbumModel
{
    private $database;

    public function __construct()
    {
        $this->database = new Database();
    }

    public function getAlbumFromID($albumID) {
        $query = 'SELECT album_id, judul, penyanyi, total_duration, image_path, tanggal_terbit, genre FROM album WHERE album_id = :album_id LIMIT 1';

        $this->database->query($query);
        $this->database->bind('album_id', $albumID);

        $album = $this->database->fetch();

        return $album;
    }

    public function createAlbum($title, $singer, $image_path, $published_date, $genre) {
        $query = 'INSERT INTO album (judul, penyanyi, total_duration, image_path, tanggal_terbit, genre) VALUES (:judul, :penyanyi, 0, :image_path, :tanggal_terbit, :genre)';
        
        $this->database->query($query);
        $this->database->bind('judul', $title);
        $this->database->bind('penyanyi', $singer);
        $this->database->bind('image_path', $image_path);
        $this->database->bind('tanggal_terbit', $published_date);
        $this->database->bind('genre', $genre);

        $this->database->execute();
        
        return $this->database->lastInsertID();
    }

    public function changeAlbumPath($albumID, $newPath) {
        $query = 'UPDATE album SET image_path = :image_path WHERE album_id = :album_id';

        $this->database->query($query);
        $this->database->bind('image_path', $newPath);
        $this->database->bind('album_id', $albumID);
        $this->database->execute();
    }
}
