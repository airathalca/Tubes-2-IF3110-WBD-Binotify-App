<?php

class SongModel
{
    private $database;

    public function __construct()
    {
        $this->database = new Database();
    }

    public function get10Songs()
    {
        $query = 'SELECT * FROM song ORDER BY song_id DESC LIMIT 10';
        $this->database->query($query);
        $songArr = $this->database->fetchAll();
        return $songArr;
    }
    public function getByQuery($q, $sort = 'judul', $filter ='all', $page = 1)
    {
        if ($filter === 'all') {
            $query = "SELECT * FROM song WHERE (judul LIKE :q or penyanyi LIKE :q or tanggal_terbit LIKE :q) ORDER BY $sort LIMIT :limit OFFSET :offset";
        } 
        else {
            $query = "SELECT * FROM song WHERE (judul LIKE :q or penyanyi like :q or tanggal_terbit like :q) and genre = :filter ORDER BY $sort LIMIT :limit OFFSET :offset";
        }
        $this->database->query($query);
        $this->database->bind('limit', ROWS_PER_PAGE);
        $this->database->bind('offset', ($page - 1) * ROWS_PER_PAGE);
        $this->database->bind('q', '%' . $q . '%');
        $this->database->bind('sort', $sort);
        if ($filter !== 'all') {
            $this->database->bind('filter', $filter);
        }
        $songArr = $this->database->fetchAll();
        $pages_count = $this->getPagesCount($q, $filter);
        $return_array = ["songs" => $songArr, "pages" => $pages_count];


        return $return_array;
    }

    public function getPagesCount($q, $filter = 'all')
    {
        if ($filter === 'all') {
            $query = "SELECT COUNT(*) count_result FROM song WHERE (judul LIKE :q or penyanyi LIKE :q or tanggal_terbit LIKE :q)";
        } 
        else {
            $query = "SELECT COUNT(*) count_result FROM song WHERE (judul LIKE :q or penyanyi like :q or tanggal_terbit like :q) and genre = :filter";
        }
        $this->database->query($query);
        $this->database->bind('q', '%' . $q . '%');
        if ($filter !== 'all') {
            $this->database->bind('filter', $filter);
        }
        $count = $this->database->fetch();
        $pages_count = ceil($count->count_result / ROWS_PER_PAGE);
        return $pages_count;
    }
    
    public function getGenre()
    {
        $query = 'SELECT DISTINCT genre FROM song';
        $this->database->query($query);
        $genreArr = $this->database->fetchAll();
        return $genreArr;
    }

    public function addSong($title, $singer, $published_date, $genre, $audio_path, $image_path, $album_id) {
        if ($album_id == "") {
            $query = "INSERT INTO song (judul, penyanyi, tanggal_terbit, genre, duration, audio_path, image_path) 
            VALUES (:judul, :penyanyi, :tanggal_terbit, :genre, 180, :audio_path, :image_path)";
        } else {
            $query = "INSERT INTO song (judul, penyanyi, tanggal_terbit, genre, duration, audio_path, image_path, album_id) 
            VALUES (:judul, :penyanyi, :tanggal_terbit, :genre, 180, :audio_path, :image_path, :album_id)";
        }
        
        $this->database->query($query);
        $this->database->bind('judul', $title);
        $this->database->bind('penyanyi', $singer);
        $this->database->bind('tanggal_terbit', $published_date);
        $this->database->bind('image_path', $image_path);
        $this->database->bind('audio_path', $audio_path);
        $this->database->bind('genre', $genre);
        if ($album_id != "") {
            $this->database->bind('album_id', $album_id);
        }
        $this->database->execute();
        
        return $this->database->lastInsertID();
    }
}
