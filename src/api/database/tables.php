<?php

declare(strict_types=1);

$user_table =
    "CREATE TABLE IF NOT EXISTS user (
        user_id         INT             AUTO_INCREMENT      PRIMARY KEY,
        email           VARCHAR(256)    NOT NULL,
        password        VARCHAR(256)    NOT NULL,
        username        VARCHAR(256)    NOT NULL,
        isAdmin         BOOLEAN         NOT NULL
    );";

$album_table =
    "CREATE TABLE IF NOT EXISTS album (
        album_id        INT             AUTO_INCREMENT      PRIMARY KEY,
        judul           VARCHAR(64)     NOT NULL,
        penyanyi        VARCHAR(128)    NOT NULL,
        total_duration  INT             NOT NULL,
        image_path      VARCHAR(256)    NOT NULL,
        tanggal_terbit  DATE            NOT NULL,
        genre           VARCHAR(64)
    );";

$song_table =
    "CREATE TABLE IF NOT EXISTS song (
        song_id         INT             AUTO_INCREMENT      PRIMARY KEY,
        judul           VARCHAR(64)     NOT NULL,
        penyanyi        VARCHAR(128),
        tanggal_terbit  DATE            NOT NULL,
        genre           VARCHAR(64),
        duration        INT             NOT NULL,
        audio_path      VARCHAR(256)    NOT NULL,
        image_path      VARCHAR(256),
        album_id        INT,
        FOREIGN KEY (album_id) REFERENCES album (album_id) ON UPDATE CASCADE ON DELETE SET NULL 
    );";
