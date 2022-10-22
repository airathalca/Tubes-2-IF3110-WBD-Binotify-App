<?php

define('HOST', $_ENV['MYSQL_HOST']);
define('DBNAME', $_ENV['MYSQL_DATABASE']);
define('USER', $_ENV['MYSQL_USER']);
define('PASSWORD', $_ENV['MYSQL_PASSWORD']);
define('PORT', $_ENV['MYSQL_PORT']);
define('MAX_SIZE', 10 * 1024 * 1024);
define('ALLOWED_FILES', [
    'image/jpeg' => '.jpeg',
    'image/png' => '.png',
    'audio/mpeg' => '.mp3'
]);
define('BCRYPT_COST', 10);
