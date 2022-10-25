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
        if ($filter === 'all') {
            $query = 'SELECT * FROM song WHERE (judul LIKE :q or penyanyi LIKE :q or tanggal_terbit LIKE :q) 
            ORDER BY :sort LIMIT :limit OFFSET :offset';
        } 
        else {
            $query = 'SELECT * FROM song WHERE (judul LIKE :q or penyanyi LIKE :q or tanggal_terbit LIKE :q) 
            AND genre = :filter ORDER BY :sort LIMIT :limit OFFSET :offset';
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
