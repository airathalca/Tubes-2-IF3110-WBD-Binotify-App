<?php

class SongModel
{
    private $database;

    public function __construct()
    {
        $this->database = new Database();
    }
    public function getByQuery($q, $sort, $filter, $page = 1)
    {
        // if ($filter = 'all') {}
        // switch ($sort) {
        //     case 'judul':
        //         $query = 'SELECT * FROM song WHERE (judul LIKE :q or penyanyi LIKE :q or tanggal_terbit LIKE :q) 
        //         ORDER BY judul LIMIT :limit OFFSET :offset';
        //     case 'penyanyi':
        //         $query = 'SELECT * FROM song WHERE (judul LIKE :q or penyanyi LIKE :q or tanggal_terbit LIKE :q) 
        //         ORDER BY penyanyi LIMIT :limit OFFSET :offset';
        //     case 'tanggal_terbit':
        //         $query = 'SELECT * FROM song WHERE (judul LIKE :q or penyanyi LIKE :q or tanggal_terbit LIKE :q) 
        //         ORDER BY tanggal_terbit LIMIT :limit OFFSET :offset';
        //     case 'judul desc':
        //         $query = 'SELECT * FROM song WHERE (judul LIKE :q or penyanyi LIKE :q or tanggal_terbit LIKE :q) 
        //         ORDER BY judul desc LIMIT :limit OFFSET :offset';
        //     case 'penyanyi desc':
        //         $query = 'SELECT * FROM song WHERE (judul LIKE :q or penyanyi LIKE :q or tanggal_terbit LIKE :q) 
        //         ORDER BY penyanyi desc LIMIT :limit OFFSET :offset';
        //     case 'tanggal_terbit desc':
        //         $query = 'SELECT * FROM song WHERE (judul LIKE :q or penyanyi LIKE :q or tanggal_terbit LIKE :q) 
        //         ORDER BY tanggal_terbit desc LIMIT :limit OFFSET :offset';
        // }
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
        return $songArr;
    }
    public function getGenre()
    {
        $query = 'SELECT DISTINCT genre FROM song';
        $this->database->query($query);
        $genreArr = $this->database->fetchAll();
        return $genreArr;
    }
}
