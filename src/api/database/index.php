<?php

require_once 'connection.php';

try {
    $db = get_connection();
} catch (PDOException $e) {
    echo $e->getMessage();
}
