<?php

class AlbumModel
{
    private $database;

    public function __construct()
    {
        $this->database = new Database();
    }

    public function getAllAlbum() {
        $query = 'SELECT album_id, judul FROM album';
        $this->database->query($query);
        $albumArr = $this->database->fetchAll();
        return $albumArr;
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

    public function changeAlbumTitle($albumID, $newTitle) {
        $query = 'UPDATE album SET judul = :judul WHERE album_id = :album_id';

        $this->database->query($query);
        $this->database->bind('judul', $newTitle);
        $this->database->bind('album_id', $albumID);
        $this->database->execute();
    }

    public function changeAlbumArtist($albumID, $newArtist) {
        $query = 'UPDATE album SET penyanyi = :penyanyi WHERE album_id = :album_id';

        $this->database->query($query);
        $this->database->bind('penyanyi', $newArtist);
        $this->database->bind('album_id', $albumID);
        $this->database->execute();
    }

    public function changeAlbumDate($albumID, $newDate) {
        $query = 'UPDATE album SET tanggal_terbit = :tanggal_terbit WHERE album_id = :album_id';

        $this->database->query($query);
        $this->database->bind('tanggal_terbit', $newDate);
        $this->database->bind('album_id', $albumID);
        $this->database->execute();
    }

    public function changeAlbumGenre($albumID, $newGenre) {
        $query = 'UPDATE album SET genre = :genre WHERE album_id = :album_id';

        $this->database->query($query);
        $this->database->bind('genre', $newGenre);
        $this->database->bind('album_id', $albumID);
        $this->database->execute();
    }

    public function changeAlbumPath($albumID, $newPath) {
        $query = 'UPDATE album SET image_path = :image_path WHERE album_id = :album_id';

        $this->database->query($query);
        $this->database->bind('image_path', $newPath);
        $this->database->bind('album_id', $albumID);
        $this->database->execute();
    }

    public function deleteAlbum($albumID) {
        $query = 'DELETE FROM album WHERE album_id = :album_id';

        $this->database->query($query);
        $this->database->bind('album_id', $albumID);
        $this->database->execute();
    }
}
