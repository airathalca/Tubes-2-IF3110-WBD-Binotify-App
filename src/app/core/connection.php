<?php

require_once 'config.php';
require_once 'tables.php';

function get_connection()
{
    global $host, $dbname, $user, $password, $user_table, $album_table, $song_table;

    $dsn = "mysql:host=$host;dbname=$dbname;charset=utf8";
    $pdo = new PDO($dsn, $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $pdo->exec($user_table);
    $pdo->exec($album_table);
    $pdo->exec($song_table);

    return $pdo;
}
