<?php

class Tables
{
    public const USER_TABLE =
    "CREATE TABLE IF NOT EXISTS user (
        user_id             INT             AUTO_INCREMENT      PRIMARY KEY,
        email               VARCHAR(256)    UNIQUE NOT NULL,
        username            VARCHAR(256)    UNIQUE NOT NULL,
        password            VARCHAR(256)    NOT NULL,
        is_admin            BOOLEAN         NOT NULL
    );";

    public const USER_TOKEN_TABLE =
    "CREATE TABLE IF NOT EXISTS user_token (
        user_token_id       INT             AUTO_INCREMENT      PRIMARY KEY,
        selector            VARCHAR(256)    NOT NULL,
        hashed_validator    VARCHAR(256)    NOT NULL,
        user_id             INT             NOT NULL,
        expired_date        DATETIME        NOT NULL,
        FOREIGN KEY (user_id) REFERENCES user (user_id) ON UPDATE CASCADE ON DELETE CASCADE
    );";

    public const ALBUM_TABLE =
    "CREATE TABLE IF NOT EXISTS album (
        album_id            INT             AUTO_INCREMENT      PRIMARY KEY,
        judul               VARCHAR(64)     NOT NULL,
        penyanyi            VARCHAR(128)    NOT NULL,
        total_duration      INT             NOT NULL,
        image_path          VARCHAR(256)    NOT NULL,
        tanggal_terbit      DATE            NOT NULL,
        genre               VARCHAR(64)
    );";

    public const SONG_TABLE =
    "CREATE TABLE IF NOT EXISTS song (
        song_id             INT             AUTO_INCREMENT      PRIMARY KEY,
        judul               VARCHAR(64)     NOT NULL,
        penyanyi            VARCHAR(128),
        tanggal_terbit      DATE            NOT NULL,
        genre               VARCHAR(64),
        duration            INT             NOT NULL,
        audio_path          VARCHAR(256)    NOT NULL,
        image_path          VARCHAR(256),
        album_id            INT,
        FOREIGN KEY (album_id) REFERENCES album (album_id) ON UPDATE CASCADE ON DELETE SET NULL 
    );";
}
