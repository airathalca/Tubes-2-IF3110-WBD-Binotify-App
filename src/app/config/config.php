<?php

// URL
define('BASE_URL', 'http://localhost:8080/public');

// Database
define('HOST', $_ENV['MYSQL_HOST']);
define('DBNAME', $_ENV['MYSQL_DATABASE']);
define('USER', $_ENV['MYSQL_USER']);
define('PASSWORD', $_ENV['MYSQL_PASSWORD']);
define('PORT', $_ENV['MYSQL_PORT']);
define('ROWS_PER_PAGE', 10); // Application Logic

// File
define('MAX_SIZE', 10 * 1024 * 1024);
define('ALLOWED_FILES', [
    'image/jpeg' => '.jpeg',
    'image/png' => '.png',
    'audio/mpeg' => '.mp3'
]);

// Bcrypt
define('BCRYPT_COST', 10);

// Session
define('SESSION_EXPIRATION_TIME', 24 * 60 * 60);
define('SESSION_REGENERATION_TIME', 30 * 60);
define('MAX_SONG_COUNT', 3); // Application Logic
