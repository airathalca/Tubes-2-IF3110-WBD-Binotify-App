<?php

require_once 'Tables.php';

class Database
{
    private $host = HOST;
    private $db_name = DBNAME;
    private $user = USER;
    private $password = PASSWORD;
    private $port = PORT;
    private $db_connection;

    public function __construct()
    {
        $dsn = "mysql:host=$this->host;port=$this->port;dbname=$this->db_name";
        try {
            $this->db_connection = new PDO($dsn, $this->user, $this->password);
        } catch (PDOException $e) {
            die($e->getMessage());
        }
        $this->db_connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $this->db_connection->exec(Tables::USER_TABLE);
        $this->db_connection->exec(Tables::ALBUM_TABLE);
        $this->db_connection->exec(Tables::SONG_TABLE);
    }
}
